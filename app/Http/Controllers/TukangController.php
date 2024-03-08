<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TukangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            $search = $request->search;
            $tukangs = User::where('is_admin', '=', 4)
                ->latest()
                ->paginate(10);
            return view('tukang.index', compact('tukangs'));
        } else {
            return redirect()->route('error.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            return view('tukang.create');
        } else {
            return redirect()->route('error.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'is_admin' => 'required',
            'status' => 'required',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'nik' => 'required|unique:App\Models\User,nik',
            'no_kontak' => 'required',
            'alamat' => 'required',
            'image' => 'required|image',
            'password' => 'required',
        ]);
        $data['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('tukang');
        }

        User::create($data);
        toastr()->success('Data Tukang Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('tukang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $tukang = User::find($decryptID);

        return view('tukang.show', compact('tukang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $tukang = User::find($decryptID);

        return view('tukang.edit', compact('tukang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $tukang)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_kontak' => 'required',
            'status' => 'required',
        ]);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $tukang->image = $request->file('image')->store('tukang');
        }
        $tukang->update($data);
        toastr()->success('Data Tukang Berhasil Diperbarui', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('tukang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $tukang)
    {
        if ($tukang->image) {
            Storage::delete($tukang->image);
        }
        User::destroy($tukang->id);
        toastr()->error('Data Tukang Telah Dihapus', 'Delete', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('tukang.index');
    }
}
