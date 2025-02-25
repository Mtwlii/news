<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

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
        $post = Post::active()->where('slug', $slug)->first();
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }
    public function saveComment(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'comment' => ['required', 'string', 'max:255'],
        ]);

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'ip_address' => $request->ip(),
        ]);

        // Load the related user data for the comment to make it available in the response
        $comment->load('user');

        if (!$comment) {
            return response()->json([
                'comment' => 'Comment not saved',
                'status' => 403
            ]);
        }

        return response()->json([
            'msg' => 'Comment saved successfully',
            'comment' => $comment,
            'status' => 201
        ]);
    }
}
