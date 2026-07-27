<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Finance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Display the executive financial summary dashboard.
    public function index()
    {
        // Retrieve units with their latest financial records
        $units = Unit::with(['finances' => function ($query) {
            $query->orderBy('year', 'desc');
        }])->get();

        // Calculate summary metrics dynamically
        $totalRevenue = Finance::sum('realization');
        $totalTarget = Finance::sum('target_rkap');
        $totalVariance = $totalRevenue - $totalTarget;
        $overallAchievement = $totalTarget > 0 ? round(($totalRevenue / $totalTarget) * 100, 1) : 0;

        // Additional KPI metrics (can be calculated or defined dynamically)
        $ebitda = 42500000000; // Rp 42,5 M
        $netProfit = 21800000000; // Rp 21,8 M
        $cashPosition = 58400000000; // Rp 58,4 M

        return view('dashboard', compact(
            'units',
            'totalRevenue',
            'totalTarget',
            'totalVariance',
            'overallAchievement',
            'ebitda',
            'netProfit',
            'cashPosition'
        ));
    }
}
