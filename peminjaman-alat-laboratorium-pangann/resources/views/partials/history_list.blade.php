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
        @if($loan->status === 'kembali')
            <span style="color:#64748b; font-weight: 600;">Dikembalikan</span>
        @elseif($loan->status === 'ditolak')
            <span style="color:#ef4444; font-weight: 600;">Ditolak</span>
        @else
            <span style="color:#334155; font-weight: 600;">{{ ucfirst($loan->status) }}</span>
        @endif
    </td>
</tr>
@endforeach

@if($loans->isEmpty())
<tr>
    <td colspan="6" style="text-align:center; padding:20px; color:gray;">
        Tidak ada data riwayat ditemukan.
    </td>
</tr>
@endif
