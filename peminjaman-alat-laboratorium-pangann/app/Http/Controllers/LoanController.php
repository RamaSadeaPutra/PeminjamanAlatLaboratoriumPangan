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

        // Server-side Holiday Validation
        $holidayData = $this->getHolidays();
        
        if (isset($holidayData[$request->tanggal_pinjam])) {
            return back()->withErrors(['tanggal_pinjam' => "Tidak bisa meminjam di hari libur: " . $holidayData[$request->tanggal_pinjam]]);
        }

        if (isset($holidayData[$request->tanggal_kembali])) {
            return back()->withErrors(['tanggal_kembali' => "Tidak bisa mengembalikan di hari libur: " . $holidayData[$request->tanggal_kembali]]);
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

    /**
     * Helper to fetch holidays for 2025 and 2026 (Definitive SKB 3 Menteri)
     */
    private function getHolidays()
    {
        return Cache::remember('indonesian_holidays', 86400, function () {
            // Data Definitif SKB 3 Menteri (2025 & 2026)
            $holidayData = [
                // --- 2025 ---
                '2025-01-01' => 'Tahun Baru 2025 Masehi',
                '2025-01-27' => 'Isra Mikraj Nabi Muhammad SAW',
                '2025-01-28' => 'Cuti Bersama Tahun Baru Imlek',
                '2025-01-29' => 'Tahun Baru Imlek 2576 Kongzili',
                '2025-03-28' => 'Cuti Bersama Hari Suci Nyepi',
                '2025-03-29' => 'Hari Suci Nyepi',
                '2025-03-31' => 'Hari Raya Idulfitri 1446 H',
                '2025-04-01' => 'Hari Raya Idulfitri 1446 H',
                '2025-04-02' => 'Cuti Bersama Idulfitri',
                '2025-04-03' => 'Cuti Bersama Idulfitri',
                '2025-04-04' => 'Cuti Bersama Idulfitri',
                '2025-04-07' => 'Cuti Bersama Idulfitri',
                '2025-04-18' => 'Wafat Yesus Kristus',
                '2025-04-20' => 'Kebangkitan Yesus Kristus (Paskah)',
                '2025-05-01' => 'Hari Buruh Internasional',
                '2025-05-12' => 'Hari Raya Waisak 2569 BE',
                '2025-05-13' => 'Cuti Bersama Hari Raya Waisak',
                '2025-05-29' => 'Kenaikan Yesus Kristus',
                '2025-05-30' => 'Cuti Bersama Kenaikan Yesus Kristus',
                '2025-06-01' => 'Hari Lahir Pancasila',
                '2025-06-06' => 'Iduladha 1446 H',
                '2025-06-09' => 'Cuti Bersama Iduladha',
                '2025-06-27' => '1 Muharam Tahun Baru Islam 1447 H',
                '2025-08-17' => 'Proklamasi Kemerdekaan RI',
                '2025-09-05' => 'Maulid Nabi Muhammad SAW',
                '2025-12-25' => 'Kelahiran Yesus Kristus (Natal)',
                '2025-12-26' => 'Cuti Bersama Natal',

                // --- 2026 ---
                '2026-01-01' => 'Tahun Baru Masehi 2026',
                '2026-01-16' => 'Isra Mikraj Nabi Muhammad SAW',
                '2026-02-16' => 'Cuti Bersama Tahun Baru Imlek',
                '2026-02-17' => 'Tahun Baru Imlek 2577 Kongzili',
                '2026-03-18' => 'Cuti Bersama Hari Suci Nyepi',
                '2026-03-19' => 'Hari Suci Nyepi',
                '2026-03-20' => 'Cuti Bersama Idul Fitri 1447 H',
                '2026-03-21' => 'Hari Raya Idul Fitri 1447 H',
                '2026-03-22' => 'Hari Raya Idul Fitri 1447 H',
                '2026-03-23' => 'Cuti Bersama Idul Fitri 1447 H',
                '2026-03-24' => 'Cuti Bersama Idul Fitri 1447 H',
                '2026-04-03' => 'Wafat Yesus Kristus',
                '2026-04-05' => 'Kebangkitan Yesus Kristus (Paskah)',
                '2026-05-01' => 'Hari Buruh Internasional',
                '2026-05-14' => 'Kenaikan Yesus Kristus',
                '2026-05-15' => 'Cuti Bersama Kenaikan Yesus Kristus',
                '2026-05-27' => 'Idul Adha 1447 H',
                '2026-05-28' => 'Cuti Bersama Idul Adha 1447 H',
                '2026-05-31' => 'Hari Raya Waisak 2570 BE',
                '2026-06-01' => 'Hari Lahir Pancasila',
                '2026-06-16' => 'Tahun Baru Islam 1448 H',
                '2026-08-17' => 'Hari Kemerdekaan RI',
                '2026-08-25' => 'Maulid Nabi Muhammad SAW',
                '2026-12-24' => 'Cuti Bersama Natal',
                '2026-12-25' => 'Hari Raya Natal',
            ];

            // Opsional: Coba update dari API jika ada yang baru (Merge)
            try {
                $response = Http::withoutVerifying()->get("https://api-harilibur.vercel.app/api");
                if ($response->successful()) {
                    foreach ($response->json() as $h) {
                        $date = date('Y-m-d', strtotime($h['holiday_date']));
                        if (!isset($holidayData[$date])) {
                            $holidayData[$date] = $h['holiday_name'];
                        }
                    }
                }
            } catch (\Exception $e) { /* Abaikan error API */ }

            return $holidayData;
        });
    }
}
