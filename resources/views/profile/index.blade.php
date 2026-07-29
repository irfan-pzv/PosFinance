@extends('layouts.app')

@section('title', 'Profil Pengguna - POS FINANCE Regional 4 Semarang')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Page Header & Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-[#FF6600] transition-colors">Dashboard</a>
                <i class="bi bi-chevron-right text-[10px]"></i>
                <span class="text-slate-800 font-bold">Profil Pengguna</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2.5">
                <i class="bi bi-person-circle text-[#FF6600] text-2xl"></i>
                Pengaturan Profil Pengguna
            </h1>
            <p class="text-xs text-slate-500 mt-1">Kelola data pribadi, informasi unit kerja, serta keamanan password akun Anda.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Status Flash Alerts -->
    @if (session('status') === 'profile-updated')
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center justify-between text-xs font-semibold shadow-sm" role="alert">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-base shrink-0">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">Profil Berhasil Diperbarui!</p>
                    <p class="text-emerald-600 font-normal">Informasi data diri dan unit kerja Anda telah berhasil diperbarui ke sistem.</p>
                </div>
            </div>
            <button type="button" class="text-emerald-600 hover:text-emerald-900 text-lg" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center justify-between text-xs font-semibold shadow-sm" role="alert">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-base shrink-0">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">Password Berhasil Diubah!</p>
                    <p class="text-emerald-600 font-normal">Password akun Anda telah berhasil diperbarui. Harap catat atau ingat password baru Anda.</p>
                </div>
            </div>
            <button type="button" class="text-emerald-600 hover:text-emerald-900 text-lg" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if (session('status') === 'avatar-deleted')
        <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-2xl flex items-center justify-between text-xs font-semibold shadow-sm" role="alert">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center text-base shrink-0">
                    <i class="bi bi-trash"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">Foto Profil Dihapus</p>
                    <p class="text-amber-700 font-normal">Foto profil telah dihapus dan dikembalikan ke avatar bawaan sistem.</p>
                </div>
            </div>
            <button type="button" class="text-amber-600 hover:text-amber-900 text-lg" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl text-xs shadow-sm" role="alert">
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center text-base shrink-0">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-sm text-rose-900 mb-1">Terdapat beberapa kesalahan input:</p>
                    <ul class="list-disc list-inside space-y-0.5 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile Header Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md overflow-hidden">
        <!-- Banner -->
        <div class="h-20 bg-gradient-to-r from-[#002B49] via-[#003860] to-[#FF6600] px-6 flex items-center justify-between">
            <div class="text-white/90 text-xs font-bold tracking-wide flex items-center gap-2">
                <span class="bg-white/10 px-2.5 py-1 rounded-md border border-white/10">PT POS INDONESIA (PERSERO)</span>
            </div>
            <div class="text-white/40 font-black text-xs tracking-widest uppercase hidden sm:block">
                POS FINANCE REGIONAL 4 SEMARANG
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                
                <!-- Avatar & Info Box -->
                <div class="flex flex-col sm:flex-row items-center sm:items-center gap-5 text-center sm:text-left">
                    <!-- Avatar Image Circle -->
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-tr from-[#FF6600] to-amber-500 text-white flex items-center justify-center font-black text-3xl overflow-hidden shrink-0 border-2 border-white shadow-md">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>

                    <!-- User Name & Badges -->
                    <div class="space-y-1.5">
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">{{ $user->name }}</h2>
                            <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-full flex items-center gap-1">
                                <i class="bi bi-patch-check-fill text-emerald-600"></i> Aktif
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-3 gap-y-1 text-xs font-semibold text-slate-600">
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-briefcase text-[#FF6600]"></i> {{ $user->position ?? 'Staff Keuangan' }}
                            </span>
                            <span class="hidden sm:inline text-slate-300">•</span>
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-building text-[#FF6600]"></i> {{ $user->department ?? 'Regional 4 Semarang' }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-1 text-xs text-slate-500">
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-envelope text-slate-400"></i> {{ $user->email }}
                            </span>
                            @if($user->phone)
                                <span class="flex items-center gap-1.5">
                                    <i class="bi bi-telephone text-slate-400"></i> {{ $user->phone }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side Badges -->
                <div class="flex items-center justify-center gap-3 pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100 shrink-0">
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl px-4 py-2.5 text-center min-w-[120px]">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">ID Pengguna</span>
                        <span class="text-sm font-black text-[#002B49]">#USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl px-4 py-2.5 text-center min-w-[120px]">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">Terdaftar Sejak</span>
                        <span class="text-sm font-extrabold text-slate-700">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Content Grid with Symmetrical Height Alignment -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">

        <!-- Left 2 Columns: Edit Profile Form -->
        <div class="lg:col-span-2 flex flex-col">

            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-6 flex-1 flex flex-col">
                <div class="border-b border-slate-100 pb-4 mb-6">
                    <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-person-lines-fill text-[#FF6600]"></i> Informasi Personal & Pekerjaan
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Perbarui nama lengkap, kontak, jabatan, dan foto profil akun Anda.</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="flex-1 flex flex-col justify-between space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <!-- Avatar Box -->
                        <div class="p-4 bg-slate-50/80 border border-slate-200/70 rounded-2xl space-y-2">
                            <label class="block text-xs font-bold text-slate-700">Foto Profil (Avatar)</label>
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#FF6600] to-amber-500 text-white flex items-center justify-center font-bold text-xl overflow-hidden shrink-0 border-2 border-white shadow-sm">
                                    @if($user->avatar_url)
                                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="flex-1 w-full space-y-1">
                                    <input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg, image/webp"
                                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#002B49] file:text-white hover:file:bg-[#FF6600] file:transition-colors cursor-pointer">
                                    <p class="text-[10px] text-slate-400">Format: JPG, PNG, WEBP (Maksimal 2MB).</p>
                                </div>
                                @if($user->avatar)
                                    <button type="button" 
                                            onclick="if(confirm('Yakin ingin menghapus foto profil ini?')) document.getElementById('deleteAvatarForm').submit();"
                                            class="px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 border border-rose-200 rounded-xl transition-colors shrink-0">
                                        <i class="bi bi-trash"></i> Hapus Foto
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Input Fields Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            
                            <!-- Nama Lengkap -->
                            <div class="space-y-1.5">
                                <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                    <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                           class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email <span class="text-rose-500">*</span></label>
                                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                    <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                           class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                                </div>
                            </div>

                            <!-- No. Telepon / WhatsApp -->
                            <div class="space-y-1.5">
                                <label for="phone" class="block text-xs font-bold text-slate-700">Nomor HP / WhatsApp</label>
                                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                    <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890"
                                           class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                                </div>
                            </div>

                            <!-- Jabatan -->
                            <div class="space-y-1.5">
                                <label for="position" class="block text-xs font-bold text-slate-700">Jabatan / Posisi</label>
                                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                    <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                        <i class="bi bi-briefcase"></i>
                                    </span>
                                    <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}" placeholder="Contoh: Staff Keuangan"
                                           class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                                </div>
                            </div>

                            <!-- Unit / Departemen -->
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="department" class="block text-xs font-bold text-slate-700">Unit Kerja / Departemen</label>
                                <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                    <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <input type="text" name="department" id="department" value="{{ old('department', $user->department) }}" placeholder="Contoh: Regional 4 Semarang - PT Pos Indonesia"
                                           class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100 flex justify-end mt-auto">
                        <button type="submit" 
                                class="px-5 py-2.5 bg-[#FF6600] hover:bg-[#e55c00] text-white font-bold text-xs rounded-xl shadow-md shadow-orange-500/20 transition-all flex items-center gap-2">
                            <i class="bi bi-save"></i> Simpan Perubahan Profil
                        </button>
                    </div>

                </form>
            </div>

        </div>

        <!-- Right 1 Column: Password Change & System Access Summary -->
        <div class="flex flex-col justify-between gap-6">

            <!-- Password Change Form -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="text-base font-extrabold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-shield-lock text-[#FF6600]"></i> Keamanan & Password
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Ubah password akun Anda secara berkala.</p>
                    </div>

                    <form id="passwordForm" action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Password Saat Ini -->
                        <div class="space-y-1.5">
                            <label for="current_password" class="block text-xs font-bold text-slate-700">Password Saat Ini <span class="text-rose-500">*</span></label>
                            <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password" name="current_password" id="current_password" required
                                       class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent"
                                       placeholder="Masukkan password lama">
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-700">Password Baru <span class="text-rose-500">*</span></label>
                            <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                    <i class="bi bi-lock-fill text-slate-400"></i>
                                </span>
                                <input type="password" name="password" id="password" required
                                       class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent"
                                       placeholder="Minimal 8 karakter">
                            </div>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Password Baru <span class="text-rose-500">*</span></label>
                            <div class="flex items-center rounded-xl border border-slate-200 bg-white focus-within:border-[#FF6600] focus-within:ring-1 focus-within:ring-[#FF6600] transition-colors overflow-hidden">
                                <span class="pl-3.5 pr-2 text-slate-400 text-sm flex items-center shrink-0">
                                    <i class="bi bi-shield-check text-slate-400"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="w-full py-2.5 pr-3 text-xs font-semibold text-slate-800 focus:outline-none bg-transparent"
                                       placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Submit Password Button (pushed to bottom of card) -->
                <div class="pt-4 mt-2">
                    <button type="submit" form="passwordForm"
                            class="w-full py-2.5 bg-[#002B49] hover:bg-[#001d32] text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                        <i class="bi bi-shield-check"></i> Perbarui Password
                    </button>
                </div>
            </div>

            <!-- Detail Akses Sistem Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md p-6 space-y-3 shrink-0">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                        <i class="bi bi-info-circle text-[#FF6600]"></i> Detail Akses Sistem
                    </h3>
                </div>

                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Peran / Role</span>
                        <span class="font-bold text-[#002B49] bg-slate-100 px-2.5 py-0.5 rounded-full">Administrator</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500">Regional Kerja</span>
                        <span class="font-bold text-slate-700">Reg. 4 Semarang</span>
                    </div>
                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-500">Status Akun</span>
                        <span class="font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md text-[10px]">AKTIF</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Hidden Delete Avatar Form -->
@if($user->avatar)
<form id="deleteAvatarForm" action="{{ route('profile.avatar.destroy') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endif

@endsection
