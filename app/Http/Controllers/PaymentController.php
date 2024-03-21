<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Production;
use App\Models\Production_tools;
use App\Models\Production_users;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            if ($request->ajax()) {
                $data = Production::where('status_payment', '=', 'PENDING')
                    ->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_id', function (Production $production) {
                        return $production->user->name;
                    })
                    ->editColumn('pre_order', function (Production $production) {
                        return $production->pre_order;
                    })
                    ->editColumn('jenis_box', function (Production $production) {
                        return $production->jenis_box;
                    })
                    ->editColumn('total_price', function (Production $production) {
                        return number_format($production->total_price, 0, ',', '.');
                    })
                    ->addColumn('action', function (Production $production) {
                        $encryptID = Crypt::encrypt($production->id);
                        $btn =  '<a href=' . route("payment.bayar", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Bayar</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('payment.index');
        } else {
            return redirect()->route('error.404');
        }
    }

    public function downPayment(Request $request)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            if ($request->ajax()) {
                $data = Payment::where('status_payment', '=', 'DOWN PAYMENT')
                    ->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_id', function (Payment $payment) {
                        return $payment->user->name;
                    })
                    ->editColumn('pre_order', function (Payment $payment) {
                        return $payment->production->pre_order;
                    })
                    ->editColumn('jenis_box', function (Payment $payment) {
                        return $payment->production->jenis_box;
                    })
                    ->editColumn('total_price', function (Payment $payment) {
                        //return number_format(($payment->total_price) - ($payment->payment_amount), 0, ',', '.');
                        return number_format(($payment->total_price) - ($payment->payment_amount), 0, ',', '.');
                    })
                    ->addColumn('action', function (Payment $payment) {
                        $encryptID = Crypt::encrypt($payment->id);
                        $btn =  '<a href=' . route("payment.pelunasan", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Bayar Lunas" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Bayar Lunas</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('payment.downPayment');
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
            return view('payment.create');
        } else {
            return redirect()->route('error.404');
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
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $production = Production::find($payment->production_id);
        $productionTools = Production_tools::where('production_id', '=', $production->id)
            ->latest()->get();
        $productionUsers = Production_users::where('production_id', '=', $production->id)
            ->latest()->get();

        $received_by = User::find($payment->received_by);

        return view('payment.show', compact(
            'production',
            'productionTools',
            'productionUsers',
            'payment',
            'received_by'
        ));
        // return view('payment.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('payment.edit');
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

    public function bayar(String $id, Production $production)
    {
        $decryptID = Crypt::decrypt($id);

        $production = production::find($decryptID);

        $productionTools = Production_tools::where('production_id', '=', $production->id)
            ->latest()->get();
        $productionUsers = Production_users::where('production_id', '=', $production->id)
            ->latest()->get();


        return view('payment.bayar', compact('production', 'productionTools', 'productionUsers'));
    }

    public function pelunasan(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $production = Production::find($payment->production_id);
        $productionTools = Production_tools::where('production_id', '=', $production->id)
            ->latest()->get();
        $productionUsers = Production_users::where('production_id', '=', $production->id)
            ->latest()->get();
        return view('payment.pelunasan', compact('payment', 'production', 'productionTools', 'productionUsers'));
    }

    public function pelunasanStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'production_id' => 'required',
            'received_by' => 'required',
            'total_price' => 'required',
            'payment_amount' => 'required',
            'payment_method' => 'required',
            'payment_date' => 'required',
            'payment_proof' => 'required|image',
            'payment_code' => 'required',
        ]);

        $data['payment_amount'] = Str::replace('.', '', $request->payment_amount);
        $data['status_payment'] = 'PELUNASAN/PAID';

        if ($request->file('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payments');
        }

        Payment::create($data);

        $payment = Payment::find($request->payment_id);
        $payment->status_payment = 'DOWN PAYMENT/PAID';
        $payment->save();

        $production = Production::find($request->production_id);
        $production->status_payment = 'PAID';
        $production->save();

        toastr()->success('Proses Pembayaran Berhasil', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('payment.history');
    }

    public function bayarStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'production_id' => 'required',
            'received_by' => 'required',
            'total_price' => 'required',
            'status_payment' => 'required',
            'payment_amount' => 'required',
            'payment_method' => 'required',
            'payment_date' => 'required',
            'payment_proof' => 'required|image',
            'payment_code' => 'required',
        ]);

        $data['payment_amount'] = Str::replace('.', '', $request->payment_amount);

        if ($request->file('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payments');
        }

        Payment::create($data);

        $production = Production::find($request->production_id);
        $production->status_payment = $request->status_payment;
        $production->save();

        toastr()->success('Proses Pembayaran Berhasil', 'Sukses', ['positionClass' => 'toast-top-full-width', 'closeButton' => true]);

        return redirect()->route('payment.history');
    }

    public function history(Request $request)
    {
        if (auth()->user()->is_admin == '1' || auth()->user()->is_admin == '2') {
            if ($request->ajax()) {
                $data = Payment::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_id', function (Payment $payment) {
                        return $payment->user->name;
                    })
                    ->editColumn('production_id', function (Payment $payment) {
                        return $payment->production->pre_order;
                    })
                    ->editColumn('jenis_box', function (Payment $payment) {
                        return $payment->production->jenis_box;
                    })
                    ->editColumn('payment_amount', function (Payment $payment) {
                        return number_format($payment->payment_amount, 0, ',', '.');
                    })
                    ->editColumn('status_payment', function (Payment $payment) {
                        return $payment->status_payment;
                    })
                    ->editColumn('payment_date', function (Payment $payment) {
                        return Carbon::parse($payment->payment_date)->isoFormat('D MMMM Y');
                    })
                    ->addColumn('action', function (Payment $payment) {
                        $encryptID = Crypt::encrypt($payment->id);
                        $btn =  '<a href=' . route("payment.show", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Lihat Detail" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('payment.history');
        } else {
            return redirect()->route('error.404');
        }
    }
}
