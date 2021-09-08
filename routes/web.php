<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NewsletterOptInController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/storage/resizes/{size}/{file}', ImageController::class)->where('file', '.*');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/opt-in/{email}/{language?}', NewsletterOptInController::class)->name('opt-in')->middleware('signed');

Route::get('/{lang?}/{slug?}', RedirectController::class)
    ->where('lang', '^(?!nova).*$')
    ->name('page');
