<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    // Display a listing of Unit Regional 4 and its financial analytics.
    public function index(Request $request)
    {
        $query = Unit::with(['finances' => function ($q) {
            $q->orderBy('year', 'desc');
        }]);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('person_in_charge', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $units = $query->orderBy('code')->get();

        // Calculate summary metrics for Regional 4 units
        $totalUnits = Unit::count();
        $activeUnits = Unit::where('status', 'Active')->count();

        $totalTarget = Finance::sum('target_rkap');
        $totalRealization = Finance::sum('realization');
        $totalVariance = $totalRealization - $totalTarget;
        $overallAchievement = $totalTarget > 0 ? round(($totalRealization / $totalTarget) * 100, 1) : 0;

        // Categories for filter dropdown
        $categories = Unit::distinct()->pluck('category')->filter()->values();

        return view('units.index', compact(
            'units',
            'totalUnits',
            'activeUnits',
            'totalTarget',
            'totalRealization',
            'totalVariance',
            'overallAchievement',
            'categories'
        ));
    }

    // Store a newly created Regional 4 unit.
    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->canApprove()) {
            return back()->with('error', 'Akses ditolak. Hanya Manajer dan Supervisor Keuangan yang memiliki hak akses untuk menambah Unit Kerja baru.');
        }

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:units,code'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'person_in_charge' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
            'target_rkap' => ['nullable', 'numeric', 'min:0'],
            'realization' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        $unit = Unit::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'category' => $validated['category'],
            'person_in_charge' => $validated['person_in_charge'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        $targetRkap = $validated['target_rkap'] ?? 0;
        $realization = $validated['realization'] ?? 0;

        if ($targetRkap > 0 || $realization > 0) {
            $variance = $realization - $targetRkap;
            $achievement = $targetRkap > 0 ? round(($realization / $targetRkap) * 100, 2) : 0;

            $performanceStatus = 'On Track';
            if ($achievement >= 104) {
                $performanceStatus = 'Sangat Baik';
            } elseif ($achievement < 100) {
                $performanceStatus = 'Perlu Perhatian';
            }

            Finance::create([
                'unit_id' => $unit->id,
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => $targetRkap,
                'realization' => $realization,
                'variance' => $variance,
                'achievement' => $achievement,
                'performance_status' => $performanceStatus,
                'notes' => $validated['notes'] ?? 'Data RKAP Awal Unit Regional 4',
            ]);
        }

        return back()->with('success', 'Unit Regional 4 baru berhasil ditambahkan!');
    }

    // Update the specified Regional 4 unit.
    public function update(Request $request, Unit $unit)
    {
        if (!Auth::user() || !Auth::user()->canApprove()) {
            return back()->with('error', 'Akses ditolak. Hanya Manajer dan Supervisor Keuangan yang memiliki hak akses untuk mengubah data Unit.');
        }

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('units', 'code')->ignore($unit->id)],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'person_in_charge' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
            'target_rkap' => ['nullable', 'numeric', 'min:0'],
            'realization' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        $unit->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'category' => $validated['category'],
            'person_in_charge' => $validated['person_in_charge'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        $targetRkap = $validated['target_rkap'] ?? 0;
        $realization = $validated['realization'] ?? 0;

        $variance = $realization - $targetRkap;
        $achievement = $targetRkap > 0 ? round(($realization / $targetRkap) * 100, 2) : 0;

        $performanceStatus = 'On Track';
        if ($achievement >= 104) {
            $performanceStatus = 'Sangat Baik';
        } elseif ($achievement < 100) {
            $performanceStatus = 'Perlu Perhatian';
        }

        $finance = Finance::where('unit_id', $unit->id)->orderBy('year', 'desc')->first();

        if ($finance) {
            $finance->update([
                'target_rkap' => $targetRkap,
                'realization' => $realization,
                'variance' => $variance,
                'achievement' => $achievement,
                'performance_status' => $performanceStatus,
                'notes' => $validated['notes'] ?? $finance->notes,
            ]);
        } else {
            Finance::create([
                'unit_id' => $unit->id,
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => $targetRkap,
                'realization' => $realization,
                'variance' => $variance,
                'achievement' => $achievement,
                'performance_status' => $performanceStatus,
                'notes' => $validated['notes'] ?? 'Data RKAP Unit Regional 4',
            ]);
        }

        return back()->with('success', 'Data Unit Regional 4 berhasil diperbarui!');
    }

    // Remove the specified Regional 4 unit.
    public function destroy(Unit $unit)
    {
        if (!Auth::user() || !Auth::user()->canApprove()) {
            return back()->with('error', 'Akses ditolak. Hanya Manajer dan Supervisor Keuangan yang memiliki hak akses untuk menghapus data Unit.');
        }

        $unit->finances()->delete();
        $unit->revenueStreams()->delete();
        $unit->delete();

        return back()->with('success', 'Unit Regional 4 berhasil dihapus!');
    }
}
