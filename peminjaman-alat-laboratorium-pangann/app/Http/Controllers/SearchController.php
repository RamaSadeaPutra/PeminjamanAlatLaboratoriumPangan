<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Fungsi untuk mencari alat laboratorium berdasarkan nama atau kategori
     * Mendukung Live Search via AJAX
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Mencari tools berdasarkan nama_alat atau relasi kategori
        $tools = Tool::with(['lab', 'category'])
            ->where('stock', '>', 0)
            ->where(function($q) use ($query) {
                $q->where('tool_name', 'LIKE', "%{$query}%")
                  ->orWhereHas('category', function($catQuery) use ($query) {
                      $catQuery->where('name', 'LIKE', "%{$query}%");
                  });
            })
            ->get();

        // Mengembalikan view partial jika request via AJAX untuk live search
        if ($request->ajax()) {
            return view('partials.tool_list', compact('tools'))->render();
        }

        // Mengembalikan view search dengan data hasil pencarian (full page)
        return view('search', compact('tools', 'query'));
    }

    /**
     * Fungsi untuk mencari user yang statusnya masih 'pending' (Persetujuan Akun)
     * Digunakan untuk fitur Live Search di dashboard admin
     */
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        // Mencari user pending berdasarkan nama atau email
        $users = User::where('status', 'pending')
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%")
                  ->orWhere('nim', 'LIKE', "%{$query}%");
            })
            ->get();

        // Mengembalikan partial view untuk diupdate via JavaScript
        if ($request->ajax()) {
            return view('partials.user_list', compact('users'))->render();
        }

        return abort(404);
    }

    /**
     * Fungsi untuk mencari pengajuan peminjaman (Loan Request)
     * Mencari berdasarkan nama user atau nama alat
     */
    public function searchLoans(Request $request)
    {
        $query = $request->input('query');

        // Mencari loans yang belum selesai (menunggu, disetujui, dipinjam)
        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->where(function($q) use ($query) {
                $q->whereHas('user', function($u) use ($query) {
                    $u->where('name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('tool', function($t) use ($query) {
                    $t->where('tool_name', 'LIKE', "%{$query}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengembalikan partial view untuk AJAX
        if ($request->ajax()) {
            return view('partials.loan_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Fungsi untuk mencari riwayat peminjaman yang sudah selesai (kembali atau ditolak)
     * Digunakan untuk fitur Live Search di halaman riwayat admin
     */
    public function searchHistory(Request $request)
    {
        $query = $request->input('query');

        // Mencari loans yang sudah selesai (kembali, ditolak)
        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['kembali', 'ditolak'])
            ->where(function($q) use ($query) {
                $q->whereHas('user', function($u) use ($query) {
                    $u->where('name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('tool', function($t) use ($query) {
                    $t->where('tool_name', 'LIKE', "%{$query}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengembalikan partial view untuk update tabel secara dinamis
        if ($request->ajax()) {
            return view('partials.history_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Fungsi untuk mencari pinjaman milik user sendiri (User Dashboard)
     * Memberikan hasil instan saat user mencari di menu "Pinjaman Saya"
     */
    public function searchMyLoans(Request $request)
    {
        $query = $request->input('query');
        $userId = auth()->id();

        // Mencari loans milik user yang sedang login berdasarkan nama alat
        $loans = Loan::with(['tool', 'user'])
            ->where('user_id', $userId)
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->whereHas('tool', function($t) use ($query) {
                $t->where('tool_name', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();

        // Mengirimkan partial view khusus pinjaman user
        if ($request->ajax()) {
            return view('partials.my_loan_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Fungsi untuk mencari riwayat pinjaman milik user sendiri
     * Memungkinkan user mencari data lama mereka secara instan di menu "Riwayat Peminjaman"
     */
    public function searchMyHistory(Request $request)
    {
        $query = $request->input('query');
        $userId = auth()->id();

        // Mencari riwayat (kembali/ditolak) milik user login berdasarkan nama alat
        $loans = Loan::with(['tool'])
            ->where('user_id', $userId)
            ->whereIn('status', ['kembali', 'ditolak'])
            ->whereHas('tool', function($t) use ($query) {
                $t->where('tool_name', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();

        // Mengirimkan partial view khusus riwayat user
        if ($request->ajax()) {
            return view('partials.my_history_list', compact('loans'))->render();
        }

        return abort(404);
    }
}
