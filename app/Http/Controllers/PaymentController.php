<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Payment Controller constructor
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::paginate(10);

        return view('payments.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $charges = Charge::all('id', 'name');

        return view('payments.create', ['charges' => $charges]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Payment::create([
            'reference'     => $request->reference,
            'charge_id'     => $request->charge_id,
            'ad_id'         => $request->ad_id,
            'created_by'    => auth()->id()
        ]);

        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payments.show', ['payment' => $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $charges = Charge::all('id', 'name');

        return view('payments.edit', [
            'payment'   => $payment,
            'charges'   => $charges
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update([
            'reference'     => $request->reference,
            'charge_id'     => $request->charge_id,
            'ad_id'         => $request->ad_id,
            'updated_by'    => auth()->id()
        ]);

        return redirect()->route('show-payment', $payment); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back();
    }
}
