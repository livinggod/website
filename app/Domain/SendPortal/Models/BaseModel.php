<?php

namespace App\Domain\SendPortal\Models;

use App\Domain\SendPortal\Facades\SendPortal;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class BaseModel implements Arrayable
{
    protected array $data;

    protected ?string $endpoint = null;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public static function find(int $id): ?static
    {
        $tag = SendPortal::get(
            strtolower((new static)->getEndpoint()).'/'.$id
        )['data'];

        return new static($tag);
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    protected function getEndpoint(): string
    {
        return $this->endpoint ?? Str::plural(class_basename(static::class));
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
