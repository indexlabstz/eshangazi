<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'ItemCategoryController@test');
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedback', 'FeedbackController@index')->name('index-feedback');

Route::get('/conversations', 'ConversationController@index')->name('index-conversation');
Route::get('/conversations/statistics', 'ConversationController@convStatistics')->name('conv-statistics');

Route::get('/item-categories', 'ItemCategoryController@index')->name('index-item-category');
Route::get('/item-categories/deleted', 'ItemCategoryController@indexDeleted')->name('deleted-item-category');
Route::get('/item-categories/create', 'ItemCategoryController@create')->name('create-item-category');
Route::post('/item-categories/store', 'ItemCategoryController@store')->name('store-item-category');
Route::get('/item-categories/{item_category}/edit', 'ItemCategoryController@edit')->name('edit-item-category');
Route::get('/item-categories/{item_category}', 'ItemCategoryController@show')->name('show-item-category');
Route::patch('/item-categories/update/{item_category}', 'ItemCategoryController@update')->name('update-item-category');
Route::delete('/item-categories/destroy/{item_category}', 'ItemCategoryController@destroy')->name('delete-item-category');
Route::patch('/item-categories/restore/{item_category}', 'ItemController@restoreTrashed')->name('restore-item-category');
Route::delete('/item-categories/destroy/trash/{item_category}', 'ItemController@destroyTrashed')->name('destroy-trash-item-category');

Route::get('/items', 'ItemController@index')->name('index-item');
Route::get('/items/deleted', 'ItemController@indexDeleted')->name('deleted-item');
Route::get('/items/restore/{item}', 'ItemController@restoreTrashed')->name('restore-item');
Route::get('/items/create', 'ItemController@create')->name('create-item');
Route::post('/items/store', 'ItemController@store')->name('store-item');
Route::get('/items/{item}', 'ItemController@show')->name('show-item');
Route::get('/items/{item}/edit', 'ItemController@edit')->name('edit-item');
Route::patch('/items/update/{item}', 'ItemController@update')->name('update-item');
Route::patch('/items/upload/{item}', 'ItemController@upload')->name('upload-item');
Route::delete('/items/destroy/{item}', 'ItemController@destroy')->name('delete-item');
Route::delete('/items/destroy/trash/{item}', 'ItemController@destroyTrashed')->name('destroy-trash-item');

Route::get('/ads/index', 'AdController@index')->name('index-ad');
Route::get('/ads/create', 'AdController@create')->name('create-ad');
Route::post('/ads/store', 'AdController@store')->name('store-ad');
Route::get('/ads/{ad}', 'AdController@show')->name('show-ad');
Route::get('/ads/{ad}/edit', 'AdController@edit')->name('edit-ad');
Route::patch('/ads/{ad}/update', 'AdController@update')->name('update-ad');
Route::patch('/ads/{ad}/upload', 'AdController@upload')->name('upload-ad');
Route::delete('/ads/{ad}/destroy', 'AdController@destroy')->name('destroy-ad');

Route::get('/partners', 'PartnerController@index')->name('index-partner');
Route::get('/partners/create', 'PartnerController@create')->name('create-partner');
Route::post('/partners/store', 'PartnerController@store')->name('store-partner');
Route::get('partner/{partner}', 'PartnerController@show')->name('show-partner');
Route::get('/partners/{partner}/edit', 'PartnerController@edit')->name('edit-partner');
Route::patch('/partner/{partner}', 'PartnerController@update')->name('update-partner');
Route::delete('/partner/{partner}', 'PartnerController@destroy')->name('delete-partner');

Route::get('/partner-categories', 'PartnerCategoryController@index')->name('index-partner-category');
Route::get('/partner-categories/create', 'PartnerCategoryController@create')->name('create-partner-category');
Route::post('/partner-categories/store', 'PartnerCategoryController@store')->name('store-partner-category');
Route::get('/partner-categories/{partner_category}', 'PartnerCategoryController@show')->name('show-partner-category');
Route::get('/partner-categories/{partner_category}/edit', 'PartnerCategoryController@edit')->name('edit-partner-category');
Route::patch('/partner-categories/{partner_category}', 'PartnerCategoryController@update')->name('update-partner-category');
Route::delete('/partner-categories/{partner_category}', 'PartnerCategoryController@destroy')->name('delete-partner-category');

