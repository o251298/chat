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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'prefix' => 'lessons'
], function (){
    Route::get('ajax', [\App\Http\Controllers\LessonController::class, 'ajax']);
    Route::get('line-chart', [\App\Http\Controllers\LessonController::class, 'lineChart']);
    Route::get('socket-chart', [\App\Http\Controllers\LessonController::class, 'newEvent']);
    Route::get('socket-chat', [\App\Http\Controllers\LessonController::class, 'socketChat']);
    Route::get('private-chat', [\App\Http\Controllers\LessonController::class, 'privateChat']);
});
