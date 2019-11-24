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
Route::get('/', 'Blog@index');
Route::get('/register', 'Blog@register');
Route::post('/register', 'Blog@register_action');
Route::get('/login', 'Blog@login');
Route::post('/login', 'Blog@login_action');
?>