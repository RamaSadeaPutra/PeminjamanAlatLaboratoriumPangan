@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Filters Bar -->
    <div class="p-4 md:p-6 border-b border-slate-100 bg-slate-50/50">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Riwayat Peminjaman Alat Laboratorium</h2>
                <p class="text-xs text-slate-500 font-medium">Manajemen inventaris Laboratorium</p>
            </div>

            <div class="flex items-center gap-3 md:gap-4 shrink-0">
                <div class="relative w-64">
                    <input type="text" id="history-live-search" placeholder="Cari user atau alat..." 
                           class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                </div>

                <div class="relative w-40">
                    <select id="filter-status-history" 
                            class="w-full pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer text-slate-700 font-medium">
                        <option value="">Semua Status</option>
                        <option value="kembali">Dikembalikan</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>

                <form action="{{ route('admin.loans.report') }}" method="GET" class="flex items-center gap-2">
                  
                    <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl shadow-sm shadow-red-200 transition-all active:scale-95">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        PDF
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="px-6 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2 p-3 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold border border-emerald-100">
                <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="p-4 md:p-6">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group">
                <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Tanggal Pengajuan</th>
                    <th class="px-4 py-3">Alat & Jumlah</th>
                    <th class="px-4 py-3 text-center">Periode Pinjam</th>
                    <th class="px-4 py-3 text-center">Status Akhir</th>
                </tr>
            </thead>
            <tbody id="history-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.history_list', ['loans' => $loans])
            </tbody>
        </table>
    </div>
</div>

<script>
/**
 * Logika Filter & Live Search Riwayat Peminjaman (Admin)
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('history-live-search');
    const statusSelect = document.getElementById('filter-status-history');
    const tableBody = document.getElementById('history-table-body');

    function performHistoryFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        fetch(`{{ route('filter.history') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableBody.innerHTML = html;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', performHistoryFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performHistoryFilter);
    }
});
</script>
@endsection
