<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\View\View;

class HomeController
{
    public function index(): View
    {
        $notices = Notice::approved()->orderBy('created_at', 'desc')->take(5)->get();
        return view('welcome', compact('notices'));
    }
}
