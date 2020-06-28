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

Route::get('/loginRegister', 'loginRegisterController@show');
Route::post('/login', 'loginRegisterController@login');
Route::post('/register', 'loginRegisterController@register');

Route::get('/profile/{userID}/create', 'profileController@create');
Route::post('/profile/{userID}/create', 'profileController@addDemographics');
Route::get('/profile/{userID}/workHistory', 'profileController@showWorkHistory');
Route::post('/workHistory/{userID}/create', 'profileController@addWorkHistory');
Route::get('/profile/{userID}/educationHistory', 'profileController@showEducationHistory');
Route::post('/profile/{userID}/educationHistory', 'profileController@addEducationHistory');
Route::get('/profile/{userID}/view', 'profileController@show');


Route::get('/admin/users', 'adminController@showUsers');
Route::patch('/users/suspend', 'adminController@suspendUser');
Route::delete('/users/delete', 'adminController@deleteUser');
Route::post('/users/reactivate', 'adminController@reactivateUser');
Route::patch('/users/admin', 'adminController@toAdmin');
Route::post('/users/admin', 'adminController@fromAdmin');

Route::get('/admin/jobs', 'jobsController@show');
Route::get('/admin/jobs/add', 'jobsController@showAdd');
Route::post('/admin/jobs/add', 'jobsController@addJob');
Route::patch('/admin/jobs/{jobID}/edit', 'jobsController@editJob');
Route::get('/jobs/{jobID}/view', 'jobsController@showJob');
Route::delete('/jobs/{jobID}/delete', 'jobsController@deleteJob');