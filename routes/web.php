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

Route::get('/', 'LandingController@index')->name('landing');
Route::get('/admin_home', 'AdminHomeController@index')->name('admin_home');

Route::get('/login_admin', 'AdminAuthController@displayLoginPage')->name('login');

Route::post('/enter_admin', 'AdminAuthController@login')->name('enter_admin');
Route::post('/logout_admin', 'AdminAuthController@logout')->name('logout_admin');

Route::get('questions/{topicId}', 'QuestionController@index')->name('questions.index');
Route::put('questions/answer', 'QuestionController@answer')->name('questions.answer');
Route::put('questions', 'QuestionController@update')->name('questions.update');

Route::resource('topics', 'TopicsController', ['except' => ['create', 'show']]);
Route::resource('admins', 'AdminsController', ['except' => ['create', 'show']]);
Route::resource('questions', 'QuestionController', ['except' => ['index', 'create', 'show', 'update']]);
