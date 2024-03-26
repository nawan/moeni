<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $dataBahan = Tool::all();
            // $dataBahan = Tool::select('id', 'name', 'jml_stok', 'foto_bahan')->get('foto_bahan');
            // return $this->sendResponse(
            //     [
            //         'id' => $dataBahan->id,
            //         'name' => $dataBahan->name,
            //         'kode_bahan' => $dataBahan->kode_bahan,
            //         'status_bahan' => $dataBahan->status_bahan,
            //         'jml_stok' => $dataBahan->jml_stok,
            //         'price' => $dataBahan->price,
            //         'foto_bahan' => URL::to('/') . 'bahan/' . $dataBahan->foto_bahan,
            //         'note' => $dataBahan->note,
            //         'deskripsi' => $dataBahan->deskripsi,
            //         'created_at' => $dataBahan->created_at,
            //         'updated_at' => $dataBahan->updated_at,
            //     ],
            //     'Data Bahan Berhasil Ditampilkan'
            // );
            //return response()->json($dataBahan, Response::HTTP_OK);
            $tampil = [];

            foreach ($dataBahan as $data) {
                $data->foto_bahan = env('APP_URL') . '/' . 'storage/' . $data->foto_bahan;
                array_push($tampil, $data);
            }
            return response()->json($tampil);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
