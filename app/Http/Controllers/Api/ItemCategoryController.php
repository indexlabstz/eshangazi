<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemCategory;
use Symfony\Component\HttpFoundation\Response;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = ItemCategory::whereStatus('publish')
            ->inRandomOrder()->take(3)->get();

        return response()->json([
            'categories' => $categories
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param ItemCategory $category
     * @return ItemCategory|Response
     */
    public function show(ItemCategory $category)
    {
        $items = Item::whereItemCategoryId($category->id)
            ->whereItemId(NULL)
            ->inRandomOrder()->take(5)->get();

        return response()->json([
            'category' => $category,
            'items' => $items
        ], Response::HTTP_ACCEPTED);
    }
}
