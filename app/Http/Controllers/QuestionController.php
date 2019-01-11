<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionCategory;
use Illuminate\Http\Request; 

class QuestionController extends Controller
{
    /**
     * Question Controller constructor.
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
        $questions = Question::paginate(10);

        return view('questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = QuestionCategory::all('id', 'name');
        
        return view('questions.create', ['categories' => $categories]);
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
        Question::create([
            'question'              => $request->question,
            'type'                  => $request->type,
            'difficulty'            => $request->difficulty,
            'question_category_id'  => $request->question_category_id,
            'created_by'            => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('questions.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = QuestionCategory::all('id', 'name');

        return view('questions.edit', [
            'question'      => $question,
            'categories'    => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update([
            'question'              => $request->question,
            'type'                  => $request->type,
            'difficulty'            => $request->difficulty,
            'question_category_id'  => $request->question_category_id,
            'updated_by'            => auth()->id()
        ]);

        return redirect()->route('show-question', $question);
    }

    /**
     * Display a listing of the FAQs.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqs()
    {
        $questions = Question::with('answers')->has('answers', '=', 1)->paginate(10);

        return view('questions.faqs', ['questions' => $questions]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return back();
    }
}
