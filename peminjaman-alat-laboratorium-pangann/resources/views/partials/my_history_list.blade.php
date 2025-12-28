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
    <td colspan="11" style="text-align:center; padding:40px; color:#94a3b8;">
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px;">
            <i data-lucide="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
            <p style="margin: 0; font-size: 15px;">Riwayat tidak ditemukan</p>
        </div>
    </td>
</tr>
@endforelse
