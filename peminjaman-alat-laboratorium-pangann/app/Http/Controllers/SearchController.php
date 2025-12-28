<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Fungsi untuk mencari alat laboratorium berdasarkan nama atau kategori
     * Mengembalikan daftar alat yang sesuai dengan keyword pencarian
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
}
