<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\RevenueStream;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueStreamController extends Controller
{
    // Display a listing of revenue streams and analytics.
    public function index(Request $request)
    {
        $units = Unit::orderBy('code')->get();

        $query = RevenueStream::with(['unit', 'approvedBy']);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('approval_status')) {
            $query->where('approval_status', $request->approval_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $revenueStreams = $query->orderBy('created_at', 'desc')->get();

        // Calculate aggregates (Approved vs Pending)
        $totalRealization = RevenueStream::where('approval_status', 'approved')->sum('realization_amount');
        $totalTarget = RevenueStream::sum('target_amount');
        $topStream = RevenueStream::where('approval_status', 'approved')->orderBy('realization_amount', 'desc')->first() 
            ?? RevenueStream::orderBy('realization_amount', 'desc')->first();
        $avgGrowth = RevenueStream::avg('growth_rate') ?? 0;
        $overallAchievement = $totalTarget > 0 ? round(($totalRealization / $totalTarget) * 100, 1) : 0;
        
        $pendingCount = RevenueStream::where('approval_status', 'pending')->count();

        return view('revenue-streams.index', compact(
            'units',
            'revenueStreams',
            'totalRealization',
            'totalTarget',
            'topStream',
            'avgGrowth',
            'overallAchievement',
            'pendingCount'
        ));
    }

    // Store a newly created revenue stream with mandatory proof file.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'target_amount' => ['required', 'numeric', 'min:0'],
            'realization_amount' => ['required', 'numeric', 'min:0'],
            'growth_rate' => ['nullable', 'numeric'],
            'period' => ['nullable', 'string', 'max:50'],
            'proof_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'unit_id.required' => 'Unit operasional wajib dipilih.',
            'name.required' => 'Nama Revenue Stream wajib diisi.',
            'category.required' => 'Kategori layanan wajib dipilih.',
            'target_amount.required' => 'Target RKAP wajib diisi.',
            'realization_amount.required' => 'Realisasi pendapatan wajib diisi.',
            'proof_file.required' => 'Wajib mengunggah file bukti transaksi (kwitansi/nota/PDF).',
            'proof_file.mimes' => 'Format file bukti transaksi harus berupa PDF, JPG, JPEG, PNG, atau WEBP.',
            'proof_file.max' => 'Ukuran file bukti transaksi maksimal 5MB.',
        ]);

        if ($request->hasFile('proof_file')) {
            $path = $request->file('proof_file')->store('proofs', 'public');
            $validated['proof_file'] = $path;
        }

        $totalAll = RevenueStream::sum('realization_amount') + $validated['realization_amount'];
        $validated['contribution_percentage'] = $totalAll > 0 
            ? round(($validated['realization_amount'] / $totalAll) * 100, 2) 
            : 0;

        $validated['growth_rate'] = $validated['growth_rate'] ?? 0;
        $validated['period'] = $validated['period'] ?? 'YTD 2026';
        $validated['status'] = 'Active';

        // Set approval status
        $user = Auth::user();
        if ($user && $user->canApprove()) {
            $validated['approval_status'] = 'approved';
            $validated['approved_by'] = $user->id;
            $msg = 'Revenue Stream berhasil ditambahkan dan langsung disetujui!';
        } else {
            $validated['approval_status'] = 'pending';
            $msg = 'Revenue Stream berhasil ditambahkan dengan bukti transaksi! Menunggu verifikasi Manajer Keuangan.';
        }

        $stream = RevenueStream::create($validated);

        AuditLog::record(
            'CREATE_REVENUE',
            "Menambahkan transaksi Revenue Stream \"{$stream->name}\" sebesar Rp " . number_format($stream->realization_amount, 0, ',', '.') . " dengan lampiran bukti transaksi. (Status: {$stream->approval_status})"
        );

        return back()->with('success', $msg);
    }

    // Approve a pending revenue stream transaction.
    public function approve(RevenueStream $revenueStream)
    {
        $user = Auth::user();

        if (!$user || !$user->canApprove()) {
            return back()->with('error', 'Anda tidak memiliki hak akses untuk menyetujui transaksi.');
        }

        $revenueStream->update([
            'approval_status' => 'approved',
            'approved_by' => $user->id,
            'rejection_reason' => null,
        ]);

        AuditLog::record(
            'APPROVE_REVENUE',
            "{$user->role_label} ({$user->name}) menyetujui transaksi Revenue Stream \"{$revenueStream->name}\" sebesar Rp " . number_format($revenueStream->realization_amount, 0, ',', '.')
        );

        return back()->with('success', 'Transaksi berhasil disetujui dan diverifikasi!');
    }

    // Reject a pending revenue stream transaction.
    public function reject(Request $request, RevenueStream $revenueStream)
    {
        $user = Auth::user();

        if (!$user || !$user->canApprove()) {
            return back()->with('error', 'Anda tidak memiliki hak akses untuk menolak transaksi.');
        }

        $reason = $request->input('rejection_reason', 'Bukti transaksi tidak sesuai atau tidak lengkap.');

        $revenueStream->update([
            'approval_status' => 'rejected',
            'approved_by' => $user->id,
            'rejection_reason' => $reason,
        ]);

        AuditLog::record(
            'REJECT_REVENUE',
            "{$user->role_label} ({$user->name}) menolak transaksi Revenue Stream \"{$revenueStream->name}\". Alasan: {$reason}"
        );

        return back()->with('warning', 'Transaksi telah ditolak.');
    }

    // Remove the specified revenue stream.
    public function destroy(RevenueStream $revenueStream)
    {
        $user = Auth::user();

        if (!$user || !$user->canApprove()) {
            return back()->with('error', 'Akses ditolak. Hanya Manajer dan Supervisor Keuangan yang memiliki hak akses untuk menghapus Revenue Stream.');
        }

        AuditLog::record(
            'DELETE_REVENUE',
            "Menghapus entri Revenue Stream \"{$revenueStream->name}\"."
        );

        $revenueStream->delete();

        return back()->with('success', 'Revenue Stream berhasil dihapus!');
    }
}
