<?php

namespace App\Http\Controllers\Api;

use App\QuestionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionCategory::get();
    }
}