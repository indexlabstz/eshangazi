<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('messages/details/{message}', 'MessageDetailController@index');
Route::post('messages/details', 'MessageDetailController@store');
Route::put('messages/publish/{message}', 'MessageController@publish');

Route::get('question_categories', 'Api\QuestionCategoryController@index');

Route::get('questions', 'Api\QuestionController@index');
Route::post('questions', 'Api\QuestionController@store')->name('store-question');
Route::post('questions/{question}/answer', 'Api\AnswerController@answer')->name('store-answer');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
