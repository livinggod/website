<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $valid = $request->validate([
            'email' => 'required|email'
        ]);

        Newsletter::create($valid);

        session()->flash('message', __('Thanks for singing up! You\'ll now receive updates on our latest articles!'));

        return back();
    }
}
