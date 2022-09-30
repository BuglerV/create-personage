<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\WarCraftController::class,'home'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
	Route::prefix('person')
	->controller(\App\Http\Controllers\Person\CreatePersonController::class)
	->name('person.')
	->group(function(){
		Route::post('init','init')->name('init');
		Route::get('create/{person}','create')->name('create');
		Route::get('back/{person}','back')->name('back');
		Route::post('store/{person}','store')->name('store');
	});
	Route::resource('person',\App\Http\Controllers\Person\IndexPersonController::class)
		->only(['index','show','destroy']);


	Route::get('ability',[App\Http\Controllers\AbilityController::class,'list'])->name('ability.list');
	Route::prefix('{group}')->group(function(){
		Route::resourceFull('ability',App\Http\Controllers\AbilityController::class)->except('show');
	});

	Route::resourceFull('race',App\Http\Controllers\RaceController::class)->except('show');
	Route::resourceFull('warclass',App\Http\Controllers\WarClassController::class)->except('show');
	Route::resourceFull('profession',App\Http\Controllers\ProfessionController::class)->except('show');
});
