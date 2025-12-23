@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="card">
    <h3>Daftar Peminjaman Alat</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Detail Alat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->return_date }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                    <td>
                        <ul>
                            @foreach($loan->details as $detail)
                                <li>
                                    {{ $detail->tool->tool_name }}
                                    ({{ $detail->quantity }})
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
