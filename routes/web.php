<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;

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

Route::put('admin/plans/{id}', 'PlanController@update')->name('plans.update');
Route::get('admin/plans/{id}/edit', 'PlanController@edit')->name('plans.edit');
Route::any('admin/plans/search', 'PlanController@search')->name('plans.search');
Route::delete('admin/plans/{id}', 'PlanController@destroy')->name('plans.destroy');
Route::post('admin/plans', 'PlanController@store')->name('plans.store');
Route::get('admin/plans/create', 'PlanController@create')->name('plans.create');
Route::get('admin/plans','PlanController@index')->name('plans.index');
Route::get('admin/plans/{id}', 'PlanController@show')->name('plans.show');
Route::get('admin', 'PlanController@index')->name('admin.index');

Route::get('/', function () {
    return view('welcome');
});
