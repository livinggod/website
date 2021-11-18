<?php

namespace App\Directives;

use Illuminate\Support\Facades\View;

class Flexible
{
    public static function render(array $layouts): string
    {
        $html = '';
        foreach ($layouts as $layout) {
            $viewName = strtolower($layout['layout']);
            $view = "flexible.layouts.{$viewName}";

            if (View::exists($view)) {
                $html .= view($view, $layout['attributes']);
            }
        }

        return $html;
    }
}
