@extends('layouts.app')

@section('title', 'Pengajuan Saya')

@section('content')
<div style="max-width:800px;margin:auto">

    <h2 style="font-size:22px;font-weight:700;margin-bottom:16px">
        Pengajuan Peminjaman Saya
    </h2>

    @if(session('success'))
        <div style="background:#dcfce7;padding:12px;border-radius:8px;margin-bottom:16px">
            {{ session('success') }}
        </div>
    @endif

    <table width="100%" cellpadding="10" style="background:white">
        <thead>
            <tr>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->tool->tool_name ?? '-' }}</td>
                    <td>{{ $loan->jumlah }}</td>
                    <td>
                        {{ $loan->tanggal_pinjam }}<br>
                        s/d {{ $loan->tanggal_kembali }}
                    </td>
                    <td>
                        @if($loan->status == 'menunggu')
                            <span style="color:#ca8a04">Menunggu</span>
                        @elseif($loan->status == 'disetujui')
                            <span style="color:#16a34a">Disetujui</span>
                        @else
                            <span style="color:#dc2626">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
