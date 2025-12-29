<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user yang terdaftar
     */
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan detail user (opsional, jika diperlukan nanti)
     */
    public function show(User user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Menghapus user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Akun user berhasil dihapus.');
    }
}
