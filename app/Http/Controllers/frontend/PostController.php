<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Request $request, $slug)
    {
        $mainpost = Post::with(['comments' => function ($q) {
            $q->latest()->limit(3);
        }])->where('slug', $slug)->first();
        $category = $mainpost->category;
        $relatedPostCategory = $category->posts()
            ->where('id', '!=', $mainpost->id)
            ->select('id', 'title', 'slug')
            ->take(5)->get();
        // return $relatedPosts;
        return view('frontend.show', compact('mainpost', 'relatedPostCategory'));
    }
    public function getAllComments(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }
}
