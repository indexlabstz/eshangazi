<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Response
     */
    public function show(Item $item): Response
    {
        $items = Item::whereItemId($item->id)
            ->inRandomOrder()->take(5)->get();

        return response()->json([
            'item' => $item,
            'items' => $items
        ], Response::HTTP_ACCEPTED);
    }
}
