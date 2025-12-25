<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Tool;
use App\Models\LoanDetail;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Tampilkan form peminjaman alat
    public function create()
    {
        $tools = Tool::all();  // Ambil semua alat
        return view('loans.create', compact('tools'));
    }

    // Simpan data peminjaman alat
   public function store(Request $request)
{
    $request->validate([
        'tool_id' => 'required|exists:tools,id',
        'quantity' => 'required|integer|min:1',
        'loan_date' => 'required|date',
        'return_date' => 'required|date|after:loan_date',
    ]);

    $tool = Tool::findOrFail($request->tool_id);

    // 🚨 VALIDASI STOK
    if ($request->quantity > $tool->stock) {
        return back()->withErrors([
            'quantity' => 'Stok tidak mencukupi'
        ]);
    }

    // SIMPAN PEMINJAMAN
    $loan = Loan::create([
        'user_id' => 1, // sementara (belum login)
        'loan_date' => $request->loan_date,
        'return_date' => $request->return_date,
        'status' => 'dipinjam',
    ]);

    LoanDetail::create([
        'loan_id' => $loan->id,
        'tool_id' => $tool->id,
        'quantity' => $request->quantity,
    ]);

    // 🔥 KURANGI STOK (INI YANG KAMU TANYA)
    $tool->decrement('stock', $request->quantity);

    return redirect()->route('tools.index')
        ->with('success', 'Peminjaman berhasil, stok berkurang');
}



public function index()
{
    $loans = Loan::with(['details.tool'])->get();

    return view('loans.index', compact('loans'));
}


}
