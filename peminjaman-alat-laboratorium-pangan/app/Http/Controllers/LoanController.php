<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // =========================
    // USER - DAFTAR PEMINJAMAN
    // =========================
    public function index()
    {
        $loans = Loan::with('tool')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.loans.index', compact('loans'));
    }

    // =========================
    // USER - FORM PINJAM
    // =========================
    public function create(Tool $tool)
    {
        return view('loans.create', compact('tool'));
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
<<<<<<< HEAD
=======

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

    $tool->decrement('stock', $request->quantity);

    return redirect()->route('tools.index')
        ->with('success', 'Peminjaman berhasil, stok berkurang');
}



public function index()
{
    $loans = Loan::with(['details.tool'])->get();

    return view('loans.index', compact('loans'));
}


>>>>>>> 5c04987471bd470b2d420b3339915ec64f8d28f2
}
