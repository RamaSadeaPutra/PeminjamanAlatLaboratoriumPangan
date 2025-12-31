@foreach($loans as $loan)
<tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">

    <td class="hidden md:table-cell px-4 py-3 text-center text-xs font-bold text-slate-400 border-b md:border-0 border-slate-50">
        {{ $loop->iteration }}
    </td>

    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Peminjam</div>
            <div class="font-bold text-slate-800 text-[13px] tracking-tight text-right md:text-left">
                {{ $loan->user->name ?? 'User Terhapus' }}
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">NIM</div>
            <div class="text-[11px] font-bold text-blue-600 uppercase tracking-tight text-right md:text-left">
                {{ $loan->user->nim ?? '-' }}
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Email</div>
            <div class="text-[10px] text-slate-500 italic text-right md:text-left truncate">
                {{ $loan->user->email ?? '-' }}
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Pengajuan</div>
            <div class="text-[11px] text-slate-600 text-center">
                {{ optional($loan->created_at)->format('d M Y H:i') ?? '-' }}
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Alat</div>
            <div class="text-right md:text-left">
                <div class="font-bold text-blue-600 text-xs">{{ $loan->tool->tool_name ?? 'Alat Terhapus' }}</div>
                <div class="text-[10px] font-black text-slate-500 uppercase">Jumlah: {{ $loan->jumlah }}</div>
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:flex-col md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Waktu</div>
            <div class="text-right md:text-center">
                <div class="text-slate-600 text-[11px] font-bold">{{ $loan->tanggal_pinjam }}</div>
                <div class="hidden md:block text-slate-400 text-[10px]">s/d</div>
                <div class="text-slate-600 text-[11px] font-bold">{{ $loan->tanggal_kembali }}</div>
            </div>
        </div>
    </td>

    <td class="block md:table-cell px-4 py-4 md:py-3 text-center">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Status</div>
            <div class="text-right">
                @if($loan->status === 'kembali')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-700">
                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                        Selesai
                    </span>
                @elseif($loan->status === 'ditolak')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-red-100 text-red-700">
                        <span class="w-1 h-1 rounded-full bg-red-500"></span>
                        Ditolak
                    </span>
                @endif
            </div>
        </div>
    </td>

</tr>
@endforeach
