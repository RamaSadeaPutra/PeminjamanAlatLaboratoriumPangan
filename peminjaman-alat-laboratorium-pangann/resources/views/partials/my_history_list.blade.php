@forelse ($loans as $loan)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td style="font-weight:600;">{{ $loan->tool->tool_name ?? '-' }}</td>
    <td>{{ $loan->jumlah }}</td>
    <td>{{ $loan->tanggal_pinjam }}</td>
    <td>{{ $loan->tanggal_kembali ?? '-' }}</td>

    {{-- STATUS --}}
    <td>
        @if($loan->status === 'kembali')
            <span style="color:#64748b; font-weight:600;">Selesai</span>
        @elseif($loan->status === 'ditolak')
            <span style="color:#ef4444; font-weight:600;">Ditolak</span>
        @else
            <span style="color:#334155; font-weight:600;">{{ ucfirst($loan->status) }}</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="6" style="text-align:center; padding:40px; color:#94a3b8;">
        <i data-lucide="inbox" size="40"></i>
        <p style="margin-top:10px;">Riwayat tidak ditemukan</p>
    </td>
</tr>
@endforelse
