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

        <!-- Input Live Search User -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="search" class="h-4 w-4 text-gray-400"></i>
            </span>
            <input type="text" id="user-live-search" placeholder="Cari nama atau email..." 
                   class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm w-64">
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
                <tbody id="user-table-body" class="divide-y divide-gray-100">
                    @include('partials.user_list', ['users' => $users])
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
/**
 * Logika Live Search untuk pencarian user pending
 * Mengambil data dari server tanpa refresh halaman
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('user-live-search');
    const tableBody = document.getElementById('user-table-body');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            // Memanggil route search.users via AJAX
            fetch(`{{ route('search.users') }}?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Mengupdate isi tabel dengan hasil pencarian
                tableBody.innerHTML = html;
                
                // Me-render ulang icon Lucide setelah konten berubah
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => console.error('Error fetching search results:', error));
        });
    }
});
</script>
@endsection
