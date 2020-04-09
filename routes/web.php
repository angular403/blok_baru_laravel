<?php

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

Route::get('/', 'BlogController@index');



Route::match(['get', 'post'], '/register', function () {
    return redirect('login');
})->name('register');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', function () {
        return view('dashboard');
    });

Route::resource('category', 'CategoryController');
Route::get('/category/{id}/delete','CategoryController@destroy');

Route::resource('tag', 'TagController');
Route::get('/tag/{id}/delete','TagController@destroy');

Route::delete('/post/kill/{id}', 'PostController@kill')->name('post.kill');
Route::get('/post/hapus', 'PostController@tampil_hapus')->name('post.tampil_hapus');
Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
Route::resource('post', 'PostController');
Route::get('/post/{id}/delete','PostController@destroy');


Route::resource('user', 'UserController');
Route::get('/user/{id}/delete','UserController@destroy');
});

Auth::routes();


