<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServesProvider extends ServiceProvider
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
        if (!Cache::has('read_more_posts')) {
            $read_more_posts = Post::select('id', 'title')->latest()->limit(10)->get();
            Cache::remember('read_more_posts', 60, function () use ($read_more_posts) {
                return $read_more_posts;
            });
        }
        $read_more_posts = cache()->get('read_more_posts');
        view()->share([
            'read_more_posts' => $read_more_posts
        ]);
    }
}
