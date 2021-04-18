<?php

use Illuminate\Support\Facades\Cache;

it('clears the cache', function () {
    \Illuminate\Support\Facades\Queue::fake();

    Cache::rememberForever('testing', fn () => true);
    expect(Cache::get('testing'))->toBeTrue();

    \App\Jobs\FlushCache::dispatch();
    \Illuminate\Support\Facades\Queue::assertPushed(\App\Jobs\FlushCache::class);

    (new \App\Jobs\FlushCache)->handle();
    expect(Cache::get('testing'))->toBeNull();
});
