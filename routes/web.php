<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\v1\MessageController;
use App\Http\Controllers\v1\ProfileController;
use App\Http\Controllers\v1\PostController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [\App\Http\Controllers\v1\ProfileController::class, 'news'])->name('main')->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/room/{user}', [\App\Http\Controllers\MessageController::class, 'index'])->name('room');
Route::group([
    'middleware' => 'auth'
], function (){
    Route::get('/news/vue/', [\App\Http\Controllers\NewsApiController::class, 'vue']);
    Route::get('/news/user/{id}/', [\App\Http\Controllers\NewsApiController::class, 'userFeed']);
    Route::get('/news/more/', [\App\Http\Controllers\NewsApiController::class, 'more']);
    Route::get('ajax', [LessonController::class, 'ajax']);
    Route::get('line-chart', [LessonController::class, 'lineChart']);
    Route::get('socket-chart', [LessonController::class, 'newEvent']);
    Route::get('socket-chat', [LessonController::class, 'socketChat']);
    Route::get('/private-chat', [LessonController::class, 'privateChat']);
    Route::get('/chat', [MessageController::class, 'index'])->name('chat');
    Route::get('/room/{user}', [MessageController::class, 'room'])->name('chat.room');
    Route::post('/message/read', [MessageController::class, 'read'])->name('chat.read');
    Route::post('/message/count', [MessageController::class, 'countMessage'])->name('chat.countMessage');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/change', [ProfileController::class, 'change'])->name('profile.change');
    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/news', [ProfileController::class, 'news'])->name('news');
    Route::post('/post/create', [PostController::class, 'save'])->name('post.save');
    Route::get('/users', [UserController::class, 'index'])->name('users.list');
    Route::get('/users/subscribe/{id}', [UserController::class, 'subscribe'])->name('users.subscribe');
    Route::get('/users/unsubscribe/{id}', [UserController::class, 'unsubscribe'])->name('users.unsubscribe');
    Route::get('/friends', [UserController::class, 'friend'])->name('users.friends');
    Route::any('/comment/store', [PostController::class, 'comment'])->name('comment');
    Route::any('/post/mark/{id}', [PostController::class, 'mark'])->name('post.like');
    Route::get('/lessons/news', [\App\Http\Controllers\NewsApiController::class, 'index']);
    Route::any('/message/image', [MessageController::class, 'createImage']);
    Route::any('/message/delete', [MessageController::class, 'deleteChat']);
    Route::any('/search/user/{search}', [HomeController::class, 'searchUser']);
    Route::any('/get/friends', [HomeController::class, 'getFriends']);
    //Route::any('/message/delete/{id}', [MessageController::class, 'deleteChat']);
});
