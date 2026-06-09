<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'home'])->name('home')->middleware('auth');

Route::get('/about', [ViewController::class, 'about'])->name('about');

// user -> request -> middleware ->function fire




Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// user  -> profile => user_id

// user -> todos

// mg mg -> first task 
// mg mg -> second task
//user -> comments


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::post('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{todo}',[TodoController::class,'destroy'])->name('todos.destroy');