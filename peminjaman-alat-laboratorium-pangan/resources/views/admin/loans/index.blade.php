@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')
<div style="max-width: 1100px; margin:auto; padding:32px">

    <h2 style="font-size:22px; font-weight:700; margin-bottom:20px;">
        Pengajuan Peminjaman
    </h2>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color:red; margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    <table width="100%" cellpadding="12" style="border-collapse: collapse;">
        <thead style="background:#f1f5f9;">
            <tr>
                <th>User</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr style="border-bottom:1px solid #e5e7eb;">
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->tool->tool_name }}</td>
                <td>{{ $loan->jumlah }}</td>
                <td>{{ $loan->tanggal_pinjam }}</td>
                <td>{{ $loan->tanggal_kembali }}</td>
                <td>
                    @if($loan->status === 'menunggu')
                        <span style="color:#f59e0b;">Menunggu</span>
                    @elseif($loan->status === 'disetujui')
                        <span style="color:#22c55e;">Disetujui</span>
                    @else
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
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
