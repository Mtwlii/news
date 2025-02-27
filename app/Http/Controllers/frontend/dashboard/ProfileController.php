<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    public function storePost(PostRequest $request)
    {
        // Store the post in the database.
        $request->validated();
        $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['status' => 0]);
        $request->merge(['slug' => Str::slug($request->title)]);
        $post = Post::create($request->except(['images', '_token']));
    }
}
