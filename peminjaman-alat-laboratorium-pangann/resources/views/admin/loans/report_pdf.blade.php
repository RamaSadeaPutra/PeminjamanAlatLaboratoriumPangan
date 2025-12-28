<!DOCTYPE html>
<html>
<head>
    <title>Laporan Riwayat Peminjaman Alat</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #661; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px 8px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 13px; text-transform: uppercase; }
        td { font-size: 12px; }
        .status-kembali { color: #64748b; font-weight: bold; }
        .status-ditolak { color: #ef4444; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN RIWAYAT PEMINJAMAN</h2>
        <p>Laboratorium Pangan - Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Peminjam</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Pinjam</th>
                <th>Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $loan->user->name ?? '-' }}</td>
                <td>{{ $loan->tool->tool_name ?? '-' }}</td>
                <td>{{ $loan->jumlah }}</td>
                <td>{{ $loan->tanggal_pinjam }}</td>
                <td>{{ $loan->tanggal_kembali ?? '-' }}</td>
                <td>
                    @if($loan->status === 'kembali')
                        <span class="status-kembali">Selesai</span>
                    @else
                        <span class="status-ditolak">Ditolak</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem Peminjaman Alat Lab
    </div>

</body>
</html>
