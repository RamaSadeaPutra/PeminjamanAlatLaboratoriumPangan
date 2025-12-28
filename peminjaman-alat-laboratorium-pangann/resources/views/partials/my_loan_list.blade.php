@forelse ($loans as $loan)
<tr>
    <td style="text-align: center;">{{ $loop->iteration }}</td>
    <td style="text-align: center;">
        <div style="font-weight: 600;">{{ $loan->user->name ?? '-' }}</div>
    </td>
    <td style="text-align: center;">{{ $loan->user->nim ?? '-' }}</td>
    <td style="text-align: center; color: #64748b; font-size: 13px;">{{ $loan->user->email ?? '-' }}</td>
    <td style="text-align: center;">{{ $loan->tool->tool_name ?? '-' }}</td>
    <td style="text-align: center;">{{ $loan->jumlah }}</td>
    <td style="text-align: center;">{{ $loan->tanggal_pinjam }}</td>
    <td style="text-align: center;">{{ $loan->tanggal_kembali ?? '-' }}</td>

    {{-- STATUS --}}
    <td style="text-align: center;">
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
    <td colspan="9" style="text-align:center; padding:40px; color:#94a3b8;">
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px;">
            <i data-lucide="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
            <p style="margin: 0; font-size: 15px;">Data pinjaman tidak ditemukan</p>
        </div>
    </td>
</tr>
@endforelse
