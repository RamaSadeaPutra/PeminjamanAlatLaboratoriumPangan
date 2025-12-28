@forelse ($loans as $loan)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td style="font-weight:600;">{{ $loan->user->name ?? '-' }}</td>
    <td>{{ $loan->tool->tool_name ?? '-' }}</td>
    <td>{{ $loan->jumlah }}</td>
    <td>{{ $loan->tanggal_pinjam }}</td>
    <td>{{ $loan->tanggal_kembali ?? '-' }}</td>

    {{-- STATUS --}}
    <td>
        @if($loan->status === 'menunggu')
            <span style="color:#f59e0b; font-weight:600;">
                Menunggu Persetujuan
            </span>
        @elseif($loan->status === 'disetujui')
            <span style="color:#22c55e; font-weight:600;">
                Disetujui
            </span>
        @elseif($loan->status === 'dipinjam')
            <span style="color:#3b82f6; font-weight:600;">
                Sedang Dipinjam
            </span>
        @else
            <span style="color:#ef4444; font-weight:600;">
                {{ ucfirst($loan->status) }}
            </span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="7" style="text-align:center; padding:40px; color:#94a3b8;">
        <i data-lucide="inbox" size="40"></i>
        <p style="margin-top:10px;">Data pinjaman tidak ditemukan</p>
    </td>
</tr>
@endforelse
