<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
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

Route::prefix('user')->group(function (){

    Route::middleware(['guest' ])->group(function (){
        Route::get('/login', [UserController::class, 'login'])->name('user.login');
        Route::get('/register', [UserController::class, 'register'])->name('user.register');
        Route::post('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/check', [UserController::class, 'check'])->name('user.check');

    });
    Route::middleware(['auth:web' ])->group(function (){
        Route::get('/home', [UserController::class, 'home'])->name('user.home');
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

    });
});


Route::prefix('admin')->group(function (){

    Route::middleware(['guest'])->group(function (){
        Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/check', [AdminController::class, 'check'])->name('admin.check');

    });
    Route::middleware(['auth:admin'])->group(function (){
        Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    });
});

Route::prefix('writer')->group(function (){

    Route::middleware(['guest'])->group(function (){
        Route::get('/login', [WriterController::class, 'login'])->name('writer.login');
        Route::get('/register', [WriterController::class, 'register'])->name('writer.register');
        Route::post('/check', [WriterController::class, 'check'])->name('writer.check');
        Route::post('/create', [WriterController::class, 'create'])->name('writer.create');


    });
    Route::middleware(['auth:writer'])->group(function (){
        Route::get('/home', [WriterController::class, 'home'])->name('writer.home');
        Route::get('/logout', [WriterController::class, 'logout'])->name('writer.logout');

    });
});
Route::get('/homepage', [HomeController::class, 'home'])->name('homepage');

