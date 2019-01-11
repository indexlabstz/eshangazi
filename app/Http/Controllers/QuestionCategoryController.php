<?php

namespace App\Http\Controllers;

use App\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Question Category Controller constructor.
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
        $question_categories = QuestionCategory::paginate(10);

        return view('question-categories.index', ['question_categories' => $question_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question-categories.create');
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
        QuestionCategory::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'created_by'    => auth()->id()
        ]);

        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionCategory  $question_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionCategory $question_category)
    {
        return view('question-categories.show', ['question_category' => $question_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionCategory  $question_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionCategory $question_category)
    {
        return view('question-categories.edit', ['question_category' => $question_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionCategory  $question_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionCategory $question_category)
    {
        $question_category->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'updated_by'    => auth()->id()
        ]);

        return redirect()->route('show-question-category', $question_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionCategory  $question_category
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionCategory $question_category)
    {
        $question_category->delete();

        return back();
    }
}
