<?php

namespace App\Directives;

use Illuminate\Support\Facades\View;

class Flexible
{
    public static function render(array $layouts): string
    {
        $html = '';
        foreach ($layouts as $component) {
            $viewName = strtolower($component['type']);
            $view = "flexible.components.{$viewName}";

            if (View::exists($view)) {
                $html .= view($view, $component['data']);
            }
        }

        return $html;
    }
}
