<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
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
            $tampil = [];

            foreach ($dataBahan as $data) {
                $data->foto_bahan = env('APP_URL') . '/' . 'public/storage/' . $data->foto_bahan;
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(
                    ['error' => $validator->errors()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            Tool::create($request->all());
            $response = ['Success' => 'Bahan berhasil terinput'];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dataBahan = Tool::findOrFail($id);
            $tampil = [
                'name' => $dataBahan->name,
                'kode_bahan' => $dataBahan->kode_bahan,
                'status_bahan' => $dataBahan->status_bahan,
                'jml_stok' => $dataBahan->jml_stok,
                'price' => $dataBahan->price,
                'foto_bahan' => env('APP_URL') . '/' . 'public/storage/' . $dataBahan->foto_bahan,
                'note' => $dataBahan->note,
                'deskripsi' => $dataBahan->deskripsi
            ];
            return response()->json($tampil, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hasil Tidak Ditemukan'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dataBahan = Tool::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(
                    ['succeed' => false, 'Message' => $validator->errors()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            $dataBahan->update($request->all());
            $response = [
                'Success' => 'Data Bahan Berhasil Diperbarui'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal Update'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Tool::findOrFail($id)->delete();
            return response()->json(['success' => 'Data Bahan Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal Hapus'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
