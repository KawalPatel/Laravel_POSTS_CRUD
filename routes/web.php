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
// Route::get('/about', ('PagesController@about'));
// Route::get('/services', ('PagesController@services'));
Route::get('/bookappointment', 'PagesController@bookAppointment');

/*show Couintryu Dataa-*/
//Route::get('/registersssssssssss', 'DynamicDependent@index');
/*show Couintryu Dataa-*/


//UserManager
// Route::get('/welcomeUser', 'PagesController@welcomeruser');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::post('/postuser', 'PostsController@store')->name('postuser');
Route::post('/posts/{id}/edit', 'PostsController@alert')->name('alert');
Route::get('/exportAll', 'PostsController@exportCsv')->name('exportAll');
Route::any('/customExport', 'PostsController@exportCsvCustom');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/custom', 'DashboardController@showCustom');
