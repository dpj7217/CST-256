<?php
/*
    Project:
        Socialis: V1.0
    Module:
        Socialis: V1.0
    Author:
        David Pratt Jr.
    Date:
        6/14/2020
    Synopsis:
        Handle Routes



*/


use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return view('welcome');
});

Route::get('/workHistory', function() {
    return view('workHistory');
});

Route::get('/educationHistory', function(){
    return view('educationHistory');
});

Route::get('/groups', 'groupController@index');
Route::get('/group/create', 'groupController@create')->middleware('auth');
Route::post('/group/create', 'groupController@store')->middleware('auth');
Route::get('/group/{group_id}/view', 'groupController@show');
Route::get('/group/{group_id}/edit', 'groupController@edit')->middleware('auth');
Route::patch('/group/{group_id}/edit', 'groupController@change')->middleware('auth');
Route::delete('/group/{group_id}/delete', 'groupController@delete')->middleware('auth');
Route::get('/group/{group_id}/leave', 'groupController@leave')->middleware('auth');
Route::get('/group/{group_id}/join', 'groupController@join')->middleware('auth');

Auth::routes();
Route::get('/logout', 'Auth\loginController@logout');


Route::get('/profile/{userID}/create', 'profileController@create')->middleware('auth');
Route::post('/profile/{userID}/create', 'profileController@store')->middleware('auth');
Route::patch('/profile/{userID}/edit', 'profileController@edit')->middleware('auth');
Route::get('/profile/{userID}/workHistory', 'WorkHistoryController@show')->middleware('auth');
Route::post('/profile/{userID}/workHistory', 'WorkHistoryController@store')->middleware('auth');
Route::patch('/profile/{userID}/workHistory/edit', 'WorkHistoryController@edit')->middleware('auth');
Route::get('/profile/{userID}/educationHistories', 'EducationHistoryController@show')->middleware('auth');
Route::post('/profile/{userID}/educationHistories', 'EducationHistoryController@store')->middleware('auth');
Route::patch('/profile/{userID}/educationHistories/edit', 'EducationHistoryController@edit');
Route::get('/profile/{userID}/view', 'profileController@show')->middleware('auth');

Route::get('/admin/users', 'adminController@showUsers')->middleware('can:access');
Route::patch('/users/suspend', 'adminController@suspendUser')->middleware('can:access');
Route::delete('/users/delete', 'adminController@deleteUser')->middleware('can:access');
Route::post('/users/reactivate', 'adminController@reactivateUser')->middleware('can:access');
Route::patch('/users/admin', 'adminController@toAdmin')->middleware('can:access');
Route::post('/users/admin', 'adminController@fromAdmin')->middleware('can:access');

Route::get('/jobs', 'jobsController@show')->middleware('auth');
Route::get('/admin/jobs/add', 'jobsController@showAdd')->middleware('can:access');
Route::post('/admin/jobs/add', 'jobsController@addJob')->middleware('can:access');
Route::get('/admin/jobs/{jobID}/edit', 'jobsController@showEditJob')->middleware('can:access');
Route::patch('/admin/jobs/{jobID}/edit', 'jobsController@editJob')->middleware('can:access');
Route::get('/jobs/{jobID}/view', 'jobsController@showJob')->middleware('auth');
Route::delete('/jobs/{jobID}/delete', 'jobsController@deleteJob')->middleware('can:access');
Route::post('/jobs/{jobID}/apply', 'jobsController@apply');
Route::get('/jobs/search', 'jobsController@search');
Route::get('/jobs/searchResults', 'jobsController@showSearchResults');

Route::resource('/userAPI', 'userAPI');
Route::resource('/jobAPI', 'jobAPI');

Route::post('/post/create', 'postController@store')->middleware('auth');

Route::post('/comment/{post_id}/create', 'CommentController@create')->middleware('auth');

Route::post('/like/{post_id}/create', 'LikeController@create')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
