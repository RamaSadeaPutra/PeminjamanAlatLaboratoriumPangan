@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Ubah Password')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800">
            <i data-lucide="arrow-left"></i>
        </a>
        <h2 class="text-2xl font-bold">Ubah Password</h2>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.updatePassword') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <label class="block">
                <span class="text-gray-700">Password Lama</span>
                <input type="password" name="current_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                @error('current_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700">Password Baru</span>
                <input type="password" name="new_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                @error('new_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700">Konfirmasi Password Baru</span>
                <input type="password" name="new_password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            </label>
        </div>
        <button type="submit" class="mt-6 w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Simpan Password Baru</button>
    </form>
</div>
@endsection
