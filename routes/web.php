<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function() {
    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::delete('photos/destroy/{productPhoto}', 'ProductPhotoController@destroy')
            ->name('photo.remove');
    });
});

Auth::routes();

