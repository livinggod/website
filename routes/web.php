<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/storage/resizes/{size}/{file}', ImageController::class)->where('file', '.*');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::get('/{slug?}', RedirectController::class)
    ->where('slug', '^(?!nova).*$')
    ->name('page');
