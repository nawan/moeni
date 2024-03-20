<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Production_tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->is_admin != '4') {
            if ($request->ajax()) {
                $data = Payment::latest()->get();
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
                    ->editColumn('payment_amount', function (Payment $payment) {
                        return number_format($payment->payment_amount, 0, ',', '.');
                    })
                    ->editColumn('status_payment', function (Payment $payment) {
                        return $payment->status_payment;
                    })
                    ->editColumn('payment_proof', function (Payment $payment) {
                        return $payment->payment_proof;
                    })
                    ->addColumn('action', function (Payment $payment) {
                        $encryptID = Crypt::encrypt($payment->id);
                        $btn =  '<a href=' . route("cetak.preview", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Print" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> Print</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('cetak.index');
        } else {
            return redirect()->route('error.404');
        }
    }

    public function preview(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $production_tools = Production_tools::where('production_id', '=', $payment->production_id)
            ->latest()->get();

        return view('cetak.preview', compact('payment', 'production_tools'));
    }

    public function print(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $production_tools = Production_tools::where('production_id', '=', $payment->production_id)
            ->latest()->get();

        return view('cetak.print', compact('payment', 'production_tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
