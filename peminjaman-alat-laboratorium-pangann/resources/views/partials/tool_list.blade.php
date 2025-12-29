@forelse ($tools as $tool)
    <tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">
        <!-- Index No (Mobile: Hidden / Desktop: Shown) -->
        <td class="hidden md:table-cell px-4 py-3 text-center font-bold text-slate-400 text-xs border-b md:border-0 border-slate-50">
            {{ $loop->iteration }}
        </td>

        <!-- Image & Basic Info (Admin Only) -->
        @if(auth()->user()->role === 'admin')
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Gambar</div>
                <div class="flex items-center gap-3">
                    @if($tool->image)
                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden border-2 border-white shadow-sm ring-1 ring-slate-100 shrink-0">
                            <img src="{{ asset('storage/' . $tool->image) }}" alt="{{ $tool->tool_name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 border-dashed shrink-0">
                            <i data-lucide="image" class="w-5 h-5"></i>
                        </div>
                    @endif
                </div>
            </div>
        </td>
        @endif

        <!-- Tool Name & ID -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Alat</div>
                <div class="text-right md:text-left">
                    <div class="font-bold text-slate-800 text-sm md:text-xs">{{ $tool->tool_name }}</div>
                    <div class="text-[9px] text-slate-400 font-bold uppercase tracking-tight italic">ID: #{{ str_pad($tool->id, 4, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
        </td>

        <!-- Laboratorium -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Lab</div>
                <div class="text-slate-600 text-xs font-semibold md:font-medium italic">
                    {{ $tool->lab->name ?? $tool->lab->lab_name ?? '-' }}
                </div>
            </div>
        </td>

        <!-- Kategori -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Kategori</div>
                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">
                    {{ $tool->category->name ?? $tool->category->category_name ?? '-' }}
                </span>
            </div>
        </td>

        <!-- Stok -->
        <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Stok</div>
                <span class="inline-flex items-center px-3 py-1 md:px-2 md:py-0.5 rounded-full md:rounded text-xs font-black {{ $tool->stock > 0 ? 'text-emerald-600 bg-emerald-50' : 'text-red-600 bg-red-50' }}">
                    {{ $tool->stock }}
                </span>
            </div>
        </td>

        <!-- Kondisi -->
        <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
            @php $isGood = in_array(strtolower($tool->condition), ['baik', 'bagus']); @endphp
            <div class="flex items-center justify-between md:justify-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Kondisi</div>
                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase tracking-wider {{ $isGood ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} ring-2 ring-white">
                    <span class="w-1.5 h-1.5 rounded-full {{ $isGood ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                    {{ $tool->condition }}
                </span>
            </div>
        </td>

        <!-- Aksi -->
        <td class="block md:table-cell px-4 py-4 md:py-3">
            <div class="flex items-center justify-between md:justify-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[60px]">Opsi</div>
                <div class="flex-1 md:flex-none">
                    @if(auth()->user()->role === 'admin')
                        <div class="flex items-center justify-end md:justify-center gap-2">
                            <a href="{{ route('tools.edit', $tool->id) }}" title="Edit" 
                            class="p-2.5 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all active:scale-95 shadow-sm border border-blue-100">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')" 
                                        class="p-2.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all active:scale-95 shadow-sm border border-red-100"
                                        title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-right md:text-center">
                            <a href="{{ route('user.loans.create', $tool->id) }}"
                            class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white text-xs font-black uppercase tracking-wider rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all active:scale-95">
                                Pinjam Alat
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="{{ auth()->user()->role === 'admin' ? '8' : '7' }}" class="px-6 py-12 text-center text-slate-400 italic">
            <div class="flex flex-col items-center gap-2 opacity-60">
                <i data-lucide="microscope" class="w-10 h-10"></i>
                Tidak ditemukan data alat dalam inventaris.
            </div>
        </td>
    </tr>
@endforelse
