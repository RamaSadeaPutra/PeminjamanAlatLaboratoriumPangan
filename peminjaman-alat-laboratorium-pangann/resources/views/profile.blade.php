@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-xl mx-auto bg-white p-5 rounded-lg shadow-sm">
    <div class="flex flex-col items-center">
        <!-- Photo Section (Top) -->
        <div class="mb-6 w-full text-center">
            <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="flex flex-col items-center">
                @csrf
                <div class="relative group">
                    <div class="w-24 h-24 mb-3 overflow-hidden rounded-full border-4 border-white shadow-lg">
                        @if($user->photo_path && Storage::disk('public')->exists($user->photo_path))
                            <img src="{{ asset('storage/' . $user->photo_path) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
                                <i data-lucide="user" class="w-12 h-12"></i>
                            </div>
                        @endif
                    </div>
                    
                    <label for="photo-upload" class="absolute bottom-4 right-0 p-2 bg-blue-600 text-white rounded-full cursor-pointer hover:bg-blue-700 shadow-md transition-all group-hover:scale-110">
                        <i data-lucide="camera" class="w-5 h-5"></i>
                    </label>
                    <input id="photo-upload" type="file" name="photo" accept="image/jpeg,image/png" class="hidden" onchange="this.form.submit()">
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->role === 'admin' ? 'Administrator' : 'Mahasiswa' }}</p>
            </form>
            @if(session('status'))
                <p class="text-green-600 text-sm mt-2 font-medium">{{ session('status') }}</p>
            @endif
             @error('photo')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Details Section -->
        <div class="w-full space-y-3">
            <div class="border-b border-slate-100 pb-2">
               <label class="block text-sm font-medium text-slate-500 mb-1">Nama Lengkap</label>
               <p class="text-lg font-semibold text-slate-800">{{ $user->name }}</p>
            </div>

            <div class="border-b border-slate-100 pb-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider block">NIM</label>
               <p class="text-lg font-semibold text-slate-800 font-mono">{{ $user->nim ?? '-' }}</p>
            </div>

            <div class="border-b border-slate-100 pb-2">
               <label class="block text-sm font-medium text-slate-500 mb-1">Email</label>
               <p class="text-lg font-semibold text-slate-800">{{ $user->email }}</p>
            </div>
            
            <!-- Password Button -->
            <div class="pt-2">
                <a href="{{ route('profile.editPassword') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-slate-800 text-white font-medium rounded-lg hover:bg-slate-900 transition-all w-full justify-center text-sm">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Ubah Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
