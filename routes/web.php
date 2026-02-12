<?php

use Illuminate\Support\Facades\Route;
use MrShaneBarron\LaravelDesign\Models\Post;

Route::get('/', function () {
    // Try to find a page with slug 'home' or 'home-page'
    $page = Post::pages()
        ->published()
        ->whereIn('slug', ['home', 'home-page'])
        ->first();

    if ($page) {
        $template = $page->template ?: 'default';
        $viewName = "laraveldesign::pages.{$template}";

        if (!view()->exists($viewName)) {
            $viewName = 'laraveldesign::pages.default';
        }

        return view($viewName, compact('page'));
    }

    // Fallback to welcome page if no homepage exists
    return view('welcome');
});
