<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(Question $question, Request $request)
    {
        request()->validate([
            'question_id' => 'required',
            'answer' => 'required',
            'created_by' => 'required'
        ]);

        $answer = Answer::create([
            'answer' => $request->answer,
            'question_id' => $request->question_id,
            'correct' => $request->correct,
            'created_by' => $request->created_by
        ]);

        return response($answer, 201);
    }
}
