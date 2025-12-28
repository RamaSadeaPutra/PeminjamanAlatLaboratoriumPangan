@foreach($loans as $loan)
<tr style="border-bottom:1px solid #e5e7eb;">
    <td>
        <div>{{ $loan->user->name ?? 'User Terhapus' }}</div>
        <div style="font-size: 11px; color: #64748b;">{{ $loan->user->nim ?? '-' }}</div>
    </td>
    <td>{{ $loan->tool->tool_name ?? 'Alat Terhapus' }}</td>
    <td>{{ $loan->jumlah }}</td>
    <td>{{ $loan->tanggal_pinjam }}</td>
    <td>{{ $loan->tanggal_kembali }}</td>
    <td>
        @if($loan->status === 'menunggu')
            <span style="color:#f59e0b;">Menunggu</span>
        @elseif($loan->status === 'disetujui')
            <span style="color:#22c55e;">Disetujui</span>
        @elseif($loan->status === 'dipinjam')
            <span style="color:#3b82f6;">Dipinjam</span>
        @elseif($loan->status === 'kembali')
            <span style="color:#64748b;">Dikembalikan</span>
        @elseif($loan->status === 'ditolak')
            <span style="color:#ef4444;">Ditolak</span>
        @endif
    </td>
    <td>
        @if($loan->status === 'menunggu')
            <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#22c55e;color:white;border:none;padding:6px 12px;border-radius:6px;">
                    ACC
                </button>
            </form>

            <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#ef4444;color:white;border:none;padding:6px 12px;border-radius:6px;">
                    Tolak
                </button>
            </form>
        @elseif($loan->status === 'disetujui')
            <form action="{{ route('admin.loans.borrowed', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#3b82f6;color:white;border:none;padding:6px 12px;border-radius:6px;">
                    Tandai Dipinjam
                </button>
            </form>
        @elseif($loan->status === 'dipinjam')
            <form action="{{ route('admin.loans.returned', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#64748b;color:white;border:none;padding:6px 12px;border-radius:6px;">
                    Tandai Kembali
                </button>
            </form>
        @elseif($loan->status === 'kembali')
            <span style="color:#64748b;">Selesai</span>
        @else
            -
        @endif
    </td>
</tr>
@endforeach
@if($loans->isEmpty())
<tr>
    <td colspan="7" style="text-align:center; padding: 20px; color: #64748b;">
        Tidak ada data pengajuan peminjaman ditemukan.
    </td>
</tr>
@endif
