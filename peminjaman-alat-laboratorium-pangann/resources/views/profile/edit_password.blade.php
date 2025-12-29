@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Ubah Password')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('profile.show') }}" 
           class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-blue-500 hover:border-blue-100 hover:shadow-sm transition-all active:scale-95">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Ubah Password</h2>
            <p class="text-sm text-slate-500 font-medium italic">Gunakan password yang kuat untuk keamanan akun</p>
        </div>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        @if (session('status'))
            <div class="p-4 bg-emerald-50 border-b border-emerald-100 flex items-center gap-2 text-emerald-700 text-sm font-bold animate-pulse">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.updatePassword') }}" class="p-8 space-y-6">
            @csrf
            
            <!-- Password Lama -->
            <div class="group">
                <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-500 transition-colors">Password Saat Ini</label>
                <div class="relative">
                    <input type="password" name="current_password" required
                           class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                           placeholder="••••••••">
                    <i data-lucide="key-round" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-blue-400 transition-colors"></i>
                </div>
                @error('current_password')
                    <p class="mt-2 text-red-500 text-xs font-bold italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Password Baru -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-500 transition-colors">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password" required
                               class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                               placeholder="Min. 8 karakter">
                        <i data-lucide="shield-check" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-blue-400 transition-colors"></i>
                    </div>
                </div>

                <!-- Konfirmasi -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-500 transition-colors">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="new_password_confirmation" required
                               class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                               placeholder="Ulangi password baru">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-blue-400 transition-colors"></i>
                    </div>
                </div>
            </div>

            @error('new_password')
                <p class="text-red-500 text-xs font-bold italic">{{ $message }}</p>
            @enderror

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i>
                    Simpan Perubahan Password
                </button>
                <p class="text-center text-[10px] text-slate-400 mt-4 leading-relaxed uppercase tracking-tighter">
                    Tindakan ini akan mengamankan akun Anda secara permanen. <br>
                    Harap catat password baru Anda.
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
