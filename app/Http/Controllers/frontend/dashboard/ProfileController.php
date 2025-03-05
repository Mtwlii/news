<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Utils\imageMangment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        //$posts = Post::active()->with(['images', 'comments'])->where('user_id', auth()->user()->id)->get();
        $posts = auth()->user()->posts()->active()->with(['images'])->latest()->get();
        // return $posts;
        return view('frontend.dashboard.profile', compact('posts'));
    }

    public function storePost(PostRequest $request)
    {
        // Store the post in the database.
        try {
            DB::beginTransaction();
            $request->validated();
            $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
            //$post = Post::create($request->except(['images', '_token']));
            $post = auth()->user()->posts()->create($request->except(['images', '_token']));
            // Store the images in the database.
            imageMangment::uploadImage($request, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
            Cache::forget('gratest_posts_comments');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(
                ['errors', $e->getMessage()]
            );
        }

        Session()->flash('success', 'Post has been created successfully');
        return redirect()->back();
    }
    public function editPost($slug)
    {
        return $slug;
    }
    public function deletePost(Request $request)
    {

        $post = Post::where('slug', $request->slug)->first();
        if (!$post) {
            abort(404);
        }
        imageMangment::deleteImage($post);
        $post->delete();
        Cache::forget('read_more_posts');
        Cache::forget('latest_posts');
        Cache::forget('gratest_posts_comments');
        return redirect()->back()->with('success', 'Post has been deleted successfully');
    }
}
