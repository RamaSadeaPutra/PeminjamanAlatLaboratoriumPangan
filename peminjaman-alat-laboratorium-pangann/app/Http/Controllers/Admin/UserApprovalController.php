<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
                     ->where('status', 'pending')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('admin.users.pending', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'active']);

        return back()->with('success', 'Akun berhasil disetujui.');
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);

        return back()->with('success', 'Akun berhasil ditolak.');
    }
}
