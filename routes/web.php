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
    Route::post('/create', 'RegisterController@Store')->name('users.store'); //creates user, should redirect to index view
    Route::get('/login','LoginController@Index')->name('users.login'); // show users/login.blade.php
    Route::post('/login', 'LoginController@Check')->name('users.check');//login check
    Route::get('/logout','LoginController@Logout')->name('users.logout'); // users/logout.blade.php
    Route::get('/','UserController@Index')->name('users.index'); //may show all users?
    Route::get('/{id}','UserController@Show')->name('users.show'); //user profile?
    Route::get('/{id}/edit','UserController@Edit')->name('users.edit'); //registration form without password confirmation?
    Route::put('/{id}/edit','UserController@Update')->name('users.update');
    Route::delete('/{id}/delete','UserController@Destroy')->name('users.destroy'); //are you sure message?

});
Route::prefix('posts')->group(function (){
    Route::get('/create', 'PostController@Create')->name('posts.create');
    Route::post('/create', 'PostController@Store')->name('posts.store');
    Route::get('/{id?}','PostController@Index')->name('posts.index');
    Route::get('/{id}/edit','PostController@Edit')->name('posts.edit');
    Route::put('/{id}/edit','PostController@Update')->name('posts.update');
    Route::delete('/{id}/delete','PostController@Destroy')->name('posts.destroy');
});
Route::prefix('comments')->group(function (){
    Route::get('/create', 'CommentController@Create')->name('comments.create'); // show comments/create.blade.php and pass post_id and user_id to controller?
    Route::post('/create', 'CommentController@Store')->name('comments.store'); //should redirect to a different view - parent post??
    Route::get('/{id}/edit','CommentController@Edit')->name('comments.edit'); // also show comments/create.blade.php??
    Route::put('/{id}/edit','CommentController@Update')->name('comments.update');
    Route::delete('/{id}/delete','CommentController@Destroy')->name('comments.destroy'); //are you sure message?
});
Route::prefix('categories')->group(function (){
    Route::get('/','CategoryController@Index')->name('categories.index'); //all categories??
    Route::get('/create', 'CategoryController@Create')->name('categories.create'); // show categories/create.blade.php
    Route::post('/create', 'CategoryController@Store')->name('categories.store'); //should redirect to index view
    Route::get('/{id}/edit','CategoryController@Edit')->name('categories.edit'); // also show categories/create.blade.php??
    Route::put('/{id}/edit','CategoryController@Update')->name('categories.update');
    Route::delete('/{id}/delete','CategoryController@Destroy')->name('categories.destroy'); //are you sure message?
});
