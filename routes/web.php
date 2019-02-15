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

Route::get('/', 'CharactersController@index')->name('home');
Route::any('/home', 'CharactersController@anyData')->name('list_characters');
Route::get('/create-character', 'CharactersController@create')->name('new_character');
Route::post('/store-character', 'CharactersController@store')->name('save_new_character');
Route::get('/edit-character/{id}', 'CharactersController@edit')->name('edit_character');
Route::post('/update-character/{id}', 'CharactersController@update')->name('update_character');
Route::get('/delete-character/{id}', 'CharactersController@destroy')->name('delete_character');
