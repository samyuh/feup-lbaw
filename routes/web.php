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
// Home and Static
Route::get('/', 'HomeController@show')->name('home');
Route::get('/about', 'StaticController@showAbout')->name('about');
Route::get('/notfound', 'StaticController@showNotFound')->name('notfound');

// Search Questions
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/api/search', 'SearchController@advancedSearch')->name('api/search');

// Search Tags
Route::get('api/tag/search', 'TagController@search');
Route::get('api/tag/{id}', 'TagController@find');

// Add Question
Route::get('/question/add', 'QuestionController@showQuestionForm');
Route::post('/question/add', 'QuestionController@create')->name('question');

// Show Question
Route::get('/question/{id}', 'QuestionController@show')->name('show-question');

// Vote Question and Answer
Route::post('api/question/{id}/vote', 'QuestionController@voteQuestion')->name('vote-question');
Route::post('api/question/{idQuestion}/answer/{idAnswer}', 'QuestionController@voteAnswer')->name('vote-answer');


// Edit Question
Route::get('/question/{id}/edit', 'QuestionController@showEditQuestionForm');
Route::put('/question/{id}/edit', 'QuestionController@updateQuestion')->name('edit-question');

// Deletes
Route::delete('question/{id}', 'QuestionController@delete')->name('delete-question');
//Route::delete('/question/{id-q}/answer/{id-a}','QuestionController@deleteComment')->name('delete-comment');
//Route::delete('user/{id}/delete', 'UserController@deleteUser')->name('delete-user');

// Module M01: Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Profile: change in A9
Route::get('/user/{id}/profile', "UserController@showProfile");
Route::get('/api/user/{id}/questions', 'UserController@paginateQuestions');
Route::get('/api/user/{id}/answers', 'UserController@paginateAnswers');
Route::get('/user/profile/edit', "StaticController@showEditProfile")->name('edit-profile');

// Management: change in A9 when we implement this user stories
//Route::get('/admin/tag', 'StaticController@showTags')->name('manage-tags');
//Route::get('/admin/course', 'StaticController@showCourses')->name('manage-courses');
Route::get('/admin/categories', 'StaticController@showCategories')->name('manage-categories');
Route::get('/admin/reports', 'StaticController@showReports')->name('manage-reports');
Route::get('/admin/users', 'StaticController@showUsers')->name('manage-users');
