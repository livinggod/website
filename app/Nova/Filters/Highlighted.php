<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class Highlighted extends BooleanFilter
{
    public function apply(Request $request, $query, $value): Builder
    {
        if (!$value['highlight']) {
            return $query;
        }

        return $query->where('highlight', $value);
    }

    public function options(Request $request): array
    {
        return [
            'highlighted' => 'highlight'
        ];
    }
}
