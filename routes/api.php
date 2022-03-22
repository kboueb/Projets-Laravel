<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::ApiResource('/students', 'StudentController');
Route::ApiResource('/etudiants', 'EtudiantController');

//Authentication with Json Web Token
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('logout', 'AuthController@logout');
});
