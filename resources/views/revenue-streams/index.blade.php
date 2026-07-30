@extends('layouts.app')

@section('title', 'Revenue Streams & Analytics - Pos Indonesia Regional 4 Semarang')

@section('content')

    <!-- Revenue Streams Header Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 mb-6 border-b border-slate-200/80 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-md bg-orange-100 text-[#FF6600] font-bold text-[10px] uppercase tracking-wider">
                    Pos Indonesia Regional 4 Semarang
                </span>
                <span class="text-slate-400 text-xs">•</span>
                <span class="text-slate-500 text-xs font-semibold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Modul Analisis & Otorisasi Pendapatan
                </span>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#002B49] tracking-tight">
                Revenue Streams & Persetujuan Transaksi
            </h1>
            <p class="text-slate-500 text-xs mt-1">
                Pemetaan Jalur Pendapatan, Pengunggahan Bukti Transaksi, & Verifikasi Persetujuan Manajer Keuangan
            </p>
        </div>

        <!-- Actions Toolbar -->
        <div class="flex items-center gap-2.5 flex-wrap">
            <a href="{{ route('dashboard') }}" 
               class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 px-3.5 py-2 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition-all hover:border-slate-300">
                <i class="bi bi-arrow-left text-slate-400"></i> Kembali ke Dashboard
            </a>
            <button type="button" 
                    onclick="openAddModal()" 
                    class="bg-[#FF6600] hover:bg-[#E55C00] text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 shadow-md shadow-orange-500/20 transition-all hover:scale-[1.02]">
                <i class="bi bi-plus-circle"></i> Tambah Stream + Bukti
            </button>
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

    @if(session('warning'))
        <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <i class="bi bi-exclamation-circle-fill text-amber-600 text-base"></i>
                <span>{{ session('warning') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-amber-500 hover:text-amber-700">
                <i class="bi bi-x-lg text-xs"></i>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold shadow-sm">
            <div class="flex items-start gap-2">
                <i class="bi bi-exclamation-triangle-fill text-rose-600 text-base shrink-0"></i>
                <div>
                    <p class="font-bold mb-1">Gagal menyimpan data:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- 4 Summary KPI Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        
        <!-- KPI 1: Total Realization (Approved) -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-orange-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Realisasi Terverifikasi</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        Rp {{ number_format($totalRealization / 1000000000, 1, ',', '.') }} M
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF6600] border border-orange-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-check-circle-fill"></i> {{ $overallAchievement }}%
                </span>
                <span class="text-slate-400 font-medium">Realisasi RKAP Approved</span>
            </div>
        </div>

        <!-- KPI 2: Pending Approval Count -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-amber-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Menunggu Verifikasi</span>
                    <div class="text-2xl lg:text-3xl font-black text-amber-600 mt-1">
                        {{ $pendingCount }} <span class="text-xs font-bold text-slate-500">Transaksi</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-amber-700 font-bold">
                    Membutuhkan ACC Manajer
                </span>
                <span class="text-slate-400 font-medium">Approval Queue</span>
            </div>
        </div>

        <!-- KPI 3: Average Growth -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-emerald-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Rata-Rata Pertumbuhan</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        +{{ number_format($avgGrowth, 1, ',', '.') }}%
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-activity"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> Tren Positif
                </span>
                <span class="text-slate-400 font-medium">YoY Average</span>
            </div>
        </div>

        <!-- KPI 4: Target RKAP Total -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-purple-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Target RKAP Total</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        Rp {{ number_format($totalTarget / 1000000000, 1, ',', '.') }} M
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-bullseye"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-purple-600 font-bold">
                    Varians: {{ number_format(($totalRealization - $totalTarget) / 1000000000, 1, ',', '.') }} M
                </span>
                <span class="text-slate-400 font-medium">Tahun 2026</span>
            </div>
        </div>

    </div>

    <!-- Analytics Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-6">
        
        <!-- Stream Distribution Doughnut Chart -->
        <div class="lg:col-span-5 bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-4 sm:p-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                        <i class="bi bi-pie-chart-fill text-[#FF6600]"></i> Distribusi Omset per Revenue Stream
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Proporsi kontribusi pendapatan Regional 4 Semarang</p>
                </div>
            </div>
            <div class="p-4 sm:p-5 flex-grow flex items-center justify-center">
                <canvas id="streamDoughnutChart" class="w-full" style="max-height: 270px;"></canvas>
            </div>
        </div>

        <!-- Target vs Realization Bar Chart -->
        <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-4 sm:p-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                        <i class="bi bi-bar-chart-fill text-blue-600"></i> Target vs Realisasi per Channel
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Perbandingan angka RKAP dan capaian riil (dalam Miliar Rupiah)</p>
                </div>
            </div>
            <div class="p-4 sm:p-5 flex-grow">
                <canvas id="streamBarChart" class="w-full" style="max-height: 270px;"></canvas>
            </div>
        </div>

    </div>

    <!-- Revenue Streams Data Table Section -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden mb-6">
        
        <!-- Table Filter & Header Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                    <i class="bi bi-layers text-[#FF6600]"></i> Daftar Revenue Stream & Status Otorisasi
                </h3>
                <p class="text-slate-400 text-xs mt-0.5">Rincian pendapatan, lampiran bukti transaksi, dan status verifikasi persetujuan</p>
            </div>

            <!-- Filter Controls -->
            <form method="GET" action="{{ route('revenue-streams.index') }}" class="flex items-center gap-2.5 flex-wrap">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari Stream..." 
                           class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl pl-8 pr-3 py-1.5 focus:outline-none focus:border-[#FF6600] w-36 transition-all">
                    <i class="bi bi-search absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>

                <select name="approval_status" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-3 py-1.5 focus:outline-none focus:border-[#FF6600]">
                    <option value="">Semua Status ACC</option>
                    <option value="pending" {{ request('approval_status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                    <option value="approved" {{ request('approval_status') == 'approved' ? 'selected' : '' }}>Approved (Disetujui)</option>
                    <option value="rejected" {{ request('approval_status') == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                </select>

                <select name="category" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-3 py-1.5 focus:outline-none focus:border-[#FF6600]">
                    <option value="">Semua Kategori</option>
                    <option value="Kurir & Logistik" {{ request('category') == 'Kurir & Logistik' ? 'selected' : '' }}>Kurir & Logistik</option>
                    <option value="Jasa Keuangan" {{ request('category') == 'Jasa Keuangan' ? 'selected' : '' }}>Jasa Keuangan</option>
                    <option value="Kemitraan" {{ request('category') == 'Kemitraan' ? 'selected' : '' }}>Kemitraan</option>
                    <option value="Aset & Properti" {{ request('category') == 'Aset & Properti' ? 'selected' : '' }}>Aset & Properti</option>
                </select>
                @if(request('search') || request('category') || request('approval_status'))
                    <a href="{{ route('revenue-streams.index') }}" class="text-xs text-red-500 hover:underline font-semibold">Reset</a>
                @endif
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-50/80 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-5">Nama Revenue Stream</th>
                        <th class="py-3.5 px-4">Unit Penanggung Jawab</th>
                        <th class="py-3.5 px-4">Realisasi (YTD)</th>
                        <th class="py-3.5 px-4">Bukti Transaksi</th>
                        <th class="py-3.5 px-4">Status Persetujuan</th>
                        <th class="py-3.5 px-5 text-right">Otorisasi & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($revenueStreams as $stream)
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <!-- Stream Info -->
                            <td class="py-4 px-5">
                                <div>
                                    <div class="font-bold text-slate-800 text-xs flex items-center gap-1.5">
                                        {{ $stream->name }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 flex items-center gap-1.5 mt-0.5">
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-semibold">{{ $stream->category }}</span>
                                        <span>• Target: Rp {{ number_format($stream->target_amount / 1000000000, 1, ',', '.') }} M</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Unit -->
                            <td class="py-4 px-4 font-medium text-slate-700">
                                {{ $stream->unit->name ?? 'Kantor Regional 4' }}
                            </td>

                            <!-- Realisasi -->
                            <td class="py-4 px-4 font-bold text-slate-900">
                                Rp {{ number_format($stream->realization_amount, 0, ',', '.') }}
                            </td>

                            <!-- Bukti Transaksi -->
                            <td class="py-4 px-4">
                                @if($stream->proof_file_url)
                                    <a href="{{ $stream->proof_file_url }}" target="_blank" 
                                       class="px-2.5 py-1 text-[11px] font-bold bg-slate-100 hover:bg-slate-200 text-[#002B49] border border-slate-200 rounded-lg inline-flex items-center gap-1 transition-colors">
                                        <i class="bi bi-file-earmark-text text-[#FF6600]"></i> Lihat Bukti
                                    </a>
                                @else
                                    <span class="text-[10px] text-slate-400 italic">Tanpa Lampiran</span>
                                @endif
                            </td>

                            <!-- Approval Status -->
                            <td class="py-4 px-4">
                                @if($stream->approval_status === 'approved')
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center gap-1 w-fit">
                                        <i class="bi bi-check-circle-fill text-emerald-600"></i> Disetujui
                                    </span>
                                    @if($stream->approvedBy)
                                        <span class="text-[9px] text-slate-400 block mt-0.5">Oleh: {{ $stream->approvedBy->name }}</span>
                                    @endif
                                @elseif($stream->approval_status === 'rejected')
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-rose-100 text-rose-800 border border-rose-200 flex items-center gap-1 w-fit">
                                        <i class="bi bi-x-circle-fill text-rose-600"></i> Ditolak
                                    </span>
                                    @if($stream->rejection_reason)
                                        <span class="text-[9px] text-rose-600 block mt-0.5 max-w-[150px] truncate" title="{{ $stream->rejection_reason }}">
                                            Ket: {{ $stream->rejection_reason }}
                                        </span>
                                    @endif
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800 border border-amber-200 flex items-center gap-1 w-fit">
                                        <i class="bi bi-hourglass-split text-amber-600"></i> Menunggu ACC
                                    </span>
                                @endif
                            </td>

                            <!-- Actions & Approval Buttons -->
                            <td class="py-4 px-5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if(Auth::user() && Auth::user()->canApprove())
                                        @if($stream->approval_status === 'pending')
                                            <!-- Approve Button -->
                                            <form action="{{ route('revenue-streams.approve', $stream->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 text-[10px] font-bold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow-xs transition-colors flex items-center gap-1" title="Setujui Transaksi">
                                                    <i class="bi bi-check-lg"></i> Setujui
                                                </button>
                                            </form>

                                            <!-- Reject Button -->
                                            <button type="button" onclick="openRejectModal({{ $stream->id }}, '{{ addslashes($stream->name) }}')" 
                                                    class="px-2.5 py-1 text-[10px] font-bold bg-rose-600 hover:bg-rose-700 text-white rounded-lg shadow-xs transition-colors flex items-center gap-1" title="Tolak Transaksi">
                                                <i class="bi bi-x-lg"></i> Tolak
                                            </button>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('revenue-streams.destroy', $stream->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus revenue stream ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Hapus Stream">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] text-slate-400 italic">Lihat Saja</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 text-xs">
                                Tidak ada data Revenue Stream ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form: Tambah Revenue Stream Baru + Mandatory Proof File -->
    <div id="addStreamModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 border border-slate-100 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-[#FF6600]"></i> Tambah Stream & Bukti Transaksi
                </h3>
                <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form action="{{ route('revenue-streams.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Mandatory Proof File Upload Field -->
                <div class="p-3.5 bg-amber-50/90 border border-amber-200 rounded-xl space-y-1.5">
                    <label class="block text-xs font-bold text-amber-900 flex items-center justify-between">
                        <span>Bukti Transaksi (Kwitansi / Nota / Struk) <span class="text-rose-500">*</span></span>
                        <span class="text-[10px] text-amber-700 font-extrabold uppercase">Wajib Upload</span>
                    </label>
                    <input type="file" name="proof_file" id="proof_file" required accept="application/pdf, image/png, image/jpeg, image/webp" 
                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#002B49] file:text-white hover:file:bg-[#FF6600] file:transition-colors cursor-pointer">
                    <p class="text-[10px] text-slate-400">Format: PDF, PNG, JPG, WEBP (Maksimal 5MB).</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Revenue Stream <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Contoh: Pendapatan PosPay Loket Utama" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                            <option value="Kurir & Logistik">Kurir & Logistik</option>
                            <option value="Jasa Keuangan">Jasa Keuangan</option>
                            <option value="Kemitraan">Kemitraan</option>
                            <option value="Aset & Properti">Aset & Properti</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Unit Pengelola <span class="text-rose-500">*</span></label>
                        <select name="unit_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->code }} - {{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Target RKAP (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" step="1" name="target_amount" required placeholder="1000000000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Realisasi (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" step="1" name="realization_amount" required placeholder="850000000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Growth YoY (%)</label>
                        <input type="number" step="0.1" name="growth_rate" placeholder="8.5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Periode</label>
                        <input type="text" name="period" value="YTD 2026" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                    </div>
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#FF6600] text-white hover:bg-[#E55C00] shadow-sm">
                        Simpan & Ajukan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Form: Reject Transaction Reason -->
    <div id="rejectStreamModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 border border-slate-100 relative">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="font-bold text-base text-rose-700 flex items-center gap-2">
                    <i class="bi bi-x-circle-fill text-rose-600"></i> Tolak Transaksi Keuangan
                </h3>
                <button type="button" onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form id="rejectForm" method="POST" action="" class="space-y-4">
                @csrf
                <p class="text-xs text-slate-600">
                    Anda akan menolak transaksi <strong id="rejectStreamName"></strong>. Berikan catatan alasan penolakan di bawah ini:
                </p>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Alasan Penolakan <span class="text-rose-500">*</span></label>
                    <textarea name="rejection_reason" required rows="3" 
                              placeholder="Contoh: Bukti transaksi kwitansi tidak sesuai dengan nominal realisasi..." 
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-slate-800 focus:outline-none focus:border-rose-500"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 text-white hover:bg-rose-700 shadow-sm">
                        Tolak Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('addStreamModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addStreamModal').classList.add('hidden');
    }

    function openRejectModal(id, streamName) {
        const form = document.getElementById('rejectForm');
        form.action = `/revenue-streams/${id}/reject`;
        document.getElementById('rejectStreamName').innerText = streamName;
        document.getElementById('rejectStreamModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectStreamModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const streamData = @json($revenueStreams);
        const labels = streamData.map(s => s.name);
        const realizations = streamData.map(s => s.realization_amount / 1000000000);
        const targets = streamData.map(s => s.target_amount / 1000000000);

        const ctxDoughnut = document.getElementById('streamDoughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: realizations,
                    backgroundColor: ['#FF6600', '#0284C7', '#16A34A', '#8B5CF6', '#F59E0B'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 11, family: 'Plus Jakarta Sans' }, boxWidth: 12 }
                    }
                }
            }
        });

        const ctxBar = document.getElementById('streamBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Target RKAP (M)',
                        data: targets,
                        backgroundColor: '#CBD5E1',
                        borderRadius: 6
                    },
                    {
                        label: 'Realisasi YTD (M)',
                        data: realizations,
                        backgroundColor: '#FF6600',
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
                        labels: { font: { size: 11, family: 'Plus Jakarta Sans' } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(val) { return 'Rp ' + val + ' M'; },
                            font: { size: 10 }
                        }
                    },
                    x: {
                        ticks: { font: { size: 10 } }
                    }
                }
            }
        });
    });
</script>
@endpush
