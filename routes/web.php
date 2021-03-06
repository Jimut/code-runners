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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/problem', [
    'as' => 'problem.index',
    'uses' => 'ProblemController@index',
]);
Route::get('/problem/{problem}', [
    'as' => 'problem.show',
    'uses' => 'ProblemController@show',
]);
Route::get('/problem/{problem}/solve', [
    'as' => 'problem.solve',
    'uses' => 'ProblemController@solve',
]);

Route::get('/devenv', 'DevEnvController@show');
Route::post('/compile', 'DevEnvController@compile');
