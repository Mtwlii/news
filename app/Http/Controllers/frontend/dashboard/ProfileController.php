<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Utils\imageMangment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            $request->validated();
            $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
            //$post = Post::create($request->except(['images', '_token']));
            $post = auth()->user()->posts()->create($request->except(['images', '_token']));
            // Store the images in the database.
            imageMangment::uploadImage($request, $post);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(
                ['errors', $e->getMessage()]
            );
        }

        Session()->flash('success', 'Post has been created successfully');
        return redirect()->back();
    }
}
