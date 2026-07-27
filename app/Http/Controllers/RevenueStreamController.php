<?php

namespace App\Http\Controllers;

use App\Models\RevenueStream;
use App\Models\Unit;
use Illuminate\Http\Request;

class RevenueStreamController extends Controller
{
    // Display a listing of revenue streams and analytics.
    public function index(Request $request)
    {
        $units = Unit::orderBy('code')->get();

        $query = RevenueStream::with('unit');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $revenueStreams = $query->orderBy('realization_amount', 'desc')->get();

        // Calculate aggregates
        $totalRealization = RevenueStream::sum('realization_amount');
        $totalTarget = RevenueStream::sum('target_amount');
        $topStream = RevenueStream::orderBy('realization_amount', 'desc')->first();
        $avgGrowth = RevenueStream::avg('growth_rate') ?? 0;
        $overallAchievement = $totalTarget > 0 ? round(($totalRealization / $totalTarget) * 100, 1) : 0;

        return view('revenue-streams.index', compact(
            'units',
            'revenueStreams',
            'totalRealization',
            'totalTarget',
            'topStream',
            'avgGrowth',
            'overallAchievement'
        ));
    }

    // Store a newly created revenue stream.
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
        ]);

        $totalAll = RevenueStream::sum('realization_amount') + $validated['realization_amount'];
        $validated['contribution_percentage'] = $totalAll > 0 
            ? round(($validated['realization_amount'] / $totalAll) * 100, 2) 
            : 0;

        $validated['growth_rate'] = $validated['growth_rate'] ?? 0;
        $validated['period'] = $validated['period'] ?? 'YTD 2026';
        $validated['status'] = 'Active';

        RevenueStream::create($validated);

        return back()->with('success', 'Revenue Stream berhasil ditambahkan!');
    }

    // Remove the specified revenue stream.
    public function destroy(RevenueStream $revenueStream)
    {
        $revenueStream->delete();

        return back()->with('success', 'Revenue Stream berhasil dihapus!');
    }
}
