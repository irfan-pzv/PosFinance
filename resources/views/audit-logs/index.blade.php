@extends('layouts.app')

@section('title', 'Audit Log & Akses - POS FINANCE Regional 4 Semarang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header & Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-[#FF6600] transition-colors">Dashboard</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-slate-800 font-bold">Audit Log & Akses</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2.5">
                <i class="bi bi-shield-check text-[#FF6600] text-2xl"></i>
                Audit Log & Rekam Aktivitas
            </h1>
            <p class="text-xs text-slate-500 mt-1">Pemantauan riwayat aktivitas pengguna, sesi login, dan rekam jejak perubahan data sistem secara real-time.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Summary KPI Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Log -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Log Aktivitas</span>
                <span class="text-2xl font-black text-slate-800">{{ number_format($stats['total']) }}</span>
                <span class="text-[10px] text-slate-400 block mt-0.5">Tercatat di database</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
                <i class="bi bi-journal-text"></i>
            </div>
        </div>

        <!-- Login Today -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Sesi Login Hari Ini</span>
                <span class="text-2xl font-black text-emerald-600">{{ number_format($stats['login_today']) }}</span>
                <span class="text-[10px] text-emerald-700 font-medium block mt-0.5">Akses masuk hari ini</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
        </div>

        <!-- Profile & Security Updates -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Aktivitas Profil & Akses</span>
                <span class="text-2xl font-black text-purple-600">{{ number_format($stats['profile_updates']) }}</span>
                <span class="text-[10px] text-purple-700 font-medium block mt-0.5">Update akun & password</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shrink-0">
                <i class="bi bi-person-gear"></i>
            </div>
        </div>

        <!-- Data Modifications -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Perubahan Data</span>
                <span class="text-2xl font-black text-[#FF6600]">{{ number_format($stats['data_modifications']) }}</span>
                <span class="text-[10px] text-orange-700 font-medium block mt-0.5">Unit & Revenue Stream</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF6600] flex items-center justify-center text-xl shrink-0">
                <i class="bi bi-database-check"></i>
            </div>
        </div>

    </div>

    <!-- Filter & Search Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-5">
        <form method="GET" action="{{ route('audit-logs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            
            <!-- Search Text -->
            <div class="space-y-1.5 md:col-span-1">
                <label class="block text-xs font-bold text-slate-700">Cari Log / Pengguna</label>
                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                    <span class="pl-3 pr-2 text-slate-400 text-sm">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, deskripsi..."
                           class="w-full py-2 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                </div>
            </div>

            <!-- Kategori Aksi -->
            <div class="space-y-1.5 md:col-span-1">
                <label class="block text-xs font-bold text-slate-700">Kategori Aktivitas</label>
                <select name="action_type" 
                        class="w-full py-2 px-3 text-xs font-semibold text-slate-800 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600] transition-colors">
                    <option value="">Semua Kategori Aktivitas</option>
                    <option value="AUTH" {{ request('action_type') === 'AUTH' ? 'selected' : '' }}>Login & Logout</option>
                    <option value="PROFILE" {{ request('action_type') === 'PROFILE' ? 'selected' : '' }}>Profil & Keamanan</option>
                    <option value="UNIT" {{ request('action_type') === 'UNIT' ? 'selected' : '' }}>Unit Operasional</option>
                    <option value="REVENUE" {{ request('action_type') === 'REVENUE' ? 'selected' : '' }}>Revenue Stream</option>
                </select>
            </div>

            <!-- Filter Tanggal Dari - Sampai -->
            <div class="space-y-1.5 md:col-span-1">
                <label class="block text-xs font-bold text-slate-700">Rentang Tanggal</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="w-full py-2 px-2.5 text-xs font-semibold text-slate-800 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600]">
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="w-full py-2 px-2.5 text-xs font-semibold text-slate-800 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600]">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2 md:col-span-1">
                <button type="submit" class="flex-1 py-2 px-4 bg-[#FF6600] hover:bg-[#e55c00] text-white font-bold text-xs rounded-xl shadow-md shadow-orange-500/20 transition-all flex items-center justify-center gap-2">
                    <i class="bi bi-filter"></i> Terapkan Filter
                </button>
                @if(request()->anyFilled(['search', 'action_type', 'date_from', 'date_to']))
                    <a href="{{ route('audit-logs.index') }}" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs rounded-xl transition-all" title="Reset Filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Audit Logs Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md overflow-hidden">
        
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-extrabold text-slate-800 flex items-center gap-2">
                <i class="bi bi-list-columns-reverse text-[#FF6600]"></i> Riwayat Audit Log Terbaru
            </h3>
            <span class="text-xs text-slate-400 font-medium">Menampilkan {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} log</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 uppercase font-bold text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3.5">Waktu & Tanggal</th>
                        <th class="px-5 py-3.5">Pengguna</th>
                        <th class="px-5 py-3.5">Kategori / Aksi</th>
                        <th class="px-5 py-3.5">Deskripsi Aktivitas</th>
                        <th class="px-5 py-3.5">Perangkat & IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <!-- Waktu -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-800">{{ $log->created_at ? $log->created_at->format('H:i:s \W\I\B') : '-' }}</div>
                                <div class="text-[10px] text-slate-400">{{ $log->created_at ? $log->created_at->format('d M Y') : '-' }}</div>
                            </td>

                            <!-- Pengguna -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#FF6600] to-amber-500 text-white flex items-center justify-center font-bold text-xs shrink-0 overflow-hidden shadow-xs">
                                        @if($log->user && $log->user->avatar_url)
                                            <img src="{{ $log->user->avatar_url }}" alt="{{ $log->user_name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($log->user_name ?? 'U', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-800">{{ $log->user_name }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $log->user_email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori / Aksi -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if(in_array($log->action, ['LOGIN']))
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-full flex items-center gap-1 w-fit">
                                        <i class="bi bi-box-arrow-in-right text-emerald-600"></i> LOGIN
                                    </span>
                                @elseif(in_array($log->action, ['LOGOUT']))
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200 rounded-full flex items-center gap-1 w-fit">
                                        <i class="bi bi-box-arrow-right text-slate-500"></i> LOGOUT
                                    </span>
                                @elseif(in_array($log->action, ['UPDATE_PROFILE', 'CHANGE_PASSWORD', 'DELETE_AVATAR']))
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-purple-100 text-purple-800 border border-purple-200 rounded-full flex items-center gap-1 w-fit">
                                        <i class="bi bi-person-check text-purple-600"></i> PROFIL / AKUN
                                    </span>
                                @elseif(in_array($log->action, ['CREATE_UNIT', 'UPDATE_UNIT', 'DELETE_UNIT']))
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-blue-100 text-blue-800 border border-blue-200 rounded-full flex items-center gap-1 w-fit">
                                        <i class="bi bi-building text-blue-600"></i> DATA UNIT
                                    </span>
                                @elseif(in_array($log->action, ['CREATE_REVENUE', 'DELETE_REVENUE']))
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-orange-100 text-[#FF6600] border border-orange-200 rounded-full flex items-center gap-1 w-fit">
                                        <i class="bi bi-graph-up-arrow text-[#FF6600]"></i> REVENUE
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-bold bg-slate-100 text-slate-800 border border-slate-200 rounded-full w-fit">
                                        {{ $log->action }}
                                    </span>
                                @endif
                            </td>

                            <!-- Deskripsi -->
                            <td class="px-5 py-4">
                                <span class="font-medium text-slate-700 leading-relaxed block max-w-md">
                                    {{ $log->description }}
                                </span>
                            </td>

                            <!-- IP & Perangkat -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-mono text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                    <i class="bi bi-laptop text-slate-400"></i> {{ $log->ip_address ?? '127.0.0.1' }}
                                </div>
                                <div class="text-[10px] text-slate-400 truncate max-w-[180px]" title="{{ $log->user_agent }}">
                                    {{ Str::limit($log->user_agent, 25) }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center text-xl mx-auto mb-3">
                                    <i class="bi bi-search"></i>
                                </div>
                                <p class="font-bold text-slate-600 text-xs">Tidak Ada Log Aktivitas Ditemukan</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Coba ubah kata kunci pencarian atau filter rentang tanggal Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $logs->links() }}
        </div>

    </div>

</div>
@endsection
