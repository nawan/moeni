<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Production;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->is_admin == '4') {
            return redirect()->route('production.prosesTukang');
        } else if (auth()->user()->is_admin == '3') {
            return redirect()->route('client.index');
        } else {
            //total client
            $jumlahClient = User::where('is_admin', '=', '0')
                ->count();

            //jumlah item bahan tersedia
            $itemBahan = Tool::where('status_bahan', '=', 'READY STOCK')
                ->count();

            //jumlah PO
            $jumlahPO = Production::where('status_proses', '!=', 'DONE')
                ->count();

            //total pendapatan
            $payment = Payment::latest()->get();
            $totalPendapatan = $payment->sum('payment_amount');

            //potensi pendapatan
            $dataPO = Production::latest()->get();
            $dataPayment = Payment::latest()->get();

            $payment = $dataPayment->sum('payment_amount');
            $production = $dataPO->sum('total_price');

            $potensiPendapatan = $production - $payment;



            return view('dashboard.index', compact(
                'payment',
                'production',
                'jumlahClient',
                'itemBahan',
                'jumlahPO',
                'totalPendapatan',
                'potensiPendapatan'
            ));
        }
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
