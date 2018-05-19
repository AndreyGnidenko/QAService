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

/*
Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) 
{
   echo $query->sql.'<br/>'; 
});*/

Route::get('/', 'GuestController@index')->name('guest');

Route::get('/login_admin', 'AdminAuthController@displayLoginPage')->name('login');

Route::post('/enter_admin', 'AdminAuthController@login')->name('enter_admin');
Route::post('/logout_admin', 'AdminAuthController@logout')->name('logout_admin');

Route::get('questions/faq', 'QuestionController@indexFaq')->name('questions.faq');
Route::get('questions/faq/create', 'QuestionController@createFaq')->name('questions.faqCreate');
Route::post('questions/faq', 'QuestionController@storeFaq')->name('questions.faqStore');

Route::get('{topicId}/questions', 'QuestionController@indexByTopic')->name('topicquestions.index');
Route::post('{topicId}/questions', 'QuestionController@store')->name('topicquestions.store');
Route::put('{topicId}/questions', 'QuestionController@update')->name('topicquestions.update');
Route::put('{topicId}/questions/answer', 'QuestionController@answer')->name('topicquestions.answer');
Route::delete('{topicId}/questions', 'QuestionController@destroy')->name('topicquestions.destroy');

Route::get('questions/unanswered', 'QuestionController@indexUnanswered')->name('questions.unanswered');
Route::put('questions/unanswered', 'QuestionController@update')->name('questions.update');
Route::put('questions/unanswered/answer', 'QuestionController@answer')->name('questions.answer');
Route::delete('questions/unanswered', 'QuestionController@destroy')->name('questions.destroy');

//Route::post('questions', 'QuestionController@store')->name('questions.store');
//Route::put('questions', 'QuestionController@indexByTopic')->name('topicquestions.index');

Route::resource('topics', 'TopicsController', ['except' => ['create', 'show']]);
Route::resource('admins', 'AdminsController', ['except' => ['create', 'show']]);

