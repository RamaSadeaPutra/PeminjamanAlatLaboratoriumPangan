@forelse ($loans as $loan)
<tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">
    <!-- No (Desktop Only) -->
    <td class="hidden md:table-cell px-6 py-4 text-center text-xs text-slate-400 font-bold italic border-b md:border-0 border-slate-50">
        {{ $loop->iteration }}
    </td>

    <!-- Informasi Peminjam -->
    <td class="block md:table-cell px-6 py-4 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Peminjam</div>
            <div class="text-right md:text-left flex flex-col">
                <span class="font-bold text-slate-800 text-sm md:text-base">{{ $loan->user->name ?? '-' }}</span>
                <span class="text-[11px] font-bold text-blue-600 uppercase tracking-widest mt-0.5">{{ $loan->user->nim ?? '-' }}</span>
                <span class="hidden md:block text-[11px] text-slate-400 mt-0.5 tracking-tight font-medium italic">{{ $loan->user->email ?? '-' }}</span>
            </div>
        </div>
    </td>

    <!-- Alat & Jumlah -->
    <td class="block md:table-cell px-6 py-4 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Alat</div>
            <div class="text-right md:text-left flex flex-col">
                <span class="font-bold text-slate-700 text-sm">{{ $loan->tool->tool_name ?? '-' }}</span>
                <span class="text-xs font-black text-slate-400 mt-0.5 uppercase">Jumlah: <span class="text-slate-800">{{ $loan->jumlah }}</span></span>
            </div>
        </div>
    </td>

    <!-- Periode Pinjam -->
    <td class="block md:table-cell px-6 py-4 text-center border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:flex-col md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Periode</div>
            <div class="text-right md:text-center flex flex-col items-end md:items-center gap-1">
                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-blue-500"></i>
                    {{ $loan->tanggal_pinjam }}
                </div>
                <div class="hidden md:block w-px h-2 bg-slate-200"></div>
                <div class="md:hidden text-[10px] text-slate-300 font-bold uppercase">sampai</div>
                <div class="flex items-center gap-1.5 text-xs font-bold text-slate-400 italic">
                    <i data-lucide="calendar-check" class="w-3.5 h-3.5 opacity-50"></i>
                    {{ $loan->tanggal_kembali ?? '-' }}
                </div>
            </div>
        </div>
    </td>

    <!-- Status -->
    <td class="block md:table-cell px-6 py-4 text-center">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Status</div>
            <div class="text-right">
                @if($loan->status === 'menunggu')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black bg-amber-100 text-amber-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        MENUNGGU
                    </span>
                @elseif($loan->status === 'disetujui')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        DISETUJUI
                    </span>
                @elseif($loan->status === 'dipinjam')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black bg-blue-100 text-blue-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        DIPINJAM
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black bg-red-100 text-red-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        {{ strtoupper($loan->status) }}
                    </span>
                @endif
            </div>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
        <div class="flex flex-col items-center gap-3 opacity-60">
            <i data-lucide="inbox-x" class="w-10 h-10"></i>
            <p>Data pinjaman tidak ditemukan</p>
        </div>
    </td>
</tr>
@endforelse
