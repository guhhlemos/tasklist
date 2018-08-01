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
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Tasklist')->group(function () {
    // Controllers Within The "App\Http\Controllers\Financeiro" Namespace

	Route::prefix('tasklist')->group(function () {

		Route::get('/', 'TasklistController@index')->name('tasklist');

		Route::get('cadastrar', 'TasklistController@create')->name('tasklist_create');
		Route::post('cadastrar', 'TasklistController@store');
		Route::get('editar/{id}', 'TasklistController@edit')->name('tasklist_edit');
		Route::post('editar/{id}', 'TasklistController@update');
		Route::post('excluir/{id}', 'TasklistController@destroy')->name('tasklist_destroy');
	});
});
