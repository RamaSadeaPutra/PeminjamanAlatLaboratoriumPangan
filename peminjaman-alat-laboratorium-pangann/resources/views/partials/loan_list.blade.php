@foreach($loans as $loan)
<tr style="border-bottom:1px solid #e5e7eb;">
    <td style="text-align: center;">
        <div style="font-weight: 600;">{{ $loan->user->name ?? 'User Terhapus' }}</div>
    </td>
    <td style="text-align: center;">{{ $loan->user->nim ?? '-' }}</td>
    <td style="text-align: center; color: #64748b; font-size: 13px;">{{ $loan->user->email ?? '-' }}</td>
    <td style="text-align: center;">{{ $loan->tool->tool_name ?? 'Alat Terhapus' }}</td>
    <td style="text-align: center;">{{ $loan->jumlah }}</td>
    <td style="text-align: center;">{{ $loan->tanggal_pinjam }}</td>
    <td style="text-align: center;">{{ $loan->tanggal_kembali }}</td>
    <td style="text-align: center;">
        @if($loan->status === 'menunggu')
            <span style="color:#f59e0b; font-weight: 600;">Menunggu</span>
        @elseif($loan->status === 'disetujui')
            <span style="color:#22c55e; font-weight: 600;">Disetujui</span>
        @elseif($loan->status === 'dipinjam')
            <span style="color:#3b82f6; font-weight: 600;">Dipinjam</span>
        @elseif($loan->status === 'kembali')
            <span style="color:#64748b; font-weight: 600;">Dikembalikan</span>
        @elseif($loan->status === 'ditolak')
            <span style="color:#ef4444; font-weight: 600;">Ditolak</span>
        @endif
    </td>
    <td style="text-align: center;">
        @if($loan->status === 'menunggu')
            <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#22c55e;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">
                    ACC
                </button>
            </form>

            <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#ef4444;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Tolak
                </button>
            </form>
        @elseif($loan->status === 'disetujui')
            <form action="{{ route('admin.loans.borrowed', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#3b82f6;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Tandai Dipinjam
                </button>
            </form>
        @elseif($loan->status === 'dipinjam')
            <form action="{{ route('admin.loans.returned', $loan->id) }}" method="POST" style="display:inline">
                @csrf
                <button style="background:#64748b;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">
                    Tandai Kembali
                </button>
            </form>
        @elseif($loan->status === 'kembali')
            <span style="color:#64748b; font-weight: 600;">Selesai</span>
        @else
            -
        @endif
    </td>
</tr>
@endforeach
@if($loans->isEmpty())
<tr>
    <td colspan="9" style="text-align:center; padding: 20px; color: #64748b;">
        Tidak ada data pengajuan peminjaman ditemukan.
    </td>
</tr>
@endif
