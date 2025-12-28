<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\User;
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
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->get();

        // Mengembalikan partial view untuk diupdate via JavaScript
        if ($request->ajax()) {
            return view('partials.user_list', compact('users'))->render();
        }

        return abort(404);
    }
}
