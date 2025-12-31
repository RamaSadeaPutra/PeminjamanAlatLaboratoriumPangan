@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Hasil Pencarian Alat')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header Bar -->
    <div class="p-4 md:p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Hasil Pencarian Alat</h2>
            <p class="text-xs text-slate-500 font-medium">Menampilkan hasil untuk: <span class="text-blue-600 italic">"{{ $query }}"</span></p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('tools.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform"></i>
                    Manajemen Alat
                </a>
            @else
                <a href="{{ route('user.tools.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform"></i>
                    Kembali ke Daftar
                </a>
            @endif
        </div>
    </div>

    <!-- Search Form Re-run -->
    <div class="p-4 md:p-6 bg-white border-b border-slate-50">
        <form action="{{ route('search') }}" method="GET" class="flex items-center gap-3 max-w-lg">
            <div class="relative flex-1">
                <input type="text" name="query" value="{{ $query }}" placeholder="Cari alat kembali..." 
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            </div>
            <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95">
                Cari
            </button>
        </form>
    </div>

    <!-- Results Table -->
    <div class="p-4 md:p-6">
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
            <tbody class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @forelse ($tools as $tool)
                    <tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">
                        <!-- No (Desktop Only) -->
                        <td class="hidden md:table-cell px-4 py-3 text-center text-xs text-slate-400 font-bold italic border-b md:border-0 border-slate-50">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Nama Alat -->
                        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
                            <div class="flex items-center justify-between md:justify-start gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Alat</div>
                                <div class="font-bold text-slate-800 text-right md:text-left">{{ $tool->tool_name }}</div>
                            </div>
                        </td>

                        <!-- Laboratorium -->
                        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
                            <div class="flex items-center justify-between md:justify-start gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Lab</div>
                                <span class="text-xs font-semibold md:font-medium text-slate-600 italic text-right md:text-left">
                                    {{ $tool->lab->name ?? $tool->lab->lab_name ?? '-' }}
                                </span>
                            </div>
                        </td>

                        <!-- Kategori -->
                        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
                            <div class="flex items-center justify-between md:justify-start gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Kategori</div>
                                <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase text-right md:text-left">
                                    {{ $tool->category->name ?? $tool->category->category_name ?? '-' }}
                                </span>
                            </div>
                        </td>

                        <!-- Stok -->
                        <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
                            <div class="flex items-center justify-between md:justify-center gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Stok</div>
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600 text-xs font-black">
                                    {{ $tool->stock }}
                                </span>
                            </div>
                        </td>

                        <!-- Kondisi -->
                        <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
                            <div class="flex items-center justify-between md:justify-center gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Kondisi</div>
                                <div>
                                    @if(in_array(strtolower($tool->condition), ['baik', 'bagus']))
                                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-700 ring-2 ring-white uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ $tool->condition }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-red-100 text-red-700 ring-2 ring-white uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            {{ $tool->condition }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Aksi -->
                        <td class="block md:table-cell px-4 py-4 md:py-3">
                            <div class="flex items-center justify-between md:justify-center gap-4">
                                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Opsi</div>
                                <div class="flex items-center justify-end md:justify-center gap-2 flex-1">
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('tools.edit', $tool->id) }}" 
                                        class="p-2.5 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl shadow-lg shadow-blue-50 transition-all active:scale-95 border border-blue-100" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus alat ini?')" 
                                                    class="p-2.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl shadow-lg shadow-red-50 transition-all active:scale-95 border border-red-100" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('user.loans.create', $tool->id) }}"
                                        class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95">
                                            <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                            Pinjam Alat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic">
                            <div class="flex flex-col items-center gap-3 opacity-60">
                                <i data-lucide="search-x" class="w-10 h-10"></i>
                                <p>Tidak ditemukan alat dengan keyword <span class="font-bold">"{{ $query }}"</span></p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
