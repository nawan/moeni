<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\Production_tools;
use App\Models\Production_users;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\MultipleColumnsSelectedException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

use function Laravel\Prompts\select;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Production $production)
    {
        if (auth()->user()->is_admin != '4') {
            if ($request->ajax()) {
                $data = Production::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('pre_order', function (Production $production) {
                        return $production->pre_order;
                    })
                    ->editColumn('user_id', function (Production $production) {
                        //$client = User::find($production->user_id);
                        return $production->user->name;
                    })
                    ->editColumn('jenis_box', function (Production $production) {
                        return $production->jenis_box;
                    })
                    ->editColumn('status_proses', function (Production $production) {
                        return $production->status_proses;
                    })
                    ->editColumn('price', function (Production $production) {
                        return number_format($production->total_price, 0, ',', '.');
                    })
                    ->addColumn('action', function (Production $production) {
                        $encryptID = Crypt::encrypt($production->id);
                        $btn = '<form class="d-inline m-1" action=' . route("production.destroy", $production->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Data PO" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href=' . route("production.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'modal'])
                    ->make(true);
            }
            return view('production.index');
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
            $users = User::where('is_admin', '=', '0')
                ->latest()->get();

            return view('production.create', compact('users'));
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
            'user_id' => 'required',
            'pre_order' => 'required',
            'status_proses' => 'required',
            'jenis_box' => 'required',
            'note' => 'required'
        ]);

        $data['total_price'] = 0;

        $id = Production::create($data)->id;
        $encryptID = Crypt::encrypt($id);

        toastr()->success('Data Pre Order Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('production.show', $encryptID);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::findOrFail($decryptID);
        $productionTools = Production_tools::where('production_id', '=', $production->id)
            ->latest()->paginate();
        $productionUsers = Production_users::where('production_id', '=', $production->id)
            ->latest()->paginate();

        //url link to client
        $url_id = base64_encode($decryptID);
        $generate_url = url("/order/{$url_id}");
        //$generate_url = url("/order/{$decryptID}");

        return view('production.show', compact('production', 'productionTools', 'productionUsers', 'generate_url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::find($decryptID);

        return view('production.edit', compact('production'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Production $production)
    {
        $data = $request->validate([
            'pre_order' => 'required',
            'status_proses' => 'required',
            'jenis_box' => 'required',
            'note' => 'required',
            'total_price' => 'required',
        ]);

        $data['total_price'] = Str::replace('.', '', $request->total_price);

        $production->update($data);

        toastr()->success('Data Pre Order Berhasil Diperbarui', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('production.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Production::destroy($id);
        toastr()->error('Data PO Telah Dihapus', 'Delete', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        return redirect()->route('production.index');
    }

    public function productionTool(String $id, Request $request, Tool $bahan)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::find($decryptID);


        if ($request->ajax()) {
            $data = Tool::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (Tool $bahan) {
                    return $bahan->name;
                })
                ->editColumn('foto_bahan', function (Tool $bahan) {
                    return $bahan->foto_bahan;
                })
                ->editColumn('jml_stok', function (Tool $bahan) {
                    return $bahan->jml_stok;
                })
                ->editColumn('price', function (Tool $bahan) {
                    return number_format($bahan->price, 0, ',', '.');
                })
                ->addColumn('action', function (Tool $bahan, Request $request) {
                    $production_id = $request->route('id');
                    $decryptID = Crypt::decrypt($production_id);
                    $production = Production::find($decryptID);

                    if ($bahan->jml_stok != 0) {
                        $btn = '<form class="d-inline m-1" action=' . route("tambah.bahan", ["production_id" => $production_id, "bahan_id" => $bahan->id]) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <div class="v-counter">
                            <input type="number" name="qty" size="20" value="1" class="count" />
                        </div>
                        <input type="hidden" name="status_proses" value=' . $production->status_proses . '>
                        <button class="btn btn-success btn-sm" title="Tambah Bahan" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                        </form>';
                    } else {
                        $btn = '<form class="d-inline m-1" action=' . route("tambah.bahan", ["production_id" => $production_id, "bahan_id" => $bahan->id]) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <div class="v-counter">
                            <input type="number" name="qty" size="20" value="1" class="count" />
                        </div>
                        
                        <button class="btn btn-secondary btn-sm" title="Tambah Bahan" data-toggle="tooltip" data-placement="top" type="submit" disabled><i class="fa fa-plus-square"></i> Tambah</button>
                        </form>';
                    }
                    //route('event.deleteAlat', ['event_id' => $event->id, 'toolEvents_id' => $toolEvent->id]) }}
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $productionBahans = Production_tools::where('production_id', '=', $decryptID)
            ->latest()->paginate(10);

        $total = $productionBahans->sum('price');

        $jumlahBahan = Production_tools::where('production_id', '=', $decryptID)->count();

        return view('production.tools', compact('production', 'productionBahans', 'total', 'jumlahBahan'));
    }

    public function tambahBahan(Request $request, $production_id, $bahan_id)
    {
        $decryptID = Crypt::decrypt($production_id);
        $production = Production::find($decryptID);

        $bahan = Tool::find($bahan_id);
        if ($bahan->jml_stok < $request->qty) {
            toastr()->warning('Jumlah Bahan Yang Diambil Melebihi Jumlah Stok', 'Peringatan', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        } elseif ($bahan->jml_stok == $request->qty) {
            $bahan->jml_stok = '0';
            $bahan->status_bahan = "OUT OF STOCK";
            $bahan->save();

            $price = $bahan->price * $request->qty;
            $production->total_price = $production->total_price + $price;
            $production->save();

            $data['production_id'] = $production->id;
            $data['tool_id'] = $bahan->id;
            $data['tool_name'] = $bahan->name;
            $data['quantity'] = $request->qty;
            $data['price'] = $price;
            $data['status_proses'] = $request->status_proses;

            Production_tools::create($data);

            toastr()->success('Bahan Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        } elseif ($bahan->jml_stok > $request->qty) {
            $bahan->jml_stok = $bahan->jml_stok - $request->qty;
            $bahan->save();

            $price = $bahan->price * $request->qty;
            $production->total_price = $production->total_price + $price;
            $production->save();

            $data['production_id'] = $production->id;
            $data['tool_id'] = $bahan->id;
            $data['tool_name'] = $bahan->name;
            $data['quantity'] = $request->qty;
            $data['price'] = $bahan->price * $request->qty;
            $data['status_proses'] = $request->status_proses;

            Production_tools::create($data);

            toastr()->success('Bahan Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        } else {
            toastr()->error('Stok Bahan Sedang Tidak Tersedia', 'Gagal', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);
        }


        return redirect()->route('production.tool', $production_id);
    }

    public function deleteBahan(String $production_id, String $production_tool_id)
    {
        $bahanProduction = Production_tools::find($production_tool_id);
        $bahan_id = $bahanProduction->tool_id;

        $production = Production::find($production_id);
        $production->total_price = $production->total_price - $bahanProduction->price;
        $production->save();


        $tools = Tool::find($bahan_id);
        if ($tools->jml_stok == '0') {
            $tools->jml_stok = $bahanProduction->quantity;
            $tools->status_bahan = 'READY STOCK';
            $tools->save();

            Production_tools::destroy($production_tool_id);
        } else {
            $tools->jml_stok = $tools->jml_stok + $bahanProduction->quantity;
            $tools->save();

            Production_tools::destroy($production_tool_id);
        }

        $encryptID = Crypt::encrypt($production_id);

        toastr()->error('Data Cart Berhasil Dihapus', 'Hapus', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.tool', $encryptID);
    }

    public function submitBahan(String $production_id, Request $request)
    {
        // $decryptID = Crypt::decrypt($production_id);
        // $production = Production::find($decryptID);
        // if ($request->total_price == 0) {
        //     $production->update([
        //         'total_price' => $request->total_price
        //     ]);
        // } else {
        //     $production->update([
        //         'total_price' => $production->total_price + $request->total_price
        //     ]);
        // }

        toastr()->success('Checkout Data Bahan Berhasil', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.show', $production_id);
    }

    public function productionUser(String $id, Request $request, User $user)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::find($decryptID);


        if ($request->ajax()) {
            $data = User::where('is_admin', '=', '4')
                // ->where('status', '=', $production->status_proses)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (User $tukang) {
                    return $tukang->name;
                })
                ->editColumn('image', function (User $tukang) {
                    return $tukang->image;
                })
                ->editColumn('status', function (User $tukang) {
                    return $tukang->status;
                })
                ->addColumn('action', function (User $tukang, Request $request) {
                    $production_id = $request->route('id');
                    $decryptID = Crypt::decrypt($production_id);
                    $production = Production::find($decryptID);

                    $btn = '<form class="d-inline m-1" action=' . route("tambah.tukang", ["production_id" => $production_id, "tukang_id" => $tukang->id]) . ' method="POST">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-success btn-sm" title="Tambah Tukang" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $users = User::where('is_admin', '=', '4')
            ->latest()->paginate();

        $productionTukangs = Production_users::where('production_id', '=', $decryptID)
            ->latest()->paginate(10);

        $jumlahTukang = Production_users::where('production_id', '=', $decryptID)->count();

        return view('production.users', compact('production', 'users', 'productionTukangs', 'jumlahTukang'));
    }

    public function tambahTukang(String $production_id, String $tukang_id)
    {
        $decryptID = Crypt::decrypt($production_id);
        $production = Production::find($decryptID);

        $tukang = User::find($tukang_id);

        $data['production_id'] = $production->id;
        $data['user_id'] = $tukang->id;
        $data['user_name'] = $tukang->name;
        $data['pekerjaan'] = $tukang->status;

        Production_users::create($data);

        toastr()->success('Bahan Berhasil Ditambahkan', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.user', $production_id);
    }

    public function deleteUser(String $production_id, String $production_user_id)
    {
        Production_users::destroy($production_user_id);

        $encryptID = Crypt::encrypt($production_id);

        toastr()->error('Data Cart Berhasil Dihapus', 'Hapus', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.user', $encryptID);
    }

    public function submitUser(String $production_id,)
    {
        toastr()->success('Checkout Data Tukang Berhasil', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.show', $production_id);
    }

    public function proses(Request $request)
    {
        if ($request->ajax()) {
            $data = Production::where('status_proses', '=', 'DONE')
                ->orWhere('status_proses', '=', 'PAID')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pre_order', function (Production $production) {
                    return $production->pre_order;
                })
                ->editColumn('user_id', function (Production $production) {
                    return $production->user->name;
                })
                ->editColumn('jenis_box', function (Production $production) {
                    return $production->jenis_box;
                })
                ->editColumn('status_proses', function (Production $production) {
                    return $production->status_proses;
                })
                ->editColumn('price', function (Production $production) {
                    return number_format($production->total_price, 0, ',', '.');
                })
                ->addColumn('action', function (Production $production) {
                    $encryptID = Crypt::encrypt($production->id);
                    $btn = '<a href=' . route("production.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat PO" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $prosesDesain = Production::where('status_proses', '=', 'DESIGNING')
            ->latest()->get();
        $prosesMachining = Production::where('status_proses', '=', 'MACHINING')
            ->latest()->get();
        $prosesAssembling = Production::where('status_proses', '=', 'ASSEMBLING')
            ->latest()->get();
        $prosesPainting = Production::where('status_proses', '=', 'PAINTING')
            ->latest()->get();
        $prosesInstalasi = Production::where('status_proses', '=', 'INSTALLATION')
            ->latest()->get();
        $prosesTuning = Production::where('status_proses', '=', 'TUNING')
            ->latest()->get();
        $prosesPacking = Production::where('status_proses', '=', 'PACKING')
            ->latest()->get();
        $prosesDelivery = Production::where('status_proses', '=', 'DELIVERY')
            ->latest()->get();

        return view('production.proses', compact(
            'prosesDesain',
            'prosesMachining',
            'prosesAssembling',
            'prosesPainting',
            'prosesInstalasi',
            'prosesTuning',
            'prosesPacking',
            'prosesDelivery'
        ));
    }

    public function ubahProses(String $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::find($decryptID);

        Production_users::where('production_id', $production->id)
            ->where('pekerjaan', $production->status_proses)
            ->delete();

        $production->status_proses = $request->status_proses;
        $production->save();

        toastr()->success('Status Produksi Berhasil Diubah, silahkan tambahkan bahan dan tukang', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('production.show', $id);
    }

    public function prosesTukang(Request $request)
    {
        if ($request->ajax()) {
            $tukang = Auth::user();

            $data = Production_users::where('user_id', '=', $tukang->id)
                ->where('pekerjaan', '=', $tukang->status)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pre_order', function (Production_users $production_users) {
                    return $production_users->production->pre_order;
                })
                ->editColumn('user_id', function (Production_users $production_users) {
                    return $production_users->production->user->name;
                })
                ->editColumn('jenis_box', function (Production_users $production_users) {
                    return $production_users->production->jenis_box;
                })
                ->editColumn('status_proses', function (Production_users $production_users) {
                    return $production_users->production->status_proses;
                })
                ->editColumn('price', function (Production_users $production_users) {
                    return number_format($production_users->production->total_price, 0, ',', '.');
                })
                ->addColumn('action', function (Production_users $production_users) {

                    $encryptID = Crypt::encrypt($production_users->production_id);
                    if ($production_users->production->status_proses == auth()->user()->status) {
                        $btn = '<form class="d-flex justify-content-between gap-1" action=' . route("production.pindah-proses", $encryptID) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                            <option selected value="">--Silahkan Pilih--</option>
                            <option value="DESIGNING">Designing</option>
                            <option value="MACHINING">Machining</option>
                            <option value="ASSEMBLING">Assembling</option>
                            <option value="PAINTING">Painting</option>
                            <option value="INSTALLATION">Installation</option>
                            <option value="TUNING">Tuning</option>
                            <option value="PACKING">Packing</option>
                            <option value="DELIVERY">Delivery</option>
                            <option value="DELIVERY">Done</option>
                        </select>
                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                    </form>';
                    } else {
                        $btn = '<form class="d-flex justify-content-between gap-1" action=' . route("production.pindah-proses", $encryptID) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <input type="text" class="fw-bold p-2" name="status_proses" value=' . $production_users->production->status_proses . ' disabled>
                        <button class="btn btn-secondary btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit" disabled><i class="fa fa-arrow-right"></i></button>
                    </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('production.tukang-proses');
    }

    public function ubahProsesTukang(String $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $production = Production::find($decryptID);

        if ($request->status_proses == "") {
            toastr()->error('Status Produksi Belum Diganti, Silahkan Pilih Tahapan Proses', 'Error', [
                'positionClass' => 'toast-top-full-width',
                'closeButton' => true
            ]);
        } else {

            Production_users::where('production_id', $production->id)
                ->where('pekerjaan', $production->status_proses)
                ->delete();

            $production->status_proses = $request->status_proses;
            $production->save();

            toastr()->success('Status Produksi Berhasil Diganti', 'Berhasil', [
                'positionClass' => 'toast-top-full-width',
                'closeButton' => true
            ]);
        }

        return redirect()->route('production.prosesTukang');
    }
}
