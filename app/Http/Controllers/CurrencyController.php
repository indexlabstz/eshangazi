<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /*
     * Currency Controller Constructor
    */
    public  function  __construct()
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
        $currencies = Currency::paginate(10);

        return view('currencies.index', ['currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currencies.create');
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
        Currency::create([
            'name'          => $request->name,
            'short_name'    => $request->short_name,
            'symbol'        => $request->symbol,
            'created_by'    => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('countries.show', ['currency' => $currency]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('currencies.edit', ['currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $currency->update([
            'name'          => $request->name,
            'short_name'    => $request->short_name,
            'symbol'        => $request->symbol,
            'created_by'    => auth()->id(),
        ]);

        return redirect()->route('show-currency', $currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return back();
    }
}
