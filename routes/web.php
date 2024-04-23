<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Actions\Fortify\CreateNewUser;

use App\Http\Controllers\RegisterStepTwoController;
use App\Http\Controllers\RegisterStepOneController;


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

Route::get('/blog/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');;

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::post('/blog/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');;


//Route::post('/registerUser', [RegisterStepOneController::class, 'toResponse']); 
//Route::get('/registerUser', [RegisterStepOneController::class, 'toResponse']); 

// Route::post('/register', [RegisterStepOneController::class, 'toResponse'])->name('register');

Route::post('/register2', [RegisterStepTwoController::class, 'store'])->name('register2.post');
Route::get('/register2', [RegisterStepTwoController::class, 'create'])->name('register2.create');

//Route::group(['middleware'=> [
//    'auth',
//    'verified',
//  ]], function () {
//  
//    Route::group(['middleware'=>['registration_completed']], function() {
//      
//      
//    });
//  
//    // Adding route to second layer of registration
//    //Route::get('/register2', [RegisterStepTwoController::class, 'create'])->name('register2.create');
//    //Route::post('/register2', [RegisterStepTwoController::class, 'store'])->name('register2.post');
//  });
//  


