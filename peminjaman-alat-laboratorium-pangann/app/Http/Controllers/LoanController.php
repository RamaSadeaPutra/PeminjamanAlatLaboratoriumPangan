<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LoanController extends Controller
{
    // =========================
    // USER - DAFTAR PEMINJAMAN
    // =========================
    public function index()
    {
        $loans = Loan::with('tool')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->latest()
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function history()
    {
        $loans = Loan::with('tool')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['kembali', 'ditolak'])
            ->latest()
            ->get();

        return view('loans.history', compact('loans'));
    }

    // =========================
    // USER - FORM PINJAM
    // =========================
    public function create(Tool $tool)
    {
        $tools = Tool::all();
        $holidayData = $this->getHolidays();

        return view('loans.create', compact('tool', 'tools', 'holidayData'));
    }

    // =========================
    // USER - SIMPAN PENGAJUAN
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $holidayData = $this->getHolidays();

        if (isset($holidayData[$request->tanggal_pinjam])) {
            return back()->withErrors([
                'tanggal_pinjam' => 'Tidak bisa meminjam di hari libur: ' . $holidayData[$request->tanggal_pinjam]
            ]);
        }

        if (isset($holidayData[$request->tanggal_kembali])) {
            return back()->withErrors([
                'tanggal_kembali' => 'Tidak bisa mengembalikan di hari libur: ' . $holidayData[$request->tanggal_kembali]
            ]);
        }

        Loan::create([
            'user_id' => Auth::id(),
            'tool_id' => $request->tool_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('user.loans.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }



private function internalHolidays()
{
    return [
        // ===== 2025 =====
        '2025-03-31' => 'Hari Raya Idul Fitri 1446 H',
        '2025-04-01' => 'Hari Raya Idul Fitri 1446 H',
        '2025-04-02' => 'Cuti Bersama Idul Fitri',
        '2025-04-03' => 'Cuti Bersama Idul Fitri',
        '2025-06-07' => 'Hari Raya Idul Adha 1446 H',
        '2025-08-17' => 'Hari Kemerdekaan Republik Indonesia',

        // ===== 2026 =====
        '2026-01-01' => 'Tahun Baru Masehi',
        '2026-02-17' => 'Tahun Baru Imlek 2577 Kongzili',
        '2026-03-19' => 'Hari Raya Nyepi Tahun Baru Saka 1948',
        '2026-03-20' => 'Hari Raya Idul Fitri 1447 H',
        '2026-03-21' => 'Hari Raya Idul Fitri 1447 H',
        '2026-03-22' => 'Cuti Bersama Idul Fitri',
        '2026-03-23' => 'Cuti Bersama Idul Fitri',
        '2026-04-03' => 'Wafat Isa Almasih',
        '2026-04-05' => 'Hari Paskah',
        '2026-05-01' => 'Hari Buruh Internasional',
        '2026-05-14' => 'Kenaikan Isa Almasih',
        '2026-05-27' => 'Hari Raya Idul Adha 1447 H',
        '2026-05-31' => 'Hari Raya Waisak 2570 BE',
        '2026-06-16' => 'Tahun Baru Islam 1448 H',
        '2026-08-17' => 'Hari Kemerdekaan Republik Indonesia',
        '2026-09-05' => 'Maulid Nabi Muhammad SAW',
        '2026-12-25' => 'Hari Raya Natal',
    ];
}


    /**
     * Ambil hari libur dari API (tanpa data manual)
     */
 private function getHolidays()
{
    return Cache::remember('indonesian_holidays_2025_2026', 86400, function () {

        // Libur internal (backup utama)
        $holidays = $this->internalHolidays();

        try {
            $json = @file_get_contents('https://api-harilibur.vercel.app/api');

            if ($json !== false) {
                $data = json_decode($json, true);

                if (is_array($data)) {
                    foreach ($data as $h) {
                        if (!isset($h['holiday_date'])) continue;

                        $year = date('Y', strtotime($h['holiday_date']));

                        if (in_array($year, ['2025', '2026'])) {
                            $date = date('Y-m-d', strtotime($h['holiday_date']));
                            $holidays[$date] = $h['holiday_name'] ?? 'Hari Libur';
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // Kalau gagal → internal tetap dipakai
        }

        return $holidays;
    });
}




}
