<?php

namespace App\Integrations\SendPortal;

class Tag
{
    public function __construct(
        protected SendPortal $sendPortal
    )
    {
    }

    public function get(string $name): ?array
    {
        $tags = $this->sendPortal->get('tags')['data'];

        return collect($tags)->filter(fn (array $tag) => strtolower($tag['name']) === strtolower($name))->first();
    }
}
