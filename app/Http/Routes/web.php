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

Route::get('/group/{group_id}/dashboard', 'GroupController@dashboard')->name('dashboard');

Route::get('/group/{group_id}/members', 'GroupController@administrateMembers')->name('members');
Route::post('/group/{group_id}/add-members', 'GroupController@addMembers')->name('addMembers');
Route::post('/group/{group_id}/remove-members', 'GroupController@removeMembers')->name('removeMembers');

Route::get('/group/{group_id}/leave', 'MemberController@leaveGroup')->name('leaveGroup');

Route::post('/group/{group_id}/create-transaction', 'TransactionController@create')->name('createTransaction');

Route::get('/test-exception', function () {
    throw new \Exception("xxx");
});
