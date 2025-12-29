


@extends('layouts.user')

@section('title', 'Daftar Alat')

@section('content')


<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header Bar -->
    <div class="p-5 md:p-8 border-b border-slate-100 flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6 bg-slate-50/50">
        <div class="flex-1 max-w-2xl">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                <i data-lucide="microscope" class="w-7 h-7 text-blue-600"></i>
                Inventaris Alat Laboratorium
            </h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Daftar alat tersedia yang dapat Anda pinjam untuk praktikum</p>
        </div>
        
        <div class="flex flex-col items-start md:items-end gap-4 w-full xl:w-auto">
            <div class="flex flex-wrap items-center justify-start md:justify-end gap-3 w-full">
            <!-- Filter Lab -->
            <div class="relative w-full md:w-44">
                <select id="filter-lab" 
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer text-slate-700 font-medium font-sans">
                    <option value="">Semua Lab</option>
                    @foreach($labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                    @endforeach
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="relative w-full md:w-44">
                <select id="filter-category" 
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer text-slate-700 font-medium font-sans">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Filter Kondisi -->
            <div class="relative w-full md:w-40">
                <select id="filter-condition" 
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer text-slate-700 font-medium font-sans">
                    <option value="">Semua Kondisi</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </div>
            </div>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-[33.5rem] font-sans">
                <input type="text" id="live-search" placeholder="Cari alat..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 md:p-6 font-sans">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group">
                <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-4 py-3 text-center text-[10px]">No</th>
                   
                    <th class="px-4 py-3 text-[10px]">Nama Alat</th>
                    <th class="px-4 py-3 text-[10px]">Laboratorium</th>
                    <th class="px-4 py-3 text-[10px]">Kategori</th>
                    <th class="px-4 py-3 text-center text-[10px]">Stok</th>
                    <th class="px-4 py-3 text-center text-[10px]">Kondisi</th>
                    <th class="px-4 py-3 text-center text-[10px]">Aksi</th>
                </tr>
            </thead>
            <tbody id="tool-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.tool_list', ['tools' => $tools])
            </tbody>
        </table>
    </div>
</div>

<script>
/**
 * Logika Filter & Live Search Gabungan
 * Mengambil data berdasarkan keyword, lab, kategori, dan kondisi secara bersamaan
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('live-search');
    const labSelect = document.getElementById('filter-lab');
    const categorySelect = document.getElementById('filter-category');
    const conditionSelect = document.getElementById('filter-condition');
    const tableBody = document.getElementById('tool-table-body');

    function performFilter() {
        const query = searchInput.value;
        const labId = labSelect.value;
        const categoryId = categorySelect.value;
        const condition = conditionSelect.value;

        // Membangun URL dengan parameter filter
        const params = new URLSearchParams({
            query: query,
            lab_id: labId,
            category_id: categoryId,
            condition: condition
        });

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
        .catch(error => console.error('Error filtering tools:', error));
    }

    // Event listener untuk input teks (search)
    if (searchInput) {
        searchInput.addEventListener('keyup', performFilter);
    }

    // Event listener untuk dropdown (filter)
    [labSelect, categorySelect, conditionSelect].forEach(select => {
        if (select) {
            select.addEventListener('change', performFilter);
        }
    });
});
</script>
</div>
@endsection
