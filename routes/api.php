<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PackageController;
/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('packages','PackageController')->except(['create', 'edit', 'show', 'update'])->middleware('handlejson');
Route::get('packages/{id}', ['uses' => 'PackageController@show'])->middleware('handlejson');
Route::put('packages/{id}', 'PackageController@update')->middleware('handlejson');
Route::patch('packages/{id}', 'PackageController@modif')->middleware('handlejson');

