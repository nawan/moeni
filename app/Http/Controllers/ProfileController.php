<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function change_profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'no_kontak' => 'required',
            'alamat' => 'required'
        ]);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('admin');
        }

        $user->update($data);

        toastr()->success('Data Anda Berhasil Diubah', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('profile');
    }

    public function profile()
    {
        $data = Auth::user();
        return view('profile.index', compact('data'));
    }

    public function password()
    {
        return view('profile.password');
    }

    public function change_password(Request $request, User $user)
    {
        $data = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            $user = User::find(auth()->user()->id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            toastr()->success('Password Anda Berhasil Diubah', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
            return redirect()->route('profile');
        } else {
            toastr()->error('Password Lama Salah', 'Gagal', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
            return redirect()->route('profile');
        }
    }
}
