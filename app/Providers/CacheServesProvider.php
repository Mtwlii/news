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
        // Check if the 'read_more_posts' cache does not exist
        if (!Cache::has('read_more_posts')) {
            // Retrieve the latest 10 posts with 'id' and 'title' fields
            $read_more_posts = Post::select('id', 'title', 'slug')->latest()->limit(10)->get();
            // Store the retrieved posts in the cache for 3600 seconds (1 hour)
            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
                return $read_more_posts;
            });
        }
        // Get the 5 latest posts
        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::Select('id', 'slug', 'title')->latest()->take(5)->get();
            Cache::remember('latest_posts', 3600, function ()  use ($latest_posts) {
                return $latest_posts;
            });
        }

        // Get the 5 posts with the most comments
        if (!Cache::has('gratest_posts_comments')) {
            $gratest_posts_comments = Cache::get('gratest_posts_comments');
            $gratest_posts_comments = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(5)
                ->get();
            Cache::remember('gratest_posts_comments', 3600, function () use ($gratest_posts_comments) {
                return $gratest_posts_comments;
            });
        }
        $gratest_posts_comments = Cache::get('gratest_posts_comments');
        $latest_posts = Cache::get('latest_posts');
        $read_more_posts = cache()->get('read_more_posts');
        view()->share([
            'read_more_posts' => $read_more_posts,
            'latest_posts' => $latest_posts,
            'gratest_posts_comments' => $gratest_posts_comments,
        ]);
    }
}
