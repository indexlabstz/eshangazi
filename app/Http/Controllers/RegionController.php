<?php

namespace App\Http\Controllers;

use App\Region;
use App\Country;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /*
     * Constructor for Region Controller
     */
    public  function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::paginate(10);

        return view('regions.index',['regions' => $regions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();

        return view('regions.create', ['countries' => $countries]);
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
        Region::create([
            'name'          => $request->name,
            'country_id'    => $request->country_id,
            'created_by'    => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Region $region
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('regions.show', ['region' => $region]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Region $region
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $countries = Country::all();

        return view('regions.edit', ['countries' => $countries, 'region' => $region]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Region $region
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->update([
            'name'          =>  $request->name,
            'country_id'    =>  $request->country_id,
            'updated_by'    =>  auth()->id()
        ]);

        return redirect()->route('show-region', ['region' => $region]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Region $region
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( Region $region)
    {
        $region->delete();

        return redirect()->route('index-region');
    }
}
