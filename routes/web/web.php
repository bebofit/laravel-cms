<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminsController@index')->name('admin.index')->middleware('auth');

Auth::routes();

