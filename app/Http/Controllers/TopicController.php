<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Category $category)
    {
        $topic = $category;
        if (is_null($topic->id)) {
            abort(404);
        }

        return view('topics.show', [
            'topic' => $topic,
            'articles' => $topic->articles()->published()->orderBy('publish_at', 'desc')->paginate(8)
        ]);
    }
}
