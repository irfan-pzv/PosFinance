@extends('layouts.app')

@section('title', 'Executive Financial Summary - Regional IV Semarang Selatan')

@section('content')

    <!-- Dashboard Header Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 mb-6 border-b border-slate-200/80 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-md bg-orange-100 text-[#FF6600] font-bold text-[10px] uppercase tracking-wider">
                    Regional IV Semarang Selatan
                </span>
                <span class="text-slate-400 text-xs">•</span>
                <span class="text-slate-500 text-xs font-semibold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> SAP ERP Reg. IV Sync
                </span>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-[#002B49] tracking-tight">
                Executive Financial Summary
            </h1>
            <p class="text-slate-500 text-xs mt-1">
                Command Center Kinerja & Realisasi Anggaran RKAP Kantor Pos Indonesia Regional IV Semarang Selatan
            </p>
        </div>

        <!-- Actions Toolbar -->
        <div class="flex items-center gap-2.5 flex-wrap">
            <button type="button" 
                    onclick="window.location.reload();" 
                    class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 px-3.5 py-2 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition-all hover:border-slate-300">
                <i class="bi bi-arrow-clockwise text-[#FF6600]"></i> Refresh Data
            </button>
            <button type="button" 
                    class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 px-3.5 py-2 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition-all hover:border-slate-300">
                <i class="bi bi-file-earmark-pdf text-red-500"></i> Export PDF
            </button>
            <button type="button" 
                    class="bg-[#FF6600] hover:bg-[#E55C00] text-white px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 shadow-md shadow-orange-500/20 transition-all hover:scale-[1.02]">
                <i class="bi bi-file-earmark-excel"></i> Laporan RKAP Semarang
            </button>
        </div>
    </div>

    <!-- 4 KPI Summary Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        
        <!-- KPI 1: Total Revenue -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-orange-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Pendapatan (YTD)</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">Rp 246,7 M</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF6600] border border-orange-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> +11.8%
                </span>
                <span class="text-slate-400 font-medium">vs RKAP Semarang</span>
            </div>
        </div>

        <!-- KPI 2: EBITDA -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">EBITDA Regional IV</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">Rp 42,5 M</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> +9.2%
                </span>
                <span class="text-slate-400 font-medium">YoY Growth</span>
            </div>
        </div>

        <!-- KPI 3: Net Profit -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-emerald-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Laba Bersih Operasional</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">Rp 21,8 M</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-piggy-bank"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-blue-600 font-bold flex items-center gap-1">
                    <i class="bi bi-check-circle-fill"></i> 103.4%
                </span>
                <span class="text-slate-400 font-medium">Target Semarang</span>
            </div>
        </div>

        <!-- KPI 4: Cash Position & Liquidity -->
        <div class="kpi-card bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-purple-500/10 to-transparent rounded-bl-full pointer-events-none"></div>
            <div class="flex justify-between items-start mb-3">
                <div>
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">Kas Operasional</span>
                    <div class="text-2xl lg:text-3xl font-black text-slate-900 mt-1">Rp 58,4 M</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-2xl shrink-0 shadow-sm">
                    <i class="bi bi-safe"></i>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-purple-600 font-bold flex items-center gap-1">
                    <i class="bi bi-shield-check"></i> Saldo Kas Semarang Aman
                </span>
                <span class="text-slate-400 font-medium">Likuiditas 1.52x</span>
            </div>
        </div>

    </div>

    <!-- Quick Revenue Stream Breakdown Bar -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm mb-6">
        <div class="flex items-center justify-between mb-2">
            <h4 class="font-bold text-xs uppercase tracking-wider text-slate-600 flex items-center gap-2">
                <i class="bi bi-pie-chart-fill text-[#FF6600]"></i> Kontribusi Pendapatan Unit Semarang Selatan
            </h4>
            <span class="text-slate-400 text-xs">Total 100% Realisasi Semarang (YTD)</span>
        </div>
        <div class="w-full bg-slate-100 rounded-xl h-3 flex overflow-hidden p-0.5">
            <div class="bg-[#FF6600] h-full transition-all" style="width: 58%;" title="Kurir & Kargo Express: 58%"></div>
            <div class="bg-[#0284C7] h-full transition-all" style="width: 27%;" title="Layanan PosPay & Jasa Keuangan: 27%"></div>
            <div class="bg-[#16A34A] h-full transition-all" style="width: 15%;" title="Keagenan & Loket Mitra: 15%"></div>
        </div>
        <div class="flex items-center justify-between gap-4 mt-3 text-xs flex-wrap">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-md bg-[#FF6600]"></span>
                <span class="font-semibold text-slate-700">Kurir & Kargo Express:</span>
                <span class="font-extrabold text-slate-900">Rp 143,1 M (58%)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-md bg-[#0284C7]"></span>
                <span class="font-semibold text-slate-700">PosPay & Jasa Keuangan:</span>
                <span class="font-extrabold text-slate-900">Rp 66,6 M (27%)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-md bg-[#16A34A]"></span>
                <span class="font-semibold text-slate-700">Keagenan & Loket Mitra:</span>
                <span class="font-extrabold text-slate-900">Rp 37,0 M (15%)</span>
            </div>
        </div>
    </div>

    <!-- Charts Row Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-6">
        
        <!-- Line Chart: Revenue Trend -->
        <div class="lg:col-span-7 xl:col-span-8 bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-4 sm:p-5 border-b border-slate-100 flex justify-between items-center flex-wrap gap-2">
                <div>
                    <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                        <i class="bi bi-bar-chart-line-fill text-[#FF6600]"></i> Tren Omset Bulanan Regional IV Semarang (2026)
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Perkembangan pendapatan Kurir, PosPay & Loket Mitra Semarang Selatan</p>
                </div>
                <span class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2.5 py-1 rounded-lg border border-slate-200/60">
                    Dalam Juta Rupiah
                </span>
            </div>
            <div class="p-4 sm:p-5 flex-grow">
                <canvas id="revenueChart" class="w-full" style="max-height: 310px;"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart: OpEx Structure -->
        <div class="lg:col-span-5 xl:col-span-4 bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-4 sm:p-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                        <i class="bi bi-pie-chart-fill text-red-500"></i> Struktur OpEx Semarang
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Proporsi Beban Operasional Kantor Pos Semarang</p>
                </div>
            </div>
            <div class="p-4 sm:p-5 flex-grow flex items-center justify-center relative">
                <canvas id="opexChart" class="w-full" style="max-height: 270px;"></canvas>
            </div>
        </div>

    </div>

    <!-- Operational Unit Table Section -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden mb-6">
        
        <!-- Table Header & Filter Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-base text-[#002B49] flex items-center gap-2">
                    <i class="bi bi-building text-[#FF6600]"></i> Kinerja Unit Operasional Semarang Selatan
                </h3>
                <p class="text-slate-400 text-xs mt-0.5">Realisasi Anggaran Per Divisi/Unit Kerja Pos Indonesia Semarang Selatan</p>
            </div>

            <!-- Search Table -->
            <div class="relative">
                <input type="text" 
                       id="tableSearch" 
                       placeholder="Cari Unit Kerja..." 
                       class="bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl pl-8 pr-3 py-1.5 focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600] w-48 transition-all">
                <i class="bi bi-search absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            </div>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse" id="regionalTable">
                <thead class="bg-slate-50/80 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-5">Unit / Divisi Kerja</th>
                        <th class="py-3.5 px-4">Target RKAP</th>
                        <th class="py-3.5 px-4">Realisasi (YTD)</th>
                        <th class="py-3.5 px-4">Varians</th>
                        <th class="py-3.5 px-4 w-56">Pencapaian RKAP (%)</th>
                        <th class="py-3.5 px-5">Status Kinerja</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    <!-- Row 1 -->
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-orange-100 text-[#FF6600] font-bold flex items-center justify-center text-xs">
                                    U1
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">Kantor Pos Utama Semarang (Pleburan)</div>
                                    <div class="text-[10px] text-slate-400">Jl. Pleburan / Semarang Selatan</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-600">Rp 85,0 M</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 89,2 M</td>
                        <td class="py-4 px-4 font-bold text-emerald-600">+Rp 4,2 M</td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-emerald-600">104.9%</div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-emerald-500 h-full rounded-full w-full"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Sangat Baik
                            </span>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 font-bold flex items-center justify-center text-xs">
                                    U2
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">Unit Kurir & Kargo Express</div>
                                    <div class="text-[10px] text-slate-400">Pengiriman Paket & Logistik Semarang</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-600">Rp 62,0 M</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 65,5 M</td>
                        <td class="py-4 px-4 font-bold text-emerald-600">+Rp 3,5 M</td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-emerald-600">105.6%</div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-emerald-500 h-full rounded-full w-full"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Sangat Baik
                            </span>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 font-bold flex items-center justify-center text-xs">
                                    U3
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">Unit Layanan PosPay & Jasa Keuangan</div>
                                    <div class="text-[10px] text-slate-400">Pembayaran, Remitansi & Keuangan</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-600">Rp 48,0 M</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 49,1 M</td>
                        <td class="py-4 px-4 font-bold text-emerald-600">+Rp 1,1 M</td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-blue-600">102.3%</div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-600 h-full rounded-full w-full"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg bg-blue-50 text-blue-700 border border-blue-200 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> On Track
                            </span>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 font-bold flex items-center justify-center text-xs">
                                    U4
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">Unit Keagenan & Loket Mitra</div>
                                    <div class="text-[10px] text-slate-400">Kemitraan Agen Pos Semarang Selatan</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-600">Rp 25,0 M</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 24,6 M</td>
                        <td class="py-4 px-4 font-bold text-red-600">-Rp 0,4 M</td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-amber-600">98.4%</div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-amber-500 h-full rounded-full" style="width: 98.4%;"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-700 border border-amber-200 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Evaluasi
                            </span>
                        </td>
                    </tr>

                    <!-- Row 5 -->
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 font-bold flex items-center justify-center text-xs">
                                    U5
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-xs">Unit Pengelolaan Aset & Properti</div>
                                    <div class="text-[10px] text-slate-400">Sewa Lahan & Gedung Pos Semarang</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-600">Rp 18,0 M</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 18,3 M</td>
                        <td class="py-4 px-4 font-bold text-emerald-600">+Rp 0,3 M</td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-blue-600">101.7%</div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-600 h-full rounded-full w-full"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg bg-blue-50 text-blue-700 border border-blue-200 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> On Track
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const defaultFont = { family: "'Plus Jakarta Sans', sans-serif" };

        // 1. Revenue Stream Trend Line Chart
        const revEl = document.getElementById('revenueChart');
        if (revEl) {
            const ctxRev = revEl.getContext('2d');
            
            const gradOrange = ctxRev.createLinearGradient(0, 0, 0, 300);
            gradOrange.addColorStop(0, 'rgba(255, 102, 0, 0.25)');
            gradOrange.addColorStop(1, 'rgba(255, 102, 0, 0.0)');

            const gradBlue = ctxRev.createLinearGradient(0, 0, 0, 300);
            gradBlue.addColorStop(0, 'rgba(2, 132, 199, 0.2)');
            gradBlue.addColorStop(1, 'rgba(2, 132, 199, 0.0)');

            const gradGreen = ctxRev.createLinearGradient(0, 0, 0, 300);
            gradGreen.addColorStop(0, 'rgba(22, 163, 74, 0.2)');
            gradGreen.addColorStop(1, 'rgba(22, 163, 74, 0.0)');

            new Chart(ctxRev, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
                    datasets: [
                        {
                            label: 'Kurir & Kargo Express',
                            data: [12500, 13800, 15200, 14900, 16300, 17800, 17100, 18500, 19200],
                            borderColor: '#FF6600',
                            borderWidth: 3,
                            backgroundColor: gradOrange,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#FF6600',
                            pointBorderColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'PosPay & Jasa Keuangan',
                            data: [5800, 6200, 6900, 7400, 7900, 8400, 8800, 9300, 9800],
                            borderColor: '#0284C7',
                            borderWidth: 2.5,
                            backgroundColor: gradBlue,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#0284C7',
                            pointBorderColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointRadius: 3.5,
                            pointHoverRadius: 5
                        },
                        {
                            label: 'Keagenan & Loket Mitra',
                            data: [3100, 3300, 3600, 3500, 3800, 4100, 4300, 4500, 4700],
                            borderColor: '#16A34A',
                            borderWidth: 2,
                            backgroundColor: gradGreen,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#16A34A',
                            pointBorderColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointRadius: 3.5,
                            pointHoverRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { 
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: { ...defaultFont, size: 12, weight: '600' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#002B49',
                            titleFont: { ...defaultFont, size: 12, weight: 'bold' },
                            bodyFont: { ...defaultFont, size: 11 },
                            padding: 10,
                            cornerRadius: 10,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': Rp ' + (context.parsed.y / 1000).toFixed(1) + ' Miliar';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { ...defaultFont, size: 11 } }
                        },
                        y: {
                            border: { dash: [4, 4] },
                            grid: { color: '#F1F5F9' },
                            ticks: { 
                                font: { ...defaultFont, size: 11 },
                                callback: function(value) { return 'Rp ' + (value / 1000) + ' M'; }
                            }
                        }
                    }
                }
            });
        }

        // 2. OpEx Doughnut Chart
        const opexEl = document.getElementById('opexChart');
        if (opexEl) {
            new Chart(opexEl.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Beban Operasional Paket', 'Beban Gaji & SDM Semarang', 'Komisi Agen Pos Loket', 'Pemeliharaan Gedung & IT', 'Biaya Umum & Kantor'],
                    datasets: [{
                        data: [38, 32, 14, 10, 6],
                        backgroundColor: ['#FF6600', '#0284C7', '#16A34A', '#EAB308', '#8B5CF6'],
                        borderWidth: 3,
                        borderColor: '#FFFFFF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                usePointStyle: true,
                                boxWidth: 8, 
                                font: { ...defaultFont, size: 11, weight: '500' } 
                            } 
                        },
                        tooltip: {
                            backgroundColor: '#002B49',
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        }

        // 3. Search Filter for Semarang Units Table
        const searchInput = document.getElementById('tableSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                document.querySelectorAll('#regionalTable tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush
