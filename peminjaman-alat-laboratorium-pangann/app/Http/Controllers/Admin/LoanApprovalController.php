<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanApprovalController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function history()
    {
        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['kembali', 'ditolak'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.loans.history', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        if ($loan->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        $tool = $loan->tool;

        if ($tool->stock < $loan->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $tool->decrement('stock', $loan->jumlah);

        $loan->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Pengajuan disetujui');
    }

    public function reject(Loan $loan)
    {
        if ($loan->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        $loan->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pengajuan ditolak');
    }

    public function markAsBorrowed(Loan $loan)
    {
        if ($loan->status !== 'disetujui') {
            return back()->with('error', 'Status peminjaman belum disetujui');
        }

        $loan->update(['status' => 'dipinjam']);

        return back()->with('success', 'Status diubah menjadi Dipinjam');
    }

    public function markAsReturned(Loan $loan)
    {
        if ($loan->status !== 'dipinjam') {
            return back()->with('error', 'Status peminjaman bukan "Dipinjam"');
        }

        // Kembalikan stok
        $loan->tool->increment('stock', $loan->jumlah);

        $loan->update(['status' => 'kembali']);

        return back()->with('success', 'Status diubah menjadi Kembali (Stok dikembalikan)');
    }
}
