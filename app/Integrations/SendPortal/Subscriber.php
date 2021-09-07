<?php

namespace App\Integrations\SendPortal;

class Subscriber
{
    public function __construct(
        protected SendPortal $sendPortal
    )
    {
    }

    /**
     * @param array<int> $tags
     */
    public function add(string $email, string $firstname = '', string $lastname = '', array $tags = []): array
    {
        return $this->sendPortal->post('subscribers', [
            'first_name' => $firstname,
            'last_name'  => $lastname,
            'email'      => $email,
            'tags'       => $tags,
        ]);
    }
}
