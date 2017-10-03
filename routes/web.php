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
    return redirect (route('pattern.simple'));
});
Route::get('/pattern/delete/{id}', 'PatternController@delete')->name('pattern.delete');
Route::get('/pattern/simple', 'PatternController@simpleIndex')->name('pattern.simple');
Route::post('pattern/row', 'PatternController@newRow')->name('pattern.row.new');
Route::put('/pattern/undelete/{id}', 'PatternTypeController@undelete')->name('PatternType.undelete');
Route::resource("PatternType", "PatternTypeController");
Route::resource("pattern", "PatternController");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
