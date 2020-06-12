<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){

Route::get('/user/{user}/profile', 'UserController@show')->name('user.profile.show')->middleware('can:view,user');

Route::put('/user/{user}/update', 'UserController@update')->name('user.profile.update')->middleware('can:update,user');

// Route::get('/users/{user}', 'UserController@getUser')->name('user.edit');
Route::middleware('role:Admin')->group(function(){

Route::get('/users', 'UserController@index')->name('users.index');

Route::delete('/users/{user}', 'UserController@deleteUser')->name('user.delete');

Route::put('/users/{user}/attach', 'UserController@attachRole')->name('user.role.attach');

Route::delete('/users/{user}/detach', 'UserController@detachRole')->name('user.role.detach');

});
});
