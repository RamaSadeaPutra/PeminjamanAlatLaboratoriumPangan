@foreach($loans as $loan)
<tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">
    <!-- Nama -->
    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Peminjam</div>
            <div class="font-bold text-slate-800 text-[13px] tracking-tight text-right md:text-left">
                {{ $loan->user->name ?? 'User Terhapus' }}
            </div>
        </div>
    </td>

    <!-- NIM -->
    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">NIM</div>
            <div class="text-[11px] font-bold text-blue-600 uppercase tracking-tight text-right md:text-left">
                {{ $loan->user->nim ?? '-' }}
            </div>
        </div>
    </td>

    <!-- Email -->
    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-start gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Email</div>
            <div class="text-[10px] text-slate-500 italic text-right md:text-left truncate">
                {{ $loan->user->email ?? '-' }}
            </div>
        </div>
    </td>

    <!-- Tool & Quantity -->
    <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50 text-center md:text-left">
        <div class="flex items-center justify-between md:flex-col md:items-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Alat</div>
            <div class="text-right md:text-center">
                <div class="font-bold text-blue-600 text-xs">{{ $loan->tool->tool_name ?? 'Alat Terhapus' }}</div>
                <div class="text-[10px] font-black text-slate-500 uppercase">Jumlah: {{ $loan->jumlah }}</div>
            </div>
        </div>
    </td>

    <!-- Date Range -->
    <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:flex-col md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Waktu</div>
            <div class="text-right md:text-center">
                <div class="text-slate-600 text-[11px] font-bold md:font-medium">{{ $loan->tanggal_pinjam }}</div>
                <div class="md:hidden inline-block text-slate-400 text-[10px] px-2">sampai</div>
                <div class="hidden md:block text-slate-400 text-[10px]">s/d</div>
                <div class="text-slate-600 text-[11px] font-bold md:font-medium">{{ $loan->tanggal_kembali }}</div>
            </div>
        </div>
    </td>

    <!-- Status -->
    <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Status</div>
            <div>
                @if($loan->status === 'menunggu')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-amber-100 text-amber-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        Menunggu
                    </span>
                @elseif($loan->status === 'disetujui')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Disetujui
                    </span>
                @elseif($loan->status === 'dipinjam')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        Dipinjam
                    </span>
                @elseif($loan->status === 'kembali')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-slate-100 text-slate-600 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                        Selesai
                    </span>
                @elseif($loan->status === 'ditolak')
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-red-100 text-red-700 ring-2 ring-white">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        Ditolak
                    </span>
                @endif
            </div>
        </div>
    </td>

    <!-- Aksi -->
    <td class="block md:table-cell px-4 py-4 md:py-3 text-center">
        <div class="flex items-center justify-between md:justify-center gap-4">
            <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Opsi</div>
            <div class="flex-1 md:flex-none">
                @if($loan->status === 'menunggu')
                    <div class="flex items-center gap-2 justify-end md:justify-center">
                        <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                            @csrf
                            <button class="p-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl shadow-lg shadow-emerald-100 transition-all active:scale-95" title="Setujui">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </button>
                        </form>

                        <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                            @csrf
                            <button class="p-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-lg shadow-red-100 transition-all active:scale-95" title="Tolak">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                @elseif($loan->status === 'disetujui')
                    <form action="{{ route('admin.loans.borrowed', $loan->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="w-full md:w-auto inline-flex justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95">
                            Selesaikan Pinjam
                        </button>
                    </form>
                @elseif($loan->status === 'dipinjam')
                    <form action="{{ route('admin.loans.returned', $loan->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="w-full md:w-auto inline-flex justify-center px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg transition-all active:scale-95">
                            Tandai Kembali
                        </button>
                    </form>
                @else
                    <span class="text-slate-300">—</span>
                @endif
            </div>
        </div>
    </td>
</tr>
@endforeach

@if($loans->isEmpty())
<tr>
    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
        <div class="flex flex-col items-center gap-2 opacity-60">
            <i data-lucide="inbox" class="w-10 h-10"></i>
            Tidak ada data pengajuan peminjaman ditemukan.
        </div>
    </td>
</tr>
@endif
