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

Route::get('/dashboard', 'GroupController@dashboard');

Route::get('/group/{group_id}/members', 'GroupController@administrateMembers');
Route::post('/group/{group_id}/add-members', 'GroupController@addMembers');
Route::post('/group/{group_id}/remove-members', 'GroupController@removeMembers');

Route::get('/group/{group_id}/leave', 'MemberController@leaveGroup');

Route::get('/test-exception', function () {
    throw new \Exception("xxx");
});
