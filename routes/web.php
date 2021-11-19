<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NewsletterOptInController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RedirectSubdomainController;
use Illuminate\Support\Facades\Route;

Route::get('/storage/resizes/{size}/{file}', ImageController::class)->where('file', '.*');

Route::domain('{locale}.livinggod.net')->group(function () {
    Route::get('/{url}', RedirectSubdomainController::class)->where(['url' => '.*', 'locale' => '(\b[a-zA-Z]{2}\b)']);
});

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/opt-in/{email}/{language?}', NewsletterOptInController::class)->name('opt-in')->middleware('signed');

Route::get('/{slug?}', RedirectController::class)
    ->where('slug', '^(?!nova).*$')
    ->name('page');
