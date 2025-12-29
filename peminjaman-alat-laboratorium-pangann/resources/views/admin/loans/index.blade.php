@extends('layouts.app')

@section('title', 'Pengajuan Peminjaman')
@section('main_class', 'p-4')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Filters Bar -->
    <div class="p-4 md:p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
        <h2 class="text-xl font-bold text-slate-800">Daftar Pengajuan</h2>
        
        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 w-full lg:w-auto">
            <!-- Search -->
            <div class="relative flex-1 md:flex-none md:w-80">
                <input type="text" id="loan-live-search" placeholder="Cari user atau alat..." 
                       class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Filter Status -->
            <div class="relative w-full md:w-44">
                <select id="filter-status-loan" 
                        class="w-full pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="dipinjam">Dipinjam</option>
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success') || session('error'))
        <div class="px-6 py-4 border-b border-slate-100">
            @if(session('success'))
                <div class="flex items-center gap-2 p-3 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold border border-emerald-100">
                    <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-2 p-3 bg-red-50 text-red-700 rounded-xl text-sm font-semibold border border-red-100">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ session('error') }}
                </div>
            @endif
        </div>
    @endif

    <!-- Table -->
    <div class="p-4 md:p-6">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group">
                <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 text-center">Alat & Jumlah</th>
                    <th class="px-4 py-3 text-center">Periode Sewa</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="loan-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.loan_list', ['loans' => $loans])
            </tbody>
        </table>
    </div>
</div>

<script>
/**
 * Logika Filter & Live Search Pengajuan Peminjaman
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('loan-live-search');
    const statusSelect = document.getElementById('filter-status-loan');
    const tableBody = document.getElementById('loan-table-body');

    function performLoanFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        fetch(`{{ route('filter.loans') }}?${params.toString()}`, {
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
        searchInput.addEventListener('keyup', performLoanFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performLoanFilter);
    }
});
</script>
@endsection
