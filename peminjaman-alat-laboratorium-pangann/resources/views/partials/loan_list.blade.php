@foreach($loans as $loan)
<tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">

    <!-- Nama -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Peminjam</div>
            <div class="font-bold text-slate-800 text-[13px] tracking-tight text-center">
                {{ $loan->user->name ?? 'User Terhapus' }}
            </div>
        </div>
    </td>

    <!-- NIM -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">NIM</div>
            <div class="text-[11px] font-bold text-blue-600 uppercase tracking-tight text-center">
                {{ $loan->user->nim ?? '-' }}
            </div>
        </div>
    </td>

    <!-- Email -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Email</div>
            <div class="text-[10px] text-slate-500 italic text-center truncate">
                {{ $loan->user->email ?? '-' }}
            </div>
        </div>
    </td>

    <!-- Tanggal Pengajuan -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Pengajuan</div>
            <div class="text-[11px] text-slate-600 text-center">
                {{ optional($loan->created_at)->format('d M Y H:i') ?? '-' }}
            </div>
        </div>
    </td>

    <!-- Tool -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50 text-center">
        <div class="flex items-center justify-between md:flex-col md:items-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Alat</div>
            <div>
                <div class="font-bold text-blue-600 text-xs">{{ $loan->tool->tool_name ?? 'Alat Terhapus' }}</div>
                <div class="text-[10px] font-black text-slate-500 uppercase">Jumlah: {{ $loan->jumlah }}</div>
            </div>
        </div>
    </td>

    <!-- Waktu -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50 text-center">
        <div class="flex items-center justify-between md:flex-col gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Waktu</div>
            <div>
                <div class="text-slate-600 text-[11px] font-bold">{{ $loan->tanggal_pinjam }}</div>
                <div class="text-slate-400 text-[10px]">s/d</div>
                <div class="text-slate-600 text-[11px] font-bold">{{ $loan->tanggal_kembali }}</div>
            </div>
        </div>
    </td>


    <!-- Status -->
    <td class="block md:table-cell md:align-middle px-4 py-3 border-b md:border-0 border-slate-50 text-center">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">Status</div>

            @if($loan->status === 'menunggu')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase bg-amber-100 text-amber-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                </span>
            @elseif($loan->status === 'disetujui')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disetujui
                </span>
            @elseif($loan->status === 'dipinjam')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Dipinjam
                </span>
            @elseif($loan->status === 'kembali')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase bg-slate-100 text-slate-600">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Selesai
                </span>
            @elseif($loan->status === 'ditolak')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase bg-red-100 text-red-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                </span>
            @endif
        </div>
    </td>

<!-- Aksi -->
<td class="block md:table-cell md:align-middle px-4 py-3 text-center">
    <div class="flex justify-between md:justify-center gap-2">
        <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-17.5">
            Aksi
        </div>

        <div class="flex gap-2 flex-wrap justify-end md:justify-center">
            @if($loan->status === 'menunggu')
                <form method="POST" action="{{ route('admin.loans.approve', $loan->id) }}">
                    @csrf
                    <button class="px-3 py-1 text-[10px] font-bold rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                        Setujui
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.loans.reject', $loan->id) }}">
                    @csrf
                    <button class="px-3 py-1 text-[10px] font-bold rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                        Tolak
                    </button>
                </form>

            @elseif($loan->status === 'disetujui')
                <form method="POST" action="{{ route('admin.loans.borrowed', $loan->id) }}">
                    @csrf
                    <button class="px-3 py-1 text-[10px] font-bold rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                        Pinjamkan
                    </button>
                </form>

            @elseif($loan->status === 'dipinjam')
                <form method="POST" action="{{ route('admin.loans.returned', $loan->id) }}">
                    @csrf
                    <button class="px-3 py-1 text-[10px] font-bold rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">
                        Selesai
                    </button>
                </form>
            @else
                <span class="text-slate-400 text-xs italic">-</span>
            @endif
        </div>
    </div>
</td>


</tr>
@endforeach

@if($loans->isEmpty())
<tr>
    <td colspan="8" class="px-6 py-12 text-center text-slate-400 italic">
        <div class="flex flex-col items-center gap-2 opacity-60">
            <i data-lucide="inbox" class="w-10 h-10"></i>
            Tidak ada data pengajuan peminjaman ditemukan.
        </div>
    </td>
</tr>
@endif
