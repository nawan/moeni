<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            if ($request->ajax()) {
                $data = Tool::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function (Tool $tool) {
                        return $tool->name;
                    })
                    ->editColumn('foto_bahan', function (Tool $tool) {
                        return $tool->foto_bahan;
                    })
                    ->editColumn('price', function (Tool $tool) {
                        return number_format($tool->price, 0, ',', '.');
                    })
                    ->editColumn('status_bahan', function (Tool $tool) {
                        return $tool->status_bahan;
                    })
                    ->editColumn('jml_stok', function (Tool $tool) {
                        return $tool->jml_stok;
                    })
                    ->addColumn('action', function (Tool $tool) {
                        $encryptID = Crypt::encrypt($tool->id);

                        $btn = '<form class="d-inline m-1" action=' . route("bahan.destroy", $tool->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Data Bahan" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href=' . route("bahan.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Data Bahan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . '<a href=' . route("bahan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="View Data Bahan" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'modal'])
                    ->make(true);
            }
            return view('tool.index');
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
            return view('tool.create');
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
            'status_bahan' => 'required',
            'jml_stok' => 'required',
            'price' => 'required',
            'foto_bahan' => 'required|image',
            'note' => 'required',
            'deskripsi' => 'required',
        ]);

        $timestamp = Carbon::now()->timestamp;
        $ref_id = Str::random(5);
        $random_number = Str::random(8);
        $combine = $timestamp . $ref_id . $random_number;
        $unique_code = uniqid($combine);

        // if ($request->status_bahan == 'OUT OF STOCK') {
        //     $data['jml_stok'] = 0;
        // }
        $data['kode_bahan'] = $unique_code;
        $data['price'] = Str::replace('.', '', $request->price);
        if ($request->file('foto_bahan')) {
            $data['foto_bahan'] = $request->file('foto_bahan')->store('bahan');
        }

        Tool::create($data);
        toastr()->success('Data Bahan Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('bahan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $bahan = Tool::find($decryptID);

        return view('tool.show', compact('bahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $bahan = Tool::find($decryptID);

        return view('tool.edit', compact('bahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $bahan)
    {
        $data = $request->validate([
            'name' => 'required',
            'status_bahan' => 'required',
            'jml_stok' => 'required',
            'price' => 'required',
            'note' => 'required',
            'deskripsi' => 'required',
        ]);

        $data['price'] = Str::replace('.', '', $request->price);
        if ($request->file('foto_bahan')) {
            if ($request->oldFoto_bahan) {
                Storage::delete($request->oldFoto_bahan);
            }
            $data['foto_bahan'] = $request->file('foto_bahan')->store('bahan');
        }

        $bahan->update($data);

        toastr()->success('Data Bahan Berhasil Diperbarui', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('bahan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $bahan)
    {
        if ($bahan->foto_bahan) {
            Storage::delete($bahan->foto_bahan);
        }

        Tool::destroy($bahan->id);
        toastr()->error('Data Bahan Telah Dihapus', 'Delete', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('bahan.index');
    }

    public function bahanHabis(Request $request)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            if ($request->ajax()) {
                $data = Tool::where('status_bahan', '=', 'OUT OF STOCK')
                    ->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function (Tool $tool) {
                        return $tool->name;
                    })
                    ->editColumn('foto_bahan', function (Tool $tool) {
                        return $tool->foto_bahan;
                    })
                    ->editColumn('price', function (Tool $tool) {
                        return number_format($tool->price, 0, ',', '.');
                    })
                    ->editColumn('status_bahan', function (Tool $tool) {
                        return $tool->status_bahan;
                    })
                    ->editColumn('jml_stok', function (Tool $tool) {
                        return $tool->jml_stok;
                    })
                    ->addColumn('action', function (Tool $tool) {
                        $encryptID = Crypt::encrypt($tool->id);
                        $btn = '<a href=' . route("bahan.edit", $encryptID) . ' class="edit btn btn-success btn-sm m-1" title="Update Data Bahan" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i> UPDATE BAHAN</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'modal'])
                    ->make(true);
            }

            return view('tool.bahanHabis');
        } else {
            return redirect()->route('error.404');
        }
    }
}
