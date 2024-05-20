<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NotificationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/create', [PostController::class, 'create'])->name('posts.create');

Route::get('/events', [EventsController::class, 'index'])->name('events.index');


Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/events/{events:slug}', [EventsController::class, 'show'])->name('events.show');


//Full page livewire component to create a post 


//make different ones based on the user if 
Route::get('/user-profile/{id}', [UserProfileController::class, 'show'])->name('user.profile');
// routes/web.php


Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');   
});
