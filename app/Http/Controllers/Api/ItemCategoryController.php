<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Item;
use App\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemCategoryController extends Controller
{
    /**
     * Return list of categories
     *
     * @return mixed
     */
    public function index()
    {
        return ItemCategory::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $category = ItemCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'display_title' => $request->display_title,
            'created_by' => $request->created_by
        ]);

        return response()->json([
            'category' => $category
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param ItemCategory $category
     *
     * @return Response
     */
    public function show(ItemCategory $category)
    {
        $items = Item::whereItemCategoryId($category->id)->get();

        return response()->json([
            'items' => $items
        ], Response::HTTP_CREATED);
    }
}
