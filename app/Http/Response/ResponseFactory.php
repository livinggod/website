<?php

namespace App\Http\Response;

use App\Http\Response\Responses\ArticlesResponse;
use App\Http\Response\Responses\AuthorResponse;
use App\Http\Response\Responses\BaseResponse;
use App\Http\Response\Responses\HomeResponse;
use App\Http\Response\Responses\PageResponse;
use App\Http\Response\Responses\PostResponse;
use App\Http\Response\Responses\TopicResponse;

class ResponseFactory
{
    protected static array $responses = [
        HomeResponse::class,
        ArticlesResponse::class,
        PostResponse::class,
        PageResponse::class,
        TopicResponse::class,
        AuthorResponse::class,
    ];

    public static function createFromSlug(string $slug = null): BaseResponse
    {
        $response = collect(static::$responses)
            ->map(fn (string $response) => new $response())
            ->filter(fn (BaseResponse $response) => $response->canHandleSlug($slug))
            ->first();

        abort_if(! $response, 404);

        return $response;
    }
}
