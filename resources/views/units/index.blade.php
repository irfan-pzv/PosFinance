@extends('layouts.app')

@section('title', 'Unit Kerja Regional 4 - Pos Indonesia Regional 4 Semarang')

@section('content')

    <!-- Unit Regional 4 Header Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 mb-6 border-b border-slate-200/80 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-md bg-orange-100 text-[#FF6600] font-bold text-[10px] uppercase tracking-wider">
                    Pos Indonesia Regional 4 Semarang
                </span>
                <span class="text-slate-400 text-xs">•</span>
                <span class="text-slate-500 text-xs font-semibold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Modul Performa Unit Kerja
                </span>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#002B49] tracking-tight">
                Unit Regional 4 Semarang
            </h1>
            <p class="text-slate-500 text-xs mt-1">
                Manajemen Unit Kerja, Pengawasan Target RKAP & Realisasi Anggaran Kantor Regional 4 Semarang
            </p>
        </div>

        <!-- Actions Toolbar -->
        <div class="flex items-center gap-2.5 flex-wrap">
            <a href="{{ route('dashboard') }}" 
               class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 px-3.5 py-2 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition-all hover:border-slate-300">
                <i class="bi bi-arrow-left text-slate-400"></i> Kembali ke Dashboard
            </a>
            @if(Auth::user() && Auth::user()->canApprove())
                <button type="button" 
                        onclick="openAddModal()" 
                        class="bg-[#FF6600] hover:bg-[#E55C00] text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 shadow-md shadow-orange-500/20 transition-all hover:scale-[1.02]">
                    <i class="bi bi-plus-circle"></i> Tambah Unit Baru
                </button>
            @endif
        </div>
    </div>

    <!-- Alert Success Notification -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <i class="bi bi-check-circle-fill text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    <!-- 4 KPI Summary Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        
        <!-- KPI 1: Total Unit -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-orange-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Unit Kerja</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        {{ $totalUnits }} <span class="text-xs font-semibold text-slate-500">Unit</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF6600] border border-orange-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-building"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-check-circle-fill"></i> {{ $activeUnits }} Unit Aktif
                </span>
                <span class="text-slate-400 font-medium">Status Operasional</span>
            </div>
        </div>

        <!-- KPI 2: Target RKAP -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Target RKAP Regional 4</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        Rp {{ number_format($totalTarget / 1000000000, 1, ',', '.') }} M
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-bullseye"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-blue-600 font-bold">Periode 2026</span>
                <span class="text-slate-400 font-medium">Anggaran RKAP</span>
            </div>
        </div>

        <!-- KPI 3: Realisasi RKAP -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-emerald-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Realisasi Anggaran</span>
                    <div class="text-2xl lg:text-3xl font-black text-emerald-600 mt-1">
                        Rp {{ number_format($totalRealization / 1000000000, 1, ',', '.') }} M
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="{{ $totalVariance >= 0 ? 'text-emerald-600' : 'text-red-500' }} font-bold">
                    {{ $totalVariance >= 0 ? '+' : '' }}Rp {{ number_format($totalVariance / 1000000000, 1, ',', '.') }} M
                </span>
                <span class="text-slate-400 font-medium">Deviasi RKAP</span>
            </div>
        </div>

        <!-- KPI 4: Overall Achievement -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-purple-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Pencapaian RKAP</span>
                    <div class="text-2xl lg:text-3xl font-black text-purple-700 mt-1">
                        {{ $overallAchievement }}%
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-purple-600 font-bold">Rata-Rata Regional</span>
                <span class="text-slate-400 font-medium">Pencapaian Total</span>
            </div>
        </div>

    </div>

    <!-- Visual Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Bar Chart: Perbandingan Target vs Realisasi -->
        <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-bar-chart-line-fill text-[#FF6600]"></i> Perbandingan Target vs Realisasi Per Unit Regional 4
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Capaian finansial per unit kerja terhadap RKAP 2026</p>
                </div>
            </div>
            <div class="h-64 relative">
                <canvas id="unitPerformanceChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart: Distribusi Kategori Unit -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-800 flex items-center gap-2 mb-1">
                    <i class="bi bi-pie-chart-fill text-blue-600"></i> Distribusi Kategori Unit
                </h3>
                <p class="text-slate-400 text-xs mb-4">Komposisi sektor unit kerja Regional 4</p>
            </div>
            <div class="h-56 relative flex items-center justify-center">
                <canvas id="unitCategoryChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Data Table & Filter Container -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden mb-8">
        
        <!-- Filter Toolbar -->
        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-[#002B49] flex items-center gap-2">
                    <i class="bi bi-list-stars text-[#FF6600]"></i> Daftar Unit Kerja Regional 4 Semarang
                </h2>
                <p class="text-slate-400 text-xs mt-0.5">Kelola informasi unit, penanggung jawab, dan performa RKAP</p>
            </div>

            <!-- Search & Filters -->
            <form action="{{ route('units.index') }}" method="GET" class="flex items-center gap-2.5 flex-wrap">
                <!-- Search Box -->
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari Unit / Code / PIC..." 
                           class="pl-8 pr-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-[#FF6600] focus:outline-none w-48 shadow-sm">
                </div>

                <!-- Category Filter -->
                <select name="category" onchange="this.form.submit()" class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-[#FF6600] focus:outline-none shadow-sm text-slate-700">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <!-- Status Filter -->
                <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-[#FF6600] focus:outline-none shadow-sm text-slate-700">
                    <option value="">Semua Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                @if(request()->hasAny(['search', 'category', 'status']))
                    <a href="{{ route('units.index') }}" class="px-3 py-1.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold rounded-xl transition-all flex items-center gap-1">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100/70 border-b border-slate-200/80 text-slate-600 font-bold uppercase tracking-wider">
                        <th class="py-3.5 px-4">Kode Unit</th>
                        <th class="py-3.5 px-4">Nama Unit Kerja</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Penanggung Jawab (PIC)</th>
                        <th class="py-3.5 px-4 text-right">Target RKAP</th>
                        <th class="py-3.5 px-4 text-right">Realisasi</th>
                        <th class="py-3.5 px-4 text-center">Achievement</th>
                        <th class="py-3.5 px-4 text-center">Status Unit</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($units as $unit)
                        @php
                            $latestFinance = $unit->finances->first();
                            $target = $latestFinance->target_rkap ?? 0;
                            $realization = $latestFinance->realization ?? 0;
                            $achievement = $target > 0 ? round(($realization / $target) * 100, 1) : 0;
                            $statusPerf = $latestFinance->performance_status ?? 'N/A';
                        @endphp
                        <tr class="hover:bg-orange-50/40 transition-colors group">
                            <td class="py-3.5 px-4 font-extrabold text-[#002B49]">
                                <span class="px-2 py-1 rounded bg-slate-100 text-slate-800 font-mono text-[11px] border border-slate-200">
                                    {{ $unit->code }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 text-xs group-hover:text-[#FF6600] transition-colors">
                                    {{ $unit->name }}
                                </div>
                                <div class="text-[11px] text-slate-400 max-w-xs truncate" title="{{ $unit->description }}">
                                    {{ $unit->description ?? '-' }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $unit->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                <div class="flex items-center gap-1.5">
                                    <i class="bi bi-person-circle text-slate-400 text-xs"></i>
                                    <span>{{ $unit->person_in_charge }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-right font-semibold text-slate-700">
                                Rp {{ number_format($target, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 text-right font-bold text-emerald-600">
                                Rp {{ number_format($realization, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <span class="font-black text-xs {{ $achievement >= 100 ? 'text-emerald-600' : 'text-amber-600' }}">
                                        {{ $achievement }}%
                                    </span>
                                    <span class="text-[9px] px-1.5 py-0.5 rounded font-semibold mt-0.5 {{ $achievement >= 104 ? 'bg-emerald-100 text-emerald-800' : ($achievement >= 100 ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
                                        {{ $statusPerf }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($unit->status === 'Active')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if(Auth::user() && Auth::user()->canApprove())
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick='openEditModal(@json($unit), @json($latestFinance))'
                                                class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-orange-100 hover:text-[#FF6600] text-slate-600 flex items-center justify-center transition-all shadow-sm"
                                                title="Edit Unit">
                                            <i class="bi bi-pencil-square text-xs"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="openDeleteModal({{ $unit->id }}, '{{ addslashes($unit->name) }}')"
                                                class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-red-100 hover:text-red-600 text-slate-600 flex items-center justify-center transition-all shadow-sm"
                                                title="Hapus Unit">
                                            <i class="bi bi-trash text-xs"></i>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[10px] text-slate-400 italic">Lihat Saja</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 text-center text-slate-400 text-xs">
                                <i class="bi bi-inbox text-3xl block mb-2 opacity-50"></i>
                                Tidak ada data Unit Regional 4 yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Unit Regional 4 -->
    <div id="addUnitModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
            <div class="bg-[#002B49] px-6 py-4 flex items-center justify-between text-white">
                <h3 class="font-bold text-sm flex items-center gap-2">
                    <i class="bi bi-building-add text-[#FF6600]"></i> Tambah Unit Regional 4 Baru
                </h3>
                <button onclick="closeAddModal()" class="text-slate-400 hover:text-white transition-colors">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form action="{{ route('units.store') }}" method="POST" class="p-6 space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kode Unit *</label>
                        <input type="text" name="code" required placeholder="Contoh: U6" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
                        <input type="text" name="category" required placeholder="Contoh: Logistik / Kurir" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Unit Kerja *</label>
                    <input type="text" name="name" required placeholder="Nama lengkap unit kerja" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Penanggung Jawab (PIC) *</label>
                        <input type="text" name="person_in_charge" required placeholder="Manajer / Supervisor" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Status *</label>
                        <select name="status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Deskripsi Unit</label>
                    <textarea name="description" rows="2" placeholder="Keterangan tugas dan cakupan unit..." class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none"></textarea>
                </div>

                <div class="border-t border-slate-100 pt-3">
                    <span class="font-bold text-[#002B49] block mb-2">Anggaran & Realisasi RKAP (Awal)</span>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1">Target RKAP (Rp)</label>
                            <input type="number" name="target_rkap" step="1000" placeholder="0" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1">Realisasi (Rp)</label>
                            <input type="number" name="realization" step="1000" placeholder="0" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#FF6600] hover:bg-[#E55C00] text-white font-bold rounded-xl shadow-md shadow-orange-500/20 transition-all">
                        Simpan Unit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Unit Regional 4 -->
    <div id="editUnitModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
            <div class="bg-[#002B49] px-6 py-4 flex items-center justify-between text-white">
                <h3 class="font-bold text-sm flex items-center gap-2">
                    <i class="bi bi-pencil-square text-[#FF6600]"></i> Edit Data Unit Regional 4
                </h3>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-white transition-colors">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form id="editUnitForm" method="POST" class="p-6 space-y-4 text-xs">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kode Unit *</label>
                        <input type="text" id="edit_code" name="code" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
                        <input type="text" id="edit_category" name="category" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Unit Kerja *</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Penanggung Jawab (PIC) *</label>
                        <input type="text" id="edit_person_in_charge" name="person_in_charge" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Status *</label>
                        <select id="edit_status" name="status" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Deskripsi Unit</label>
                    <textarea id="edit_description" name="description" rows="2" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none"></textarea>
                </div>

                <div class="border-t border-slate-100 pt-3">
                    <span class="font-bold text-[#002B49] block mb-2">Anggaran & Realisasi RKAP</span>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1">Target RKAP (Rp)</label>
                            <input type="number" id="edit_target_rkap" name="target_rkap" step="1000" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1">Realisasi (Rp)</label>
                            <input type="number" id="edit_realization" name="realization" step="1000" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#FF6600] focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#FF6600] hover:bg-[#E55C00] text-white font-bold rounded-xl shadow-md shadow-orange-500/20 transition-all">
                        Update Unit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Unit -->
    <div id="deleteUnitModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full shadow-2xl overflow-hidden p-6 text-center animate-in fade-in zoom-in duration-200">
            <div class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h3 class="font-extrabold text-base text-slate-900 mb-1">Hapus Unit Regional 4?</h3>
            <p class="text-xs text-slate-500 mb-5">
                Apakah Anda yakin ingin menghapus unit <strong id="deleteUnitName" class="text-slate-800"></strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="deleteUnitForm" method="POST" class="flex items-center justify-center gap-3 text-xs">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">
                    Batal
                </button>
                <button type="submit" class="w-1/2 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-md shadow-red-600/20 transition-all">
                    Hapus
                </button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('addUnitModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addUnitModal').classList.add('hidden');
    }

    function openEditModal(unit, finance) {
        const form = document.getElementById('editUnitForm');
        form.action = `/units/${unit.id}`;

        document.getElementById('edit_code').value = unit.code || '';
        document.getElementById('edit_name').value = unit.name || '';
        document.getElementById('edit_category').value = unit.category || '';
        document.getElementById('edit_person_in_charge').value = unit.person_in_charge || '';
        document.getElementById('edit_description').value = unit.description || '';
        document.getElementById('edit_status').value = unit.status || 'Active';

        document.getElementById('edit_target_rkap').value = finance ? finance.target_rkap : 0;
        document.getElementById('edit_realization').value = finance ? finance.realization : 0;

        document.getElementById('editUnitModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editUnitModal').classList.add('hidden');
    }

    function openDeleteModal(unitId, unitName) {
        const form = document.getElementById('deleteUnitForm');
        form.action = `/units/${unitId}`;
        document.getElementById('deleteUnitName').textContent = unitName;
        document.getElementById('deleteUnitModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteUnitModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Prepare Chart Data from PHP
        const unitData = @json($units);

        const labels = unitData.map(u => u.code);
        const targets = unitData.map(u => {
            return u.finances && u.finances.length > 0 ? u.finances[0].target_rkap / 1000000000 : 0;
        });
        const realizations = unitData.map(u => {
            return u.finances && u.finances.length > 0 ? u.finances[0].realization / 1000000000 : 0;
        });

        // Bar Chart (Target vs Realisasi)
        const ctxBar = document.getElementById('unitPerformanceChart');
        if (ctxBar) {
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Target RKAP (Miliar Rp)',
                            data: targets,
                            backgroundColor: 'rgba(203, 213, 225, 0.8)',
                            borderColor: '#94A3B8',
                            borderWidth: 1,
                            borderRadius: 6
                        },
                        {
                            label: 'Realisasi (Miliar Rp)',
                            data: realizations,
                            backgroundColor: 'rgba(255, 102, 0, 0.85)',
                            borderColor: '#FF6600',
                            borderWidth: 1,
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { family: 'Plus Jakarta Sans', size: 11 } }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#F1F5F9' },
                            ticks: { font: { family: 'Plus Jakarta Sans', size: 10 } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Plus Jakarta Sans', size: 10 } }
                        }
                    }
                }
            });
        }

        // Category Chart (Doughnut)
        const categoryCounts = {};
        unitData.forEach(u => {
            categoryCounts[u.category] = (categoryCounts[u.category] || 0) + 1;
        });

        const ctxCat = document.getElementById('unitCategoryChart');
        if (ctxCat) {
            new Chart(ctxCat, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(categoryCounts),
                    datasets: [{
                        data: Object.values(categoryCounts),
                        backgroundColor: [
                            '#FF6600',
                            '#0284C7',
                            '#10B981',
                            '#8B5CF6',
                            '#F59E0B'
                        ],
                        borderWidth: 2,
                        borderColor: '#FFFFFF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: { family: 'Plus Jakarta Sans', size: 10 } }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    });
</script>
@endpush
