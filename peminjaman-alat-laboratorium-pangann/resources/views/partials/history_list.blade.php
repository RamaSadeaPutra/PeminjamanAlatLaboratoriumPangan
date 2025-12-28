@foreach($loans as $loan)
<tr style="border-bottom:1px solid #e5e7eb;">
    <td>{{ $loan->user->name }}</td>
    <td>{{ $loan->tool->tool_name }}</td>
    <td>{{ $loan->jumlah }}</td>
    <td>{{ $loan->tanggal_pinjam }}</td>
    <td>{{ $loan->tanggal_kembali }}</td>
    <td>
        @if($loan->status === 'kembali')
            <span style="color:#64748b;">Dikembalikan</span>
        @elseif($loan->status === 'ditolak')
            <span style="color:#ef4444;">Ditolak</span>
        @else
            <span style="color:#334155;">{{ ucfirst($loan->status) }}</span>
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
