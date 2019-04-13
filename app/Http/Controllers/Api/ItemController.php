<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $item = Item::create([
            'title' => $request->title,
            'description' => $request->description,
            'display_title' => $request->display_title,
            'item_category_id' => $request->item_category_id,
            'item_id' => $request->item_id,
            'created_by' => $request->created_by
        ]);

        return response()->json([
            'item' => $item
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     *
     * @return Response
     */
    public function show(Item $item)
    {
        $items = Item::whereItemId($item->id)->get();

        return response()->json([
            'items' => $items
        ], Response::HTTP_CREATED);
    }
}