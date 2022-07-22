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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('IsLogin')->group( function () {

    // Books:create
    Route::get('/books/create', 'BookController@create')->name('books.create');
    Route::post('/books/store' , 'BookController@store')->name('books.store');

    // Books:Update
    Route::get('/books/edit/{id}', 'BookController@edit')->name('books.edit');
    Route::post('/books/update/{id} ', 'BookController@update')->name('books.update');

    // Books:Delete
    Route::get('/books/delete/{id} ', 'BookController@delete')->name('books.delete');

    // Category:create
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('/categories/store' , 'CategoryController@store')->name('categories.store');

    // Category:Update
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::post('/categories/update/{id} ', 'CategoryController@update')->name('categories.update');

    // Category:Delete
    Route::get('/categories/delete/{id} ', 'CategoryController@delete')->name('categories.delete');

    // Note:Create
    Route::get('/notes/create', 'NoteController@create')->name('notes.create');
    Route::post('/notes/store', 'NoteController@store')->name('notes.store');

    // Logout
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');

});

Route::middleware('IsGuest')->group( function () {
    //Authentication

    // Register:Create
    Route::get('/register', 'AuthController@register')->name('auth.register');
    Route::post('/handle-register', 'AuthController@handleRegister')->name('auth.handleRegister');


    // Login:Create
    Route::get('/login', 'AuthController@login')->name('auth.login');
    Route::post('/handle-login', 'AuthController@handleLogin')->name('auth.handleLogin');

});


// Books:read
Route::get('/books' ,'BookController@index')->name('books.index');
Route::get('/books/show/{id}' ,'BookController@show')->name('books.show');



// Category:read
Route::get('/categories' ,'CategoryController@index')->name('categories.index');
Route::get('/categories/show/{id}' ,'CategoryController@show')->name('categories.show');


Route::get('login/github', 'AuthController@redirectToProvider')->name('login.github.redirect');
Route::get('login/github/callback', 'AuthController@handleProviderCallback')->name('login.github.callback');
