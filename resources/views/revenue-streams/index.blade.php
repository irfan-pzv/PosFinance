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
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Modul Analisis Pendapatan
                </span>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#002B49] tracking-tight">
                Revenue Streams & Stream Analytics
            </h1>
            <p class="text-slate-500 text-xs mt-1">
                Pemetaan Jalur Pendapatan, Kontribusi Sumber Omset & Realisasi RKAP Regional 4 Semarang
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
                <i class="bi bi-plus-circle"></i> Tambah Stream Baru
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

    <!-- 4 Summary KPI Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        
        <!-- KPI 1: Total Realization -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-orange-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Pendapatan Stream</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">
                        Rp {{ number_format($totalRealization / 1000000000, 1, ',', '.') }} M
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF6600] border border-orange-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-[#FF6600] bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> {{ $overallAchievement }}%
                </span>
                <span class="text-slate-400 font-medium">Realisasi Target</span>
            </div>
        </div>

        <!-- KPI 2: Top Stream -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Top Revenue Channel</span>
                    <div class="text-lg lg:text-xl font-black text-slate-900 mt-1 truncate max-w-[180px]" title="{{ $topStream->name ?? 'N/A' }}">
                        {{ $topStream->name ?? 'N/A' }}
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-trophy"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-blue-600 font-bold">
                    Rp {{ number_format(($topStream->realization_amount ?? 0) / 1000000000, 1, ',', '.') }} M
                </span>
                <span class="text-slate-400 font-medium">Kontribusi Utama</span>
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
                    <i class="bi bi-layers text-[#FF6600]"></i> Daftar Revenue Stream & Performansi
                </h3>
                <p class="text-slate-400 text-xs mt-0.5">Rincian pendapatan per kategori & unit penanggung jawab</p>
            </div>

            <!-- Filter Controls -->
            <form method="GET" action="{{ route('revenue-streams.index') }}" class="flex items-center gap-2.5 flex-wrap">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari Stream..." 
                           class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl pl-8 pr-3 py-1.5 focus:outline-none focus:border-[#FF6600] w-40 transition-all">
                    <i class="bi bi-search absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                <select name="category" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-3 py-1.5 focus:outline-none focus:border-[#FF6600]">
                    <option value="">Semua Kategori</option>
                    <option value="Kurir & Logistik" {{ request('category') == 'Kurir & Logistik' ? 'selected' : '' }}>Kurir & Logistik</option>
                    <option value="Jasa Keuangan" {{ request('category') == 'Jasa Keuangan' ? 'selected' : '' }}>Jasa Keuangan</option>
                    <option value="Kemitraan" {{ request('category') == 'Kemitraan' ? 'selected' : '' }}>Kemitraan</option>
                    <option value="Aset & Properti" {{ request('category') == 'Aset & Properti' ? 'selected' : '' }}>Aset & Properti</option>
                </select>
                @if(request('search') || request('category'))
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
                        <th class="py-3.5 px-4">Target RKAP</th>
                        <th class="py-3.5 px-4">Realisasi (YTD)</th>
                        <th class="py-3.5 px-4">Kontribusi (%)</th>
                        <th class="py-3.5 px-4">Pertumbuhan YoY</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($revenueStreams as $stream)
                        @php
                            $achievementPercent = $stream->target_amount > 0 
                                ? round(($stream->realization_amount / $stream->target_amount) * 100, 1) 
                                : 0;
                        @endphp
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="py-4 px-5">
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">{{ $stream->name }}</div>
                                    <div class="text-[10px] text-slate-400 flex items-center gap-1.5 mt-0.5">
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-semibold">{{ $stream->category }}</span>
                                        <span>• {{ $stream->period }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-medium text-slate-700">
                                {{ $stream->unit->name ?? 'Kantor Regional 4' }}
                            </td>
                            <td class="py-4 px-4 font-medium text-slate-600">
                                Rp {{ number_format($stream->target_amount / 1000000000, 1, ',', '.') }} M
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900">
                                Rp {{ number_format($stream->realization_amount / 1000000000, 1, ',', '.') }} M
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <div class="text-[11px] font-bold text-slate-800">{{ number_format($stream->contribution_percentage, 1, ',', '.') }}%</div>
                                    <div class="w-24 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-[#FF6600] h-full rounded-full" style="width: {{ min(100, $stream->contribution_percentage * 1.5) }}%;"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-bold {{ $stream->growth_rate >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $stream->growth_rate >= 0 ? '+' : '' }}{{ number_format($stream->growth_rate, 1, ',', '.') }}%
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-lg {{ $achievementPercent >= 100 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                    {{ $achievementPercent >= 100 ? 'Achieved' : 'In Progress' }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <form action="{{ route('revenue-streams.destroy', $stream->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus revenue stream ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Hapus Stream">
                                        <i class="bi bi-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-slate-400 text-xs">
                                Tidak ada data Revenue Stream ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form: Tambah Revenue Stream Baru -->
    <div id="addStreamModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 border border-slate-100 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-[#FF6600]"></i> Tambah Revenue Stream Baru
                </h3>
                <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form action="{{ route('revenue-streams.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Revenue Stream</label>
                    <input type="text" name="name" required placeholder="Contoh: Kargo Logistik Korporat" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                        <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                            <option value="Kurir & Logistik">Kurir & Logistik</option>
                            <option value="Jasa Keuangan">Jasa Keuangan</option>
                            <option value="Kemitraan">Kemitraan</option>
                            <option value="Aset & Properti">Aset & Properti</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Unit Pengelola</label>
                        <select name="unit_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->code }} - {{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Target RKAP (Rp)</label>
                        <input type="number" step="0.01" name="target_amount" required placeholder="10000000000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Realisasi YTD (Rp)</label>
                        <input type="number" step="0.01" name="realization_amount" required placeholder="10500000000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none focus:border-[#FF6600]">
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
                        Simpan Stream
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

    document.addEventListener('DOMContentLoaded', function() {
        // Chart 1: Doughnut Chart (Distribution)
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

        // Chart 2: Bar Chart (Target vs Realization)
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
