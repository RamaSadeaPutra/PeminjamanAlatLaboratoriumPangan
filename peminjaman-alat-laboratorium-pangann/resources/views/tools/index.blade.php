@extends('layouts.app')

@section('title', 'Data Alat')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Daftar Alat Laboratorium</h1>
            <p class="text-sm text-slate-500">Manajemen stok dan kondisi inventaris alat</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <!-- Filter Lab -->
            <select id="filter-lab-admin" class="px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Lab</option>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                @endforeach
            </select>

            <!-- Filter Kategori -->
            <select id="filter-category-admin" class="px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>

            <!-- Filter Kondisi -->
            <select id="filter-condition-admin" class="px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
            </select>

            <!-- Form Pencarian Admin -->
            <div class="flex items-center">
                <input type="text" id="admin-live-search" name="query" placeholder="Cari alat..." 
                       class="px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <a href="{{ route('tools.create') }}" class="btn-primary">
                <i data-lucide="plus" class="w-5 h-5"></i> Tambah Alat Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded-xl flex items-center gap-3 text-sm font-bold">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="content-card bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Gambar</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Alat</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Lab</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest ">Stok</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Kondisi</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="admin-tool-table-body" class="divide-y divide-slate-50">
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