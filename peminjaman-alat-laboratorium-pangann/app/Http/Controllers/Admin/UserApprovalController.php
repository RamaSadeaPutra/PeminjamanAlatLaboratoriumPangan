<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function active()
    {
        $users = User::where('role', 'user')
                     ->where('status', 'active')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('admin.users.active', compact('users'));
    }

    /**
     * Show registration history (approved and rejected users)
     */
    public function history()
    {
        $users = User::where('role', 'user')
                     ->whereIn('status', ['active', 'rejected'])
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('admin.users.history', compact('users'));
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

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user->update(['password' => Hash::make($request->input('password'))]);

        return back()->with('success', 'Password pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
