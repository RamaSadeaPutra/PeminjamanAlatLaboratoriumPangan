<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Show the password change form.
     */
    public function editPassword()
    {
        return view('profile.edit_password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Password berhasil diubah.');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'], // max 2MB
        ]);

        $user = Auth::user();
        // Delete old photo if exists
        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }
        $path = $request->file('photo')->store('profile_photos', 'public');
        $user->photo_path = $path;
        $user->save();

        return back()->with('status', 'Foto profil berhasil diubah.');
    }
}
