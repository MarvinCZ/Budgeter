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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('group', 'GroupController');

Route::resource('group/{group}/members', 'MemberController', [
    'only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']
]);

Route::resource('group/{group}/transaction', 'TransactionController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::delete('logout', 'Auth\LoginController@logout')->name('logout.post');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.get');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email.get');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email.post');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.get');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.post');
