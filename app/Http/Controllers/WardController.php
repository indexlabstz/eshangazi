<?php

namespace App\Http\Controllers;

use App\Ward;
use App\District;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Ward Controller constructor.
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
        $wards = Ward::paginate(10);

        return view('wards.index', ['wards' => $wards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $districts = District::all();

        return view('wards.create', ['districts' => $districts]);
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
        Ward::create([
            'name'          =>  $request->name,
            'district_id'   =>  $request->district_id,
            'created_by'    =>  auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ward  $ward
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        return view('wards.show', ['ward' => $ward]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ward  $ward
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Ward $ward)
    {
        $districts = District::all();

        return view('wards.edit', [
            'districts' =>  $districts,
            'ward'      =>  $ward
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ward  $ward
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ward $ward)
    {
        $ward->update([
            'name'          =>  $request->name,
            'district_id'   =>  $request->district_id,
            'created_by'    =>  auth()->id()
        ]);

        return redirect()->route('show-ward', ['ward' => $ward]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ward  $ward
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ward $ward)
    {
        $ward->delete();

        return back();
    }
}
