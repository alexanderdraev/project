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
    return view('about');
});

Route::get('/about', function() {
    return view('about');
})->name('about');


// Contact
Route::get('/contact', 'ContactController@showForm')->name('contact');
Route::post('/contact', 'ContactController@sendForm')->name('contact');


Route::group(['middleware'=>'auth'], function() {

    Route::prefix('users')->namespace('Auth')->group(function (){
        Route::get('/logout','LoginController@Logout')->name('logout');
        Route::get('/{id}/edit','UserController@Edit')->name('users.edit');
        Route::put('/{id}/edit','UserController@Update')->name('users.update');
        });

        Route::prefix('posts/{id}/comments')->group(function (){
            Route::post('/create', 'CommentController@Store')->name('comments.store');
            Route::put('/{c_id}/edit','CommentController@Update')->name('comments.update');
            Route::delete('/{c_id}/delete','CommentController@Destroy')->name('comments.destroy');
        });

        Route::prefix('posts')->group(function (){
            Route::get('/create', 'PostController@Create')->name('posts.create');
            Route::post('/create', 'PostController@Store')->name('posts.store');
            Route::get('/{id}/edit','PostController@Edit')->name('posts.edit');
            Route::put('/{id}/edit','PostController@Update')->name('posts.update');
            Route::delete('/{id}/delete','PostController@Destroy')->name('posts.destroy');
    });

        Route::group(['middleware' => 'admin'], function(){

            Route::prefix('users')->namespace('Auth')->group(function (){
                Route::delete('/{id}/delete','UserController@Destroy')->name('users.destroy');
            });
            Route::prefix('categories')->group(function () {
                Route::get('/', 'CategoryController@Index')->name('categories.index');
                Route::get('/create', 'CategoryController@Create')->name('categories.create');
                Route::post('/create', 'CategoryController@Store')->name('categories.store');
                Route::get('/{id}/edit', 'CategoryController@Edit')->name('categories.edit');
                Route::put('/{id}/edit', 'CategoryController@Update')->name('categories.update');
                Route::delete('/{id}/delete', 'CategoryController@Destroy')->name('categories.destroy');
            });
        });
});

Route::prefix('users')->namespace('Auth')->group(function (){
    Route::view('/login', 'users\login')->name('users.login');
    Route::post('/login','LoginController@Login')->name('login');
    Route::view('/create', 'users\register')->name('users.create');
    Route::post('/create', 'RegisterController@Register')->name('users.store');
    Route::get('/{id?}','UserController@Index')->name('users.index');
});
Route::get('posts/{id?}','PostController@Index')->name('posts.index');

