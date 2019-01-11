<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Platform Controller constructor.
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
        $platforms = Platform::paginate(10);

        return view('platforms.index', ['platforms' => $platforms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('platforms.create');
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
        Platform::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'driver_class'  => $request->driver_class,
            'created_by'    => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Platform  $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Platform $platform)
    {
        return view('platforms.show', ['platform' => $platform]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Platform  $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Platform $platform)
    {
        return view('platforms.edit', ['platform' => $platform]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Platform  $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform)
    {
        $platform->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'driver_class'  => $request->driver_class,
            'updated_by'    => auth()->id()
        ]);

        return redirect()->route('show-platform', $platform);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Platform  $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Platform $platform)
    {
        $platform->delete();

        return back();
    }
}
