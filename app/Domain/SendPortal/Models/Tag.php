<?php

namespace App\Domain\SendPortal\Models;

use App\Domain\SendPortal\Facades\SendPortal;
use Based\Fluent\Fluent;

class Tag extends BaseModel
{
    use Fluent;

    public int $id;
    public string $name;

    public static function findByName(string $name): ?static
    {
        $tags = SendPortal::get('tags')['data'];

        return collect($tags)->mapInto(static::class)->filter(fn (self $tag) => strtolower($tag->name) === strtolower($name))->first();
    }
}
