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
        $categories = Category::Select('id','slug', 'name')->get();

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
        view()->share([
            'relatedsite' => $relatedsite,
            'categories' => $categories,
            'latest_posts' => $latest_posts,
            'gratest_posts_comments' => $gratest_posts_comments,
        ]);
    }
}
