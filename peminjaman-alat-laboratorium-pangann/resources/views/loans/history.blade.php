@extends('layouts.user')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header Bar -->
    <div class="p-5 md:p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-slate-50/50">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Riwayat Peminjaman</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Daftar peminjaman yang telah selesai atau ditolak</p>
        </div>
        
        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 w-full lg:w-auto">
            <!-- Filter Status -->
            <div class="relative w-full md:w-44">
                <select id="filter-status-myhistory" 
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer text-slate-700 font-medium font-sans">
                    <option value="">Semua Status</option>
                    <option value="kembali">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Search -->
            <div class="relative flex-1 md:flex-none md:w-80 font-sans">
                <input type="text" id="my-history-search" placeholder="Cari nama alat..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mx-8 mt-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
            </div>
            <p class="text-emerald-700 text-sm font-bold tracking-tight">{{ session('success') }}</p>
        </div>
    @endif

    <div class="p-4 md:p-6 font-sans">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group">
                <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-6 py-4 text-center">No</th>
                    <th class="px-6 py-4">Informasi Peminjam</th>
                    <th class="px-6 py-4">Alat & Jumlah</th>
                    <th class="px-6 py-4 text-center">Periode Pinjam</th>
                    <th class="px-6 py-4 text-center">Status Akhir</th>
                </tr>
            </thead>
            <tbody id="my-history-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.my_history_list', ['loans' => $loans])
            </tbody>    
        </table>
    </div>
</div>

<script>
/**
 * Logika Filter & Live Search Riwayat Peminjaman Saya (User)
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('my-history-search');
    const statusSelect = document.getElementById('filter-status-myhistory');
    const tableBody = document.getElementById('my-history-table-body');

    function performMyHistoryFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        fetch(`{{ route('filter.myhistory') }}?${params.toString()}`, {
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
        searchInput.addEventListener('keyup', performMyHistoryFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performMyHistoryFilter);
    }
});
</script>
@endsection
