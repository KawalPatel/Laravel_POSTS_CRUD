<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/welcome', function () {
    return view('pages.welcome');
});

Route::get('/test', function () {
    return view('posts.countryState');
});

Route::get('/', ('PagesController@index'));
Route::resource('posts', 'PostsController');
Auth::routes();
Route::post('/postuser', 'PostsController@store')->name('postuser');
Route::post('/postuser', 'PostsController@store')->name('getDataFromApi_StoreToDatabase');
Route::post('/posts/{id}/edit', 'PostsController@alert')->name('alert');
Route::get('/exportAll', 'PostsController@exportCsv')->name('exportAll');
Route::any('/customExport', 'PostsController@exportCsvCustom');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/custom', 'DashboardController@showCustom');
