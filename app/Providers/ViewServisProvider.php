<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServisProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Get the related news sites and categories
        $relatedsite = RelatedNewsSite::Select('name', 'url')->get();
        $categories = Category::Select('id', 'slug', 'name')->get();

        view()->share([
            'relatedsite' => $relatedsite,
            'categories' => $categories,
        ]);
    }
}
