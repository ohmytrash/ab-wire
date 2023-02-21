<?php

use Illuminate\Support\Facades\Route;


Route::get('/activities', 'ActivitiesController@index')->name('activities');

Route::get('/edit-profile', 'EditProfileController@index')->name('edit-profile');
Route::put('/edit-profile', 'EditProfileController@updateProfile')->name('edit-profile');
Route::put('/edit-profile/password', 'EditProfileController@updatePassword')->name('edit-profile.password');
Route::post('/edit-profile/avatar', 'EditProfileController@updateAvatar')->name('edit-profile.avatar');
Route::put('/edit-profile/minitutor', 'EditProfileController@updateMinitutor')->name('edit-profile.minitutor');

Route::middleware('minitutor:active')->group(function () {
    Route::resource('lessons', 'LessonsController')->except(['update', 'show']);
});
