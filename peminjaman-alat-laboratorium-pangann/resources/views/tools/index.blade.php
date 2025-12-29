@extends('layouts.app')

@section('title', 'Data Alat')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header & Filter Bar -->
    <div class="p-4 md:p-6 border-b border-slate-100 bg-slate-50/50 space-y-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Daftar Alat Laboratorium</h2>
                <p class="text-xs text-slate-500 font-medium">Manajemen stok dan kondisi inventaris</p>
            </div>
            <a href="{{ route('tools.create') }}" 
               class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-sm shadow-blue-200 transition-all active:scale-95 whitespace-nowrap">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Alat Baru
            </a>
        </div>

        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3">
            <!-- Filter Lab -->
            <div class="relative flex-1 min-w-[140px]">
                <select id="filter-lab-admin" class="w-full pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="">Semua Lab</option>
                    @foreach($labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                    @endforeach
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="relative flex-1 min-w-[140px]">
                <select id="filter-category-admin" class="w-full pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Filter Kondisi -->
            <div class="relative flex-1 min-w-[130px]">
                <select id="filter-condition-admin" class="w-full pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="">Semua Kondisi</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Search -->
            <div class="relative flex-1 md:flex-none md:w-80">
                <input type="text" id="admin-live-search" placeholder="Cari alat..." 
                       class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
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
                <tr class="bg-slate-50 text-slate-500 text-[10px] md:text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-4 py-3 w-12 text-center text-[10px]">No</th>
                    <th class="px-4 py-3 w-24 text-[10px]">Gambar</th>
                    <th class="px-4 py-3 text-[10px]">Nama Alat</th>
                    <th class="px-4 py-3 text-[10px]">Lab</th>
                    <th class="px-4 py-3 text-[10px]">Kategori</th>
                    <th class="px-4 py-3 text-center text-[10px]">Stok</th>
                    <th class="px-4 py-3 text-center text-[10px]">Kondisi</th>
                    <th class="px-4 py-3 text-center text-[10px]">Aksi</th>
                </tr>
            </thead>
            <tbody id="admin-tool-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.tool_list', ['tools' => $tools])
            </tbody>
        </table>
    </div>
</div>

<script>
/**
 * Logika Filter & Search Admin
 * Menangani update tabel alat lab untuk admin secara real-time
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('admin-live-search');
    const labSelect = document.getElementById('filter-lab-admin');
    const categorySelect = document.getElementById('filter-category-admin');
    const conditionSelect = document.getElementById('filter-condition-admin');
    const tableBody = document.getElementById('admin-tool-table-body');

    function performAdminFilter() {
        const query = searchInput.value;
        const labId = labSelect.value;
        const categoryId = categorySelect.value;
        const condition = conditionSelect.value;

        const params = new URLSearchParams({
            query: query,
            lab_id: labId,
            category_id: categoryId,
            condition: condition
        });

        // Memanggil route filter.tools yang baru di FilterController
        fetch(`{{ route('filter.tools') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableBody.innerHTML = html;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        })
        .catch(error => console.error('Error filtering admin tools:', error));
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', performAdminFilter);
    }

    [labSelect, categorySelect, conditionSelect].forEach(select => {
        if (select) {
            select.addEventListener('change', performAdminFilter);
        }
    });
});
</script>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection