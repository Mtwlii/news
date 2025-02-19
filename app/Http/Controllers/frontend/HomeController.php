<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $gretest_posts_views = Post::orderBy('num_of_views', 'desc')->limit(3)->get();

        return view('frontend.index', compact('posts', 'gretest_posts_views'));
    }
}
