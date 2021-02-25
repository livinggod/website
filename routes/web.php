<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/abc', [PageController::class, 'abc'])->name('pages.abc');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::prefix('/articles')->name('articles.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});

Route::prefix('/topics')->name('topics.')->group(function () {
    Route::get('/{category:slug}', [TopicController::class, 'show'])->name('show');
});

Route::prefix('/authors')->name('authors.')->group(function () {
    Route::get('/{author:slug}', [AuthorController::class, 'show'])->name('show');
});

//require __DIR__.'/auth.php';


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
