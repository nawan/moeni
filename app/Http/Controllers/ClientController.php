<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $clients)
    {
        if (auth()->user()->is_admin != '4') {
            if ($request->ajax()) {
                $data = User::where('is_admin', '=', 0)
                    ->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function (User $client) {
                        return $client->name;
                    })
                    ->editColumn('image', function (User $client) {
                        return $client->image;
                    })
                    ->editColumn('no_kontak', function (User $client) {
                        return $client->no_kontak;
                    })
                    ->editColumn('created_at', function (User $client) {
                        return Carbon::parse($client->created_at)->isoFormat('D MMMM Y');
                    })
                    ->addColumn('action', function (User $client) {
                        $encryptID = Crypt::encrypt($client->id);
                        $btn = '<form class="d-inline m-1" action=' . route("client.destroy", $client->id) . ' method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                            </form>';
                        $btn = $btn . '<a href=' . route("client.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . '<a href=' . route("client.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'modal'])
                    ->make(true);
            }
            return view('client.index', compact('clients'));
        } else {
            return redirect()->route('error.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->is_admin != '4') {
            return view('client.create');
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
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'nik' => 'required|unique:App\Models\User,nik',
            'no_kontak' => 'required',
            'alamat' => 'required',
            'image' => 'required|image'
        ]);

        $data['password'] = Crypt::encrypt(Str::random(8));
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('client');
        }

        User::create($data);
        toastr()->success('Data Client Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $client = User::find($decryptID);

        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $client = User::find($decryptID);

        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $client)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_kontak' => 'required',
        ]);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $client->image = $request->file('image')->store('client');
        }
        $client->update($data);

        toastr()->success('Data Client Berhasil Diperbarui', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client)
    {
        if ($client->image) {
            Storage::delete($client->image);
        }
        User::destroy($client->id);
        toastr()->error('Data Client Telah Dihapus', 'Delete', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('client.index');
    }
}
