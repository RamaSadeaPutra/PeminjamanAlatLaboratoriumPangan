@extends('layouts.app')

@section('title', 'Data Alat')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Daftar Alat Laboratorium</h1>
            <p class="text-sm text-slate-500">Manajemen stok dan kondisi inventaris alat</p>
        </div>
        <a href="{{ route('tools.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-5 h-5"></i> Tambah Alat Baru
        </a>
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
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Alat</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Lab</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Kondisi</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest ">Stok</th>
                 <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($tools as $tool)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-slate-800">{{ $tool->tool_name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        <span class="flex items-center gap-2">
                            <i data-lucide="beaker" class="w-4 h-4 text-slate-400"></i>
                            {{ $tool->lab->lab_name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $tool->category->category_name }}</td>
                    <td class="px-6 py-4">
                        @php
                            $badgeClass = match(strtolower($tool->condition)) {
                                'bagus' => 'bg-green-50 text-green-600 border-green-100',
                                'rusak ringan' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                default => 'bg-red-50 text-red-600 border-red-100',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold border {{ $badgeClass }}">
                            {{ strtoupper($tool->condition) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 ">
                        <span class="text-sm font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-lg">
                            {{ $tool->stock }}
                        </span>
                    </td>
                  <td class="px-6 py-4">
    <div class="flex items-center justify-center gap-2">
        <a href="{{ route('tools.edit', $tool->id) }}" 
           class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-blue-100"
           title="Edit Data">
            <i data-lucide="edit-3" class="w-4 h-4"></i>
        </a>

        <form action="{{ route('tools.destroy', $tool->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('Yakin hapus alat ini?')"
                    class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100"
                    title="Hapus Data">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</td>
                            
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="box" class="w-12 h-12 text-slate-200"></i>
                            <p class="font-medium">Belum ada data alat tersedia</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection