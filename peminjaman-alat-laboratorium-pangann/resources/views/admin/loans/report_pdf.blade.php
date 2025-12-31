<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Riwayat Peminjaman Alat</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 20px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
        }
        .header h2 { 
            margin: 0; 
            font-size: 18px;
        }
        .header p { 
            margin: 5px 0; 
            color: #666; 
            font-size: 12px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #333; 
            padding: 8px 6px; 
            text-align: left; 
        }
        th { 
            background-color: #e0e0e0; 
            font-size: 11px; 
            text-transform: uppercase; 
            font-weight: bold;
        }
        td { 
            font-size: 10px; 
        }
        .status-kembali { 
            color: #333; 
            font-weight: bold; 
        }
        .status-ditolak { 
            color: #000; 
            font-weight: bold; 
        }
        .footer { 
            margin-top: 30px; 
            text-align: right; 
            font-size: 10px; 
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN RIWAYAT PEMINJAMAN</h2>
        <p>Laboratorium Pangan - Tanggal Cetak: {{ date('d F Y') }}</p>
        @if(!empty($month))
            @php
                try {
                    $parts = explode('-', $month);
                    $label = \Carbon\Carbon::createFromDate($parts[0], $parts[1], 1)->format('F Y');
                } catch (\Exception $e) {
                    $label = $month;
                }
            @endphp
            <p>Periode: {{ $label }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%" style="text-align: center;">No</th>
                <th width="15%" style="text-align: center;">Nama Peminjam</th>
                <th width="10%" style="text-align: center;">NIM</th>
                <th width="18%" style="text-align: center;">Email</th>
                <th width="18%" style="text-align: center;">Nama Alat</th>
                <th width="6%" style="text-align: center;">Jumlah</th>
                <th width="10%" style="text-align: center;">Pinjam</th>
                <th width="10%" style="text-align: center;">Kembali</th>
                <th width="9%" style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: center;"><strong>{{ $loan->user->name ?? '-' }}</strong></td>
                <td style="text-align: center;">{{ $loan->user->nim ?? '-' }}</td>
                <td style="text-align: center; font-size: 8px;">{{ $loan->user->email ?? '-' }}</td>
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
