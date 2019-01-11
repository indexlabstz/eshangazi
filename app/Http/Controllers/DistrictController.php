<?php

namespace App\Http\Controllers;

use App\Region;
use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * District Controller constructor.
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
        $districts  = District::paginate(10);

        return view('districts.index', ['districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();

        return view('districts.create', ['regions' => $regions]);
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
        District::create([
            'name'          => $request->name,
            'region_id'     => $request->region_id,
            'created_by'    => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  District $district
     *
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        return view('districts.show', ['district' => $district]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  District $district
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $regions = Region::all();

        return view('districts.edit', [
            'district'  =>  $district,
            'regions'   =>  $regions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  District $district
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $district->update([
            'name'          =>  $request->name,
            'region_id'     =>  $request->region_id,
            'updated_by'    =>  auth()->id()
        ]);

        return redirect()->route('show-district', $district);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  District $district
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();

        return back();
    }
}
