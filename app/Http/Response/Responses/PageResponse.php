<?php

namespace App\Http\Response\Responses;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class PageResponse extends BaseResponse
{
    protected ?Page $page;

    public function handle(): View
    {
            $this->page->setMeta();

            return view('page', [
                'page' => $this->page
            ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return ($this->page = Page::query()->where('url', '/'.$slug)->localized()->first()) !== null;
    }
}
