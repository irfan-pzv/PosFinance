<aside id="sidebar" 
       class="w-[260px] min-w-[260px] bg-white border-r border-slate-200/80 h-[calc(100vh-65px)] sticky top-[65px] self-start overflow-y-auto p-4 flex flex-col justify-between transition-all duration-300 z-30 shadow-sm">
    
    <div>
        <!-- Section Header 1 -->
        <div class="uppercase text-slate-400 font-bold mb-3 px-2 text-[10px] tracking-widest flex items-center justify-between">
            <span>Modul Keuangan</span>
            <span class="w-1.5 h-1.5 bg-[#FF6600] rounded-full"></span>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-bold rounded-xl {{ request()->routeIs('dashboard') ? 'bg-[#FF6600] text-white shadow-md shadow-orange-500/20' : 'text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600]' }} transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-speedometer2 text-base {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-[#FF6600]' }}"></i>
                    <span>Executive Summary</span>
                </div>
                @if(request()->routeIs('dashboard'))
                    <i class="bi bi-chevron-right text-[10px] opacity-75"></i>
                @endif
            </a>

            <a href="{{ route('revenue-streams.index') }}" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-bold rounded-xl {{ request()->routeIs('revenue-streams.*') ? 'bg-[#FF6600] text-white shadow-md shadow-orange-500/20' : 'text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600]' }} transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-graph-up-arrow text-base {{ request()->routeIs('revenue-streams.*') ? 'text-white' : 'text-slate-400 group-hover:text-[#FF6600]' }}"></i>
                    <span>Revenue Streams</span>
                </div>
                @if(request()->routeIs('revenue-streams.*'))
                    <i class="bi bi-chevron-right text-[10px] opacity-75"></i>
                @endif
            </a>

            <a href="{{ route('units.index') }}" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-bold rounded-xl {{ request()->routeIs('units.*') ? 'bg-[#FF6600] text-white shadow-md shadow-orange-500/20' : 'text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600]' }} transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-building text-base {{ request()->routeIs('units.*') ? 'text-white' : 'text-slate-400 group-hover:text-[#FF6600]' }}"></i>
                    <span>Unit Regional 4</span>
                </div>
                @if(request()->routeIs('units.*'))
                    <i class="bi bi-chevron-right text-[10px] opacity-75"></i>
                @endif
            </a>

            <a href="#" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-semibold rounded-xl text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600] transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-pie-chart text-base text-slate-400 group-hover:text-[#FF6600] transition-colors"></i>
                    <span>Budget vs Actual</span>
                </div>
            </a>

            <a href="#" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-semibold rounded-xl text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600] transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-cash-stack text-base text-slate-400 group-hover:text-[#FF6600] transition-colors"></i>
                    <span>Cash Flow & Liquidity</span>
                </div>
            </a>

            <a href="#" 
               class="flex items-center justify-between px-3.5 py-2.5 text-xs font-semibold rounded-xl text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600] transition-all group">
                <div class="flex items-center gap-3">
                    <i class="bi bi-wallet2 text-base text-slate-400 group-hover:text-[#FF6600] transition-colors"></i>
                    <span>Cost Center & OpEx</span>
                </div>
            </a>

            @if(Auth::user() && Auth::user()->canApprove())
                <a href="#" 
                   class="flex items-center justify-between px-3.5 py-2.5 text-xs font-semibold rounded-xl text-slate-600 hover:bg-orange-50/70 hover:text-[#FF6600] transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-cpu text-base text-slate-400 group-hover:text-[#FF6600] transition-colors"></i>
                        <span>Predictive Analytics</span>
                    </div>
                    <span class="px-1.5 py-0.5 text-[9px] font-bold uppercase rounded bg-orange-100 text-[#FF6600]">AI</span>
                </a>
            @endif
        </nav>
    </div>

</aside>
