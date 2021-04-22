<?php

namespace Tests\Unit;

use App\Jobs\FlushCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CacheTest extends TestCase
{
    /** @test */
    public function it_clears_the_cache(): void
    {
        Queue::fake();

        Cache::rememberForever('testing', fn() => true);

        $this->assertTrue(Cache::get('testing'));

        FlushCache::dispatch();

        Queue::assertPushed(FlushCache::class);

        (new FlushCache)->handle();

        $this->assertNull(Cache::get('testing'));
    }

}
