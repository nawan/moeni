<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
                ->editColumn('payment_amount', function (Payment $payment) {
                    return number_format($payment->payment_amount, 0, ',', '.');
                })
                ->editColumn('payment_proof', function (Payment $payment) {
                    return $payment->payment_proof;
                })
                ->make(true);
        }

        return view('cetak.index');
        // if ($request->ajax()) {
        //     $data = Production::where('status_proses', '=', 'DONE')
        //         ->latest()->get();
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->editColumn('user_id', function (Production $production) {
        //             return $production->user->name;
        //         })
        //         ->editColumn('pre_order', function (Production $production) {
        //             return $production->pre_order;
        //         })
        //         ->editColumn('jenis_box', function (Production $production) {
        //             return $production->jenis_box;
        //         })
        //         ->editColumn('total_price', function (Production $production) {
        //             return number_format($production->total_price, 0, ',', '.');
        //         })
        //         ->addColumn('action', function (Production $production) {
        //             $encryptID = Crypt::encrypt($production->id);
        //             $btn =  '<a href=' . route("payment.bayar", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Bayar</a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
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
