<header class="bg-[#002B49] border-b-4 border-[#FF6600] sticky top-0 z-50 shadow-lg">
    <div class="max-w-full px-4 lg:px-6 py-2.5 flex items-center justify-between gap-4">
        
        <!-- Left: Brand & Sidebar Toggle -->
        <div class="flex items-center gap-3">
            <button id="sidebarToggle" type="button" 
                    class="text-white/80 hover:text-[#FF6600] hover:bg-white/10 p-2 rounded-xl transition-all text-xl flex items-center justify-center focus:outline-none" 
                    title="Buka/Tutup Sidebar" aria-label="Toggle Sidebar">
                <i class="bi bi-layout-sidebar-inset"></i>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group no-underline">
                <div class="bg-[#FF6600] text-white rounded-lg px-2.5 py-1 font-black text-sm shadow-md shadow-orange-600/30 group-hover:scale-105 transition-transform">
                    POS
                </div>
                <div class="flex flex-col">
                    <span class="text-lg tracking-tight text-white font-extrabold leading-none flex items-center gap-1.5">
                        FINANCE 
                        <span class="bg-white/10 text-white/80 text-[10px] font-semibold px-2 py-0.5 rounded-full hidden sm:inline-block border border-white/10">
                            REGIONAL 4 SEMARANG
                        </span>
                    </span>
                    <span class="text-[10px] text-white/60 font-medium tracking-wide">POS INDONESIA - JL. SISINGAMANGARAJA NO.45</span>
                </div>
            </a>
        </div>

        <!-- Right: Navbar Filters & User Profile -->
        <div class="flex items-center gap-3">
            
            <!-- Filter Unit Operasional Semarang -->
            <div class="hidden lg:block relative">
                <select class="bg-slate-900/90 text-white text-xs border border-slate-700/80 rounded-xl px-3 py-1.5 pr-8 focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600] transition-colors appearance-none cursor-pointer">
                    <option selected>Regional 4 Semarang (Seluruh Unit)</option>
                    <option>Kantor Regional 4 (Jl. Sisingamangaraja No.45)</option>
                    <option>Unit Kurir & Kargo Express Reg. 4</option>
                    <option>Unit Layanan PosPay & Keuangan Reg. 4</option>
                    <option>Unit Keagenan & Loket Mitra Reg. 4</option>
                </select>
                <i class="bi bi-chevron-down absolute right-2.5 top-1/2 -translate-y-1/2 text-white/50 text-[10px] pointer-events-none"></i>
            </div>

            <!-- Filter Periode / RKAP -->
            <div class="hidden sm:block relative">
                <select class="bg-slate-900/90 text-white text-xs border border-slate-700/80 rounded-xl px-3 py-1.5 pr-8 focus:outline-none focus:border-[#FF6600] focus:ring-1 focus:ring-[#FF6600] transition-colors appearance-none cursor-pointer">
                    <option selected>Tahun 2026 (RKAP)</option>
                    <option>Triwulan III (Q3)</option>
                    <option>Triwulan II (Q2)</option>
                    <option>Triwulan I (Q1)</option>
                </select>
                <i class="bi bi-calendar3 absolute right-2.5 top-1/2 -translate-y-1/2 text-white/50 text-[10px] pointer-events-none"></i>
            </div>

            <!-- User Menu -->
            <div class="relative">
                <button id="userMenuBtn" type="button" 
                        class="w-9 h-9 p-0 flex items-center justify-center rounded-full hover:bg-white/10 border border-white/20 transition-all focus:outline-none md:w-auto md:h-auto md:p-1 md:pl-1 md:pr-2.5 md:gap-2.5 shrink-0">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#FF6600] to-amber-500 text-white flex items-center justify-center font-bold text-xs shadow-sm shrink-0 overflow-hidden">
                        @if(Auth::user() && Auth::user()->avatar_url)
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        @endif
                    </div>
                    <div class="text-left hidden md:block">
                        <div class="font-bold text-white text-xs leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        <div class="text-white/60 text-[10px]">{{ Auth::user()->position ?? 'Keuangan Regional 4 Semarang' }}</div>
                    </div>
                    <i class="bi bi-chevron-down text-white/60 text-[10px] hidden md:block"></i>
                </button>

                <!-- Profile Dropdown Menu -->
                <div id="userMenuDropdown" 
                     class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 text-slate-700 text-xs">
                    <div class="px-4 py-2.5 border-b border-slate-100 bg-slate-50/50 rounded-t-2xl">
                        <p class="font-bold text-slate-800 text-xs">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-slate-400 text-[11px] truncate">{{ Auth::user()->email ?? 'admin@posfinance.co.id' }}</p>
                        <p class="text-[#FF6600] font-semibold text-[10px] mt-0.5">{{ Auth::user()->department ?? 'Pos Indonesia Regional 4 Semarang' }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-slate-50 text-slate-600 hover:text-[#002B49] font-medium transition-colors {{ request()->routeIs('profile.*') ? 'bg-orange-50/70 text-[#FF6600] font-bold' : '' }}">
                        <i class="bi bi-person text-[#FF6600] text-sm"></i> Profil Pengguna
                    </a>
                    <a href="{{ route('audit-logs.index') }}" class="flex items-center gap-2.5 px-4 py-2 hover:bg-slate-50 text-slate-600 hover:text-[#002B49] font-medium transition-colors {{ request()->routeIs('audit-logs.*') ? 'bg-orange-50/70 text-[#FF6600] font-bold' : '' }}">
                        <i class="bi bi-shield-check text-[#FF6600] text-sm"></i> Audit Log & Akses
                    </a>
                    <div class="border-t border-slate-100 my-1.5"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-red-600 hover:bg-red-50 font-bold transition-colors">
                            <i class="bi bi-box-arrow-right text-sm"></i> Keluar (Logout)
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>
