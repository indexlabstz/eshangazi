<?php

namespace App\Http\Controllers\Api;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'question' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'question_category_id' => 'required'
        ]);

        $question = Question::create([
            'question' => request('question'),
            'type' => request('type'),
            'difficulty' => request('difficulty'),
            'question_category_id' => request('question_category_id'),
            'created_by' => request('created_by')
        ]);


        if (request()->wantsJson()) {
            return response($question, 201);
        }

        return redirect($question->path())
            ->with('flash', 'Your question created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $question->answers()->delete();

        $question->delete();

        return response("Question deleted", 201);
    }
}