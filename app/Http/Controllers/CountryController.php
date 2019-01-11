<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /*
     * Country Controller Constructor
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
        $countries = Country::paginate(10);

        return view('countries.index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
        Country::create([
            'name'          => $request->name,
            'code'          => $request->code,
            'iso'           => $request->iso,
            'created_by'    => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.show', ['country' => $country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->update([
            'name'          => $request->name,
            'code'          => $request->code,
            'iso'           => $request->iso,
            'updated_by'    =>  auth()->id()
        ]);

        return redirect()->route('show-country', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return back();
    }
}
