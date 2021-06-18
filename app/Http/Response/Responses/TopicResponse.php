<?php

namespace App\Http\Response\Responses;

use App\Models\Topic;
use Illuminate\Contracts\View\View;

class TopicResponse extends BaseResponse
{
    protected ?Topic $topic;

    public function handle(): View
    {
        $this->topic->setMeta();

        return view('topics.show', [
            'topic'    => $this->topic,
            'articles' => $this->topic->articles()->published()->localized()->orderBy('publish_at', 'desc')->paginate(8),
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return ($this->topic = Topic::where('slug', $slug)->localized()->first()) !== null;
    }
}