Route::get('/messages/details', 'MessageDetailController@index')->name('index-message-detail');
Route::get('/messages/details/create', 'MessageDetailController@create')->name('create-message-detail');
Route::get('/messages/details/{message_detail}', 'MessageDetailController@show')->name('show-message-detail');
Route::post('/messages/details', 'MessageDetailController@store')->name('store-message-detail');
Route::get('/messages/details/{message_detail}/edit', 'MessageDetailController@edit')->name('edit-message-detail');
Route::patch('/messages/details/{message_detail}', 'MessageDetailController@update')->name('update-message-detail');
Route::delete('/messages/details/{message_detail}', 'MessageDetailController@destroy')->name('delete-message-detail');

Route::get('/messages', 'MessageController@index')->name('index-message');
Route::get('/messages/create', 'MessageController@create')->name('create-message');
Route::get('/messages/{message}', 'MessageController@show')->name('show-message');
Route::post('/messages', 'MessageController@store')->name('store-message');
Route::get('/messages/{message}/edit', 'MessageController@edit')->name('edit-message');
Route::patch('/messages/{message}', 'MessageController@update')->name('update-message');
Route::put('/messages/{message}', 'MessageController@publish')->name('publish-message');
Route::delete('/messages/{message}', 'MessageController@destroy')->name('delete-message');

Route::get('/countries', 'CountryController@index')->name('index-country');
Route::get('/countries/create', 'CountryController@create')->name('create-country');
Route::get('/countries/{country}', 'CountryController@show')->name('show-country');
Route::get('/countries/{country}/edit', 'CountryController@edit')->name('edit-country');
Route::patch('/countries/{country}', 'CountryController@update')->name('update-country');
Route::post('/countries', 'CountryController@store')->name('store-country');
Route::delete('/countries/{country}', 'CountryController@destroy')->name('delete-country');

Route::get('/regions', 'RegionController@index')->name('index-region');
Route::get('/regions/create', 'RegionController@create')->name('create-region');
Route::get('/regions/{region}', 'RegionController@show')->name('show-region');
Route::get('/regions/{region}/edit', 'RegionController@edit')->name('edit-region');
Route::patch('/regions/{region}', 'RegionController@update')->name('update-region');
Route::post('/regions', 'RegionController@store')->name('store-region');
Route::delete('/regions/{region}', 'RegionController@destroy')->name('delete-region');

Route::get('/districts', 'DistrictController@index')->name('index-district');
Route::get('/districts/create', 'DistrictController@create')->name('create-district');
Route::get('/districts/{district}', 'DistrictController@show')->name('show-district');
Route::get('/districts/{district}/edit', 'DistrictController@edit')->name('edit-district');
Route::patch('/districts/{district}', 'DistrictController@update')->name('update-district');
Route::post('/districts', 'DistrictController@store')->name('store-district');
Route::delete('/districts/{district}', 'DistrictController@destroy')->name('delete-district');

Route::get('/wards', 'WardController@index')->name('index-ward');
Route::get('/wards/create', 'WardController@create')->name('create-ward');
Route::get('/wards/{ward}', 'WardController@show')->name('show-ward');
Route::get('/wards/{ward}/edit', 'WardController@edit')->name('edit-ward');
Route::patch('/wards/{ward}', 'WardController@update')->name('update-ward');
Route::post('/wards', 'WardController@store')->name('store-ward');
Route::delete('/wards/{ward}', 'WardController@destroy')->name('delete-ward');

Route::get('/questions/categories', 'QuestionCategoryController@index')->name('index-question-category');
Route::get('/questions/categories/create', 'QuestionCategoryController@create')->name('create-question-category');
Route::get('/questions/categories/{question_category}', 'QuestionCategoryController@show')->name('show-question-category');
Route::get('/questions/categories/{question_category}/edit', 'QuestionCategoryController@edit')->name('edit-question-category');
Route::patch('/questions/categories/{question_category}', 'QuestionCategoryController@update')->name('update-question-category');
Route::post('/questions/categories', 'QuestionCategoryController@store')->name('store-question-category');
Route::delete('/questions/categories/{question_category}', 'QuestionCategoryController@destroy')->name('delete-question-category');

