@extends('layouts.app')

@section('title', 'Persetujuan Akun')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Persetujuan Akun</h1>
            <p class="text-gray-500 mt-1">Daftar pengguna baru yang menunggu persetujuan</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-700 hover:bg-green-50 p-2 rounded-lg transition-colors border border-transparent hover:border-green-200"
                                                title="Setujui">
                                            <i data-lucide="check" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak akun ini?');">
                                        @csrf
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors border border-transparent hover:border-red-200"
                                                title="Tolak">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 p-3 rounded-full mb-3">
                                        <i data-lucide="inbox" class="w-6 h-6 text-gray-400"></i>
                                    </div>
                                    <p class="font-medium">Tidak ada pengajuan akun baru</p>
                                    <p class="text-sm mt-1">Semua pendaftaran telah diproses</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
