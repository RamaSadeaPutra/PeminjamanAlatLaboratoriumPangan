@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div style="max-width: 1100px; margin:auto; padding:32px">

    <h2 style="font-size:22px; font-weight:700; margin-bottom:20px;">
        Riwayat Peminjaman (Selesai/Ditolak)
    </h2>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
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
                    @if($loan->status === 'kembali')
                        <span style="color:#64748b;">Dikembalikan</span>
                    @elseif($loan->status === 'ditolak')
                        <span style="color:#ef4444;">Ditolak</span>
                    @else
                        {{ $loan->status }}
                    @endif
                </td>
            </tr>
            @endforeach
            
             @if($loans->isEmpty())
            <tr>
                <td colspan="6" style="text-align:center; padding:20px; color:gray;">
                    Belum ada riwayat peminjaman.
                </td>
            </tr>
            @endif
        </tbody>
    </table>

</div>
@endsection
