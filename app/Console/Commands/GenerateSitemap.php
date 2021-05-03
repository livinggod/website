<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generates a sitemap';

    public function handle(): int
    {
        SitemapGenerator::create(config('app.url'))->getSitemap()->writeToDisk('public', 'sitemap.xml');

        return 0;
    }
}
