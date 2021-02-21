<?php

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

//Route::get('/', [PageController::class, 'home'])->name('page.home');
//Route::get('/about', [PageController::class, 'about'])->name('page.about');
//Route::get('/abc', [PageController::class, 'abc'])->name('page.abc');

Route::get('/articles', [PostController::class, 'index'])->name('articles.index');
Route::get('/articles/{post:slug}', [PostController::class, 'show'])->name('articles.show');

//require __DIR__.'/auth.php';

Route::get('/{page?}', PageController::class)->name('pages');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
