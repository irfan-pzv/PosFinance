<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuditLogController extends Controller
{
    // Display a listing of system audit logs.
    public function index(Request $request)
    {
        if (!$request->user() || !$request->user()->canApprove()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Fitur Audit Log & Akses hanya dapat diakses oleh Manajer dan Supervisor Keuangan.');
        }

        $query = AuditLog::with('user')->latest();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                  ->orWhere('user_email', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%");
            });
        }

        // Action category filter
        if ($request->filled('action_type')) {
            $actionType = $request->input('action_type');
            if ($actionType === 'AUTH') {
                $query->whereIn('action', ['LOGIN', 'LOGOUT']);
            } elseif ($actionType === 'PROFILE') {
                $query->whereIn('action', ['UPDATE_PROFILE', 'CHANGE_PASSWORD', 'DELETE_AVATAR']);
            } elseif ($actionType === 'UNIT') {
                $query->whereIn('action', ['CREATE_UNIT', 'UPDATE_UNIT', 'DELETE_UNIT']);
            } elseif ($actionType === 'REVENUE') {
                $query->whereIn('action', ['CREATE_REVENUE', 'DELETE_REVENUE']);
            }
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $logs = $query->paginate(15)->withQueryString();

        // Summary stats metrics
        $stats = [
            'total' => AuditLog::count(),
            'login_today' => AuditLog::whereIn('action', ['LOGIN'])->whereDate('created_at', Carbon::today())->count(),
            'profile_updates' => AuditLog::whereIn('action', ['UPDATE_PROFILE', 'CHANGE_PASSWORD'])->count(),
            'data_modifications' => AuditLog::whereIn('action', ['CREATE_UNIT', 'UPDATE_UNIT', 'DELETE_UNIT', 'CREATE_REVENUE', 'DELETE_REVENUE'])->count(),
        ];

        return view('audit-logs.index', compact('logs', 'stats'));
    }
}
