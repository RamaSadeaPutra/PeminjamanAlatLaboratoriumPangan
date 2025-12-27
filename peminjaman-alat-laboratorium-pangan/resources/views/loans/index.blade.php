@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="content-header" style="margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="font-size:22px; font-weight:700; margin:0;">Daftar Peminjaman Alat</h1>
        <p style="margin:4px 0 0; color:#64748b; font-size:14px;">
            Monitoring peminjaman alat laboratorium
        </p>
    </div>

    <a href="{{ route('loans.create') }}" class="btn-primary">
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
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($loans as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight:600;">{{ $loan->borrower_name }}</td>
                <td>{{ $loan->tool->tool_name ?? '-' }}</td>
                <td>{{ $loan->quantity }}</td>
                <td>{{ $loan->loan_date }}</td>
                <td>{{ $loan->return_date ?? '-' }}</td>

                {{-- STATUS --}}
                <td>

                    @php
                        $statusClass = match(strtolower($loan->status)) {
                            'dipinjam' => 'warn',
                            'dikembalikan' => 'good',
                            default => 'bad',
                        };
                    @endphp

                    <span class="badge {{ $statusClass }}">
                        {{ strtoupper($loan->status) }}
                    </span>

      @if($loan->status === 'menunggu')
    <span style="color:#f59e0b; font-weight:600;">
        Menunggu Persetujuan
    </span>
@elseif($loan->status === 'disetujui')
    <span style="color:#22c55e; font-weight:600;">
        Disetujui
    </span>
@else
    <span style="color:#ef4444; font-weight:600;">
        Ditolak
    </span>
@endif


                </td>

                {{-- AKSI --}}
                <td style="text-align:center;">
                    <div style="display:flex; justify-content:center; gap:8px;">
                        <a href=""
                           title="Edit"
                           style="
                                padding:8px;
                                border-radius:10px;
                                background:#e0e7ff;
                                color:#1d4ed8;">
                            <i data-lucide="edit" size="16"></i>
                        </a>

                        <form action=""
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                title="Hapus"
                                style="
                                    padding:8px;
                                    border-radius:10px;
                                    background:#fee2e2;
                                    color:#991b1b;
                                    border:none;
                                    cursor:pointer;">
                                <i data-lucide="trash-2" size="16"></i>
                            </button>
                        </form>
                    </div>
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
