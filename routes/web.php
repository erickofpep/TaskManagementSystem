<?php
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', 'RegisterController@register')->name('register');
// Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'RegisterController@user_login')->name('login');

// Route::get('/dashboard', 'pages\PagesController@showdashboard')->name('dashboard')->middleware('auth');

// Route::get('/dashboard', 'RegisterController@user_login')

Route::get('/dashboard', function () { return view('pages.dashboard'); })->name('dashboard')->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/showtaskform', 'pages\PagesController@showtaskform')->name('showtaskform')->middleware('auth');

Route::post('/create_task', 'RegisterController@createtask')->name('taskadd')->middleware('auth');

Route::get('/showCreatedTasks', 'RegisterController@viewTasks')->name('showCreatedTasks')->middleware('auth');

Route::post('/search', 'RegisterController@searchCriteria')->name('search')->middleware('auth');

Route::get('/showSearch', function () { return view('pages.showSearch');
})->name('showSearch')->middleware('auth');

Route::post('/set_priority', 'RegisterController@setPriority')->name('set_priority')->middleware('auth');

Route::post('/set_status', 'RegisterController@setStatus')->name('set_status')->middleware('auth');

Route::get('/show_edit/{id}/', 'RegisterController@showEdit')->name('show_edit')->middleware('auth');

Route::post('/edit_task', 'RegisterController@editTask')->name('edit_task')->middleware('auth');

Route::post('/delete_task', 'RegisterController@deleteTask')->name('delete_task')->middleware('auth');

Route::post('/assign_task', 'RegisterController@assignTask')->name('assign_task')->middleware('auth');

