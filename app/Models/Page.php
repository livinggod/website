<?php

namespace App\Models;

use App\Traits\ConvertsToWebp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, ConvertsToWebp;
}
