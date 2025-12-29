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
                <th width="5%" style="text-align: center;">No</th>
                <th style="text-align: center;">Nama Peminjam</th>
                <th style="text-align: center;">NIM</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Nama Alat</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Pinjam</th>
                <th style="text-align: center;">Kembali</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: center;"><strong>{{ $loan->user->name ?? '-' }}</strong></td>
                <td style="text-align: center;">{{ $loan->user->nim ?? '-' }}</td>
                <td style="text-align: center; font-size: 10px;">{{ $loan->user->email ?? '-' }}</td>
                <td style="text-align: center;">{{ $loan->tool->tool_name ?? '-' }}</td>
                <td style="text-align: center;">{{ $loan->jumlah }}</td>
                <td style="text-align: center;">{{ $loan->tanggal_pinjam }}</td>
                <td style="text-align: center;">{{ $loan->tanggal_kembali ?? '-' }}</td>
                <td style="text-align: center;">
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
