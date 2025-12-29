@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto py-3 px-4 font-sans">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- Profile Card (Left) - 4 cols -->
        <div class="lg:col-span-4 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col items-center relative overflow-hidden">
                <!-- Background Decorative Gradient -->
                <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-br from-blue-500 to-sky-400 opacity-10"></div>
                
                <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="relative z-10 flex flex-col items-center">
                    @csrf
                    <div class="relative group">
                        <div class="w-24 h-24 mb-3 overflow-hidden rounded-2xl border-4 border-white shadow-lg ring-1 ring-slate-100">
                            @if($user->photo_path && Storage::disk('public')->exists($user->photo_path))
                                <img src="{{ asset('storage/' . $user->photo_path) }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                    <i data-lucide="user" class="w-10 h-10"></i>
                                </div>
                            @endif
                        </div>
                        
                        <label for="photo-upload" class="absolute -bottom-1 -right-1 p-2 bg-blue-600 text-white rounded-xl cursor-pointer hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all hover:scale-110 active:scale-95 group-hover:rotate-12">
                            <i data-lucide="camera" class="w-4 h-4"></i>
                        </label>
                        <input id="photo-upload" type="file" name="photo" accept="image/jpeg,image/png" class="hidden" onchange="this.form.submit()">
                    </div>
                    
                    <h2 class="text-lg font-bold text-slate-800 text-center leading-tight">{{ $user->name }}</h2>
                    <span class="inline-flex items-center gap-1.5 py-0.5 px-2.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-blue-50 text-blue-600 mt-1.5">
                        <span class="w-1 h-1 rounded-full bg-blue-500"></span>
                        {{ $user->role === 'admin' ? 'Admin' : 'Mahasiswa' }}
                    </span>
                </form>

                @if(session('status'))
                    <div class="mt-3 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-lg border border-emerald-100 flex items-center gap-1 animate-bounce">
                        <i data-lucide="check-circle" class="w-3 h-3"></i> Profil diperbarui
                    </div>
                @endif
                
                @error('photo')
                    <div class="mt-3 px-2.5 py-1 bg-red-50 text-red-700 text-[10px] font-bold rounded-lg border border-red-100 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Quick Stats/Info -->
            <div class="bg-slate-900 rounded-2xl p-4 text-white shadow-lg shadow-slate-200">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Info Akun</h3>
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center shrink-0">
                        <i data-lucide="calendar" class="w-4 h-4 text-blue-400"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-tight">Terdaftar</p>
                        <p class="text-xs font-bold leading-tight">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card (Right) - 8 cols -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-50">
                    <h3 class="text-lg font-bold text-slate-800 italic leading-none">Info Personal</h3>
                    <i data-lucide="shield-check" class="w-5 h-5 text-blue-500 opacity-20"></i>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 group-hover:text-blue-500 transition-colors">Nama Lengkap</label>
                        <div class="flex items-center gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl transition-all group-hover:ring-4 group-hover:ring-blue-50 group-hover:border-blue-100">
                            <i data-lucide="user" class="w-4 h-4 text-slate-400 group-hover:text-blue-500 shrink-0"></i>
                            <p class="text-sm font-bold text-slate-700 truncate">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 group-hover:text-blue-500 transition-colors">NIM / Identitas</label>
                        <div class="flex items-center gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl transition-all group-hover:ring-4 group-hover:ring-blue-50 group-hover:border-blue-100">
                            <i data-lucide="hash" class="w-4 h-4 text-slate-400 group-hover:text-blue-500 shrink-0"></i>
                            <p class="text-sm font-bold text-slate-700 font-mono">{{ $user->nim ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="group md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 group-hover:text-blue-500 transition-colors">Alamat Email</label>
                        <div class="flex items-center gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl transition-all group-hover:ring-4 group-hover:ring-blue-50 group-hover:border-blue-100">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400 group-hover:text-blue-500 shrink-0"></i>
                            <p class="text-sm font-bold text-slate-700 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="mt-6 pt-5 border-t border-slate-50 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
                    <div>
                        <p class="text-[10px] text-slate-400 font-medium italic">Privasi akun dilindungi sistem keamanan.</p>
                    </div>
                    <a href="{{ route('profile.editPassword') }}" 
                       class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-xl transition-all active:scale-95 group whitespace-nowrap">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-500 transition-colors"></i>
                        Ubah Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
