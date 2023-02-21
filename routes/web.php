<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

// Join minitutor
Route::get('/join-minitutor', 'JoinMinitutorController@index')->name('join-minitutor');
Route::post('/join-minitutor', 'JoinMinitutorController@store')->name('join-minitutor');
Route::put('/join-minitutor', 'JoinMinitutorController@update')->name('join-minitutor');

// dashboard
Route::redirect('/dashboard', '/dashboard/activities')->name('dashboard');
Route::middleware(['auth', 'verified'])->prefix('/dashboard')->as('dashboard.')->namespace('Dashboard')->group(function(){
    include __DIR__ . '/dashboard.php';
});

// auth
Route::namespace('Auth')->group(function(){
    include __DIR__ . '/auth.php';
});