Route::get('/questions', 'QuestionController@index')->name('index-question');
Route::get('/questions/faqs', 'QuestionController@faqs')->name('faqs-question');
Route::get('/questions/create', 'QuestionController@create')->name('create-question');
Route::get('/questions/{question}', 'QuestionController@show')->name('show-question');
Route::get('/questions/{question}/edit', 'QuestionController@edit')->name('edit-question');
Route::patch('/questions/{question}', 'QuestionController@update')->name('update-question');
Route::post('/questions', 'QuestionController@store')->name('store-question');
Route::delete('/questions/{question}', 'QuestionController@destroy')->name('delete-question');

Route::get('/answers', 'AnswerController@index')->name('index-answer');
Route::get('/answers/create', 'AnswerController@create')->name('create-answer');
Route::get('/answers/{answer}', 'AnswerController@show')->name('show-answer');
Route::get('/answers/{answer}/edit', 'AnswerController@edit')->name('edit-answer');
Route::patch('/answers/{answer}', 'AnswerController@update')->name('update-answer');
Route::post('/answers', 'AnswerController@store')->name('store-answer');
Route::delete('/answers/{answer}', 'AnswerController@destroy')->name('delete-answer');

Route::get('/members', 'MemberController@index')->name('index-member')->middleware('auth');
Route::get('/members/{member}/create-message', 'MemberController@createMessage')->name('createmessage-member')->middleware('auth');
Route::post('/members/{member}/send', 'MemberController@sendMessage')->name('sendmessage-member')->middleware('auth');

Route::get('/integrations', 'HomeController@integrations')->name('integration');

Route::get('/centers/services', 'ServiceController@index')->name('index-service');
Route::get('/centers/services/create', 'ServiceController@create')->name('create-service');
Route::get('/centers/services/{service}', 'ServiceController@show')->name('show-service');
Route::get('/centers/services/{service}/edit', 'ServiceController@edit')->name('edit-service');
Route::patch('/centers/services/{service}', 'ServiceController@update')->name('update-service');
Route::post('/centers/services', 'ServiceController@store')->name('store-service');
Route::delete('/centers/services/{service}', 'ServiceController@destroy')->name('delete-service');

Route::get('/centers', 'CenterController@index')->name('index-center');
Route::get('/centers/create', 'CenterController@create')->name('create-center');
Route::get('/centers/{center}', 'CenterController@show')->name('show-center');
Route::get('/centers/{center}/edit', 'CenterController@edit')->name('edit-center');
Route::patch('/centers/{center}', 'CenterController@update')->name('update-center');
Route::post('/centers', 'CenterController@store')->name('store-center');
Route::delete('/centers/{center}', 'CenterController@destroy')->name('delete-center');

Route::get('/users', 'UserController@index')->name('index-user');
Route::get('/users/create', 'UserController@create')->name('create-user');
Route::get('/users/{user}', 'UserController@show')->name('show-user');
Route::get('/users/{user}/edit', 'UserController@edit')->name('edit-user');
Route::patch('/users/{user}', 'UserController@update')->name('update-user');
Route::post('/users', 'UserController@store')->name('store-user');
Route::delete('/users/{user}', 'UserController@destroy')->name('delete-user');

Route::get('/roles', 'RoleController@index')->name('index-role');
Route::get('/roles/create', 'RoleController@create')->name('create-role');
Route::get('/roles/{role}', 'RoleController@show')->name('show-role');
Route::get('/roles/{role}/edit', 'RoleController@edit')->name('edit-role');
Route::patch('/roles/{role}', 'RoleController@update')->name('update-role');
Route::post('/roles', 'RoleController@store')->name('store-role');
Route::delete('/roles/{role}', 'RoleController@destroy')->name('delete-role');

Route::get('/platforms', 'PlatformController@index')->name('index-platform');
Route::get('/platforms/create', 'PlatformController@create')->name('create-platform');
Route::get('/platforms/{platform}', 'PlatformController@show')->name('show-platform');
Route::get('/platforms/{platform}/edit', 'PlatformController@edit')->name('edit-platform');
Route::patch('/platforms/{platform}', 'PlatformController@update')->name('update-platform');
Route::post('/platforms', 'PlatformController@store')->name('store-platform');
Route::delete('/platforms/{platform}', 'PlatformController@destroy')->name('delete-platform');

Route::get('/privacy-policy', function () {
    return view('privacy');
});