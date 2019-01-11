<?php

namespace App\Http\Controllers;

use App\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Charge Controller constructor
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
        $charges = Charge::paginate(10);

        return view('charges.index', ['charges' => $charges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.create');
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
        Charge::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'amount'        => $request->amount,
            'duration'      => $request->duration,
            'starts'        => $request->starts,
            'ends'          => $request->ends,
            'created_by'    => auth()->id()
        ]);

        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Charge  $charge
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Charge $charge)
    {
        return view('charges.show', ['charge' => $charge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Charge  $charge
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Charge $charge)
    {
        return view('ads.edit', ['charge' => $charge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Charge  $charge
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charge $charge)
    {
        $charge->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'amount'        => $request->amount,
            'duration'      => $request->duration,
            'starts'        => $request->starts,
            'ends'          => $request->ends,
            'updated_by'    => auth()->id()
        ]);

        return redirect()->route('show-charge', $charge); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Charge  $charge
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();

        return back();
    }
}
