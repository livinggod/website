<?php

namespace App;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): Post;
}
