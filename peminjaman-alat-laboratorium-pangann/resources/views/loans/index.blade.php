@extends('layouts.user')

@section('title', 'Data Peminjaman')

@section('content')
<div class="content-header" style="margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="font-size:22px; font-weight:700; margin:0;">Daftar Peminjaman Alat</h1>
        <p style="margin:4px 0 0; color:#64748b; font-size:14px;">
            Monitoring peminjaman alat laboratorium
        </p>
    </div>

    <a href="{{ route('user.tools.index') }}" class="btn-primary">
        <i data-lucide="plus"></i> Tambah Peminjaman
    </a>
</div>

@if(session('success'))
    <div style="
        margin-bottom:20px;
        padding:14px 18px;
        background:#dcfce7;
        color:#166534;
        border-radius:12px;
        font-weight:600;
        display:flex;
        align-items:center;
        gap:10px;">
        <i data-lucide="check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
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
        {{ $loan->status }}
    </span>
@endif

                </td>

               
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:40px; color:#94a3b8;">
                    <i data-lucide="inbox" size="40"></i>
                    <p style="margin-top:10px;">Belum ada data peminjaman</p>
                </td>
            </tr>
            @endforelse
        </tbody>    
    </table>
</div>

<script>
    lucide.createIcons();
</script>
@endsection
