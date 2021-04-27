<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public function getCode(string $code): string
    {
        return $this->where('code', $code)->first()->content ?? $code;
    }
}
