<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum','verified']) ->get('/subjectlist',[PostController::class,'subjectlist'])->name('subjectlist');
Route::middleware(['auth:sanctum','verified']) ->get('/subjectpost',[PostController::class,'subjectpost'])->name('subjectpost');
Route::middleware(['auth:sanctum','verified']) ->get('/subjectuser',[PostController::class,'subjectuser'])->name('subjectuser');
Route::post('/post/subject',[PostController::class,'PostSubject']);
Route::post('/show/subject',[PostController::class,'ShowSubject']);
Route::post('/update/subject',[PostController::class,'UpdateSubject']);
Route::post('/delete/subject',[PostController::class,'DeleteSubject']);
Route::post('/check/subject/{subject_id}',[PostController::class,'CheckSubject']);
Route::post('/show/user',[PostController::class,'ShowUser']);
