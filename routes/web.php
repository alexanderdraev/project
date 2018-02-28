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

Route::get('/', function () {
    return view('welcome');
});

/////BASIC ROUTES WITHOUT AUTHORISATION AND AUTHENTICATION BEING CONSIDERED

Route::prefix('users')->group(function (){
    Route::get('/create', 'RegisterController@Create')->name('users.create'); //Create method may show users/register.blade.php
    Route::post('/create', 'RegisterController@Store')->name('users.store'); //creates user, should redirects to index view
    Route::view('/login','LoginController@Index')->name('users.login'); // show users/login.blade.php
    Route::post('/login', 'LoginController@Check')->name('users.check');//login check
    Route::view('/logout','LoginController@Logout')->name('users.logout'); // users/logout.blade.php
    Route::view('/','UserController@Index')->name('users.index'); //may show all users?
    Route::view('/{id}','UserController@Show')->name('users.show'); //user profile?
    Route::view('/{id}/edit','UserController@Edit')->name('users.edit'); //registration form without password confirmation?
    Route::put('/{id}','UserController@Update')->name('users.update');
    Route::delete('/{id}','UserController@Destroy')->name('users.destroy'); //are you sure message?

});
Route::prefix('posts')->group(function (){
    Route::view('/','PostController@Index')->name('posts.index'); //random posts??
    Route::get('/create', 'PostController@Create')->name('posts.create'); // show posts/create.blade.php
    Route::post('/create', 'PostController@Store')->name('posts.store'); //should redirect to index view
    Route::view('/{id}','PostController@Show')->name('posts.show'); //post by id
    Route::view('/{id}/edit','PostController@Edit')->name('posts.edit');  // also show posts/create.blade.php?--see controller
    Route::put('/{id}','PostController@Update')->name('posts.update');
    Route::delete('/{id}','PostController@Destroy')->name('posts.destroy'); //are you sure message?
});
Route::prefix('comments')->group(function (){
    Route::get('/create', 'CommentController@Create')->name('comments.create'); // show comments/create.blade.php and pass post_id and user_id to controller?
    Route::post('/create', 'CommentController@Store')->name('comments.store'); //should redirect to a different view - parent post??
    Route::view('/{id}/edit','CommentController@Edit')->name('comments.edit'); // also show comments/create.blade.php??
    Route::put('/{id}','CommentController@Update')->name('comments.update');
    Route::delete('/{id}','CommentController@Destroy')->name('comments.destroy'); //are you sure message?
});
Route::prefix('categories')->group(function (){
    Route::view('/','CategoryController@Index')->name('categories.index'); //all categories??
    Route::get('/create', 'CategoryController@Create')->name('categories.create'); // show categories/create.blade.php
    Route::post('/create', 'CategoryController@Store')->name('categories.store'); //should redirect to index view
    Route::view('/{id}/edit','CategoryController@Edit')->name('categories.edit'); // also show categories/create.blade.php??
    Route::put('/{id}','CategoryController@Update')->name('categories.update');
    Route::delete('/{id}','CategoryController@Destroy')->name('categories.destroy'); //are you sure message?
});
