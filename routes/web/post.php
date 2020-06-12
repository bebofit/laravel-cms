<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    
Route::get('/post/{post}', 'PostController@show')->name('post');
Route::get('/posts/create', 'AdminsController@createPost')->name('post.create');
Route::post('/posts', 'AdminsController@storePost')->name('post.store');
Route::get('/posts', 'AdminsController@getPosts')->name('post.index');
Route::delete('/posts/{post}', 'AdminsController@deletePost')->name('post.delete');
Route::patch('/posts/{post}', 'AdminsController@editPost')->name('post.update');
Route::get('/posts/{post}', 'AdminsController@getPost')->name('post.edit')->middleware('can:view,post');

});