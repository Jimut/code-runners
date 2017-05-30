<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->route('problem.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/problem', [
    'as' => 'problem.index',
    'uses' => 'ProblemController@index',
]);
Route::get('/problem/create', [
    'as' => 'problem.create',
    'uses' => 'ProblemController@create',
]);
Route::post('/problem', [
    'as' => 'problem.store',
    'uses' => 'ProblemController@store',
]);
Route::get('/problem/{problem}', [
    'as' => 'problem.show',
    'uses' => 'ProblemController@show',
]);
Route::get('/problem/{problem}/solve', [
    'as' => 'problem.solve',
    'uses' => 'ProblemController@solve',
]);

Route::post('/problem/{problem}/test', [
    'as' => 'problem.test',
    'uses' => 'DevEnvController@test',
]);

Route::get('/devenv', 'DevEnvController@show');
Route::post('/compile', 'DevEnvController@compile');
