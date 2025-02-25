<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Get all posts with images, ordered by latest, paginated by 9 items per page.
        $posts = Post::active()->with('images')->latest()->paginate(9);

        $gretest_posts_views = Post::active()->orderBy('num_of_views', 'desc')->limit(3)->get();

        $oldest_news = Post::active()->oldest()->limit(3)->get();

        $gratest_Post_Comments = Post::active()->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(3)
            ->get();

        //////// //////////////// Categories with their latest posts///////////////////

        $categories = Category::all();
        $categories_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->limit(4)->get();
            return $category;
        });

        return view(
            'frontend.index',
            compact(
                'posts',
                'gretest_posts_views',
                'oldest_news',
                'gratest_Post_Comments',
                'categories_with_posts'
            )
        );
    }
}
