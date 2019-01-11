<?php

namespace App\Http\Controllers;

use App\PartnerCategory;
use Illuminate\Http\Request;

class PartnerCategoryController extends Controller
{
    /**
     * Partner Category Controller constructor.
     *
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
        $partner_categories = PartnerCategory::paginate(10);

        return view('partner-categories.index', [
            'partner_categories' => $partner_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partner-categories.create');
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
        PartnerCategory::create([
            'name'        => $request->name,
            'description' => $request->description,
            'created_by'  => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param PartnerCategory $partner_category
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function show(PartnerCategory $partner_category)
    {
        return view('partner-categories.show', ['partner_category' => $partner_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PartnerCategory $partner_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnerCategory $partner_category)
    {
        return view('partner-categories.edit', ['partner_category' => $partner_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PartnerCategory $partner_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartnerCategory $partner_category)
    {
        $partner_category->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'updated_by'    => auth()->id()
        ]);

        return redirect()->route('show-partner-category', $partner_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PartnerCategory $partner_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerCategory $partner_category)
    {
        $partner_category->delete();
        
        return back();
    }
}
