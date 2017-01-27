<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('group', 'GroupController');

Route::resource('group/{group}/member', 'MemberController', [
    'only' => ['store', 'update', 'destroy']
]);

Route::resource('group/{group}/transaction', 'TransactionController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);
