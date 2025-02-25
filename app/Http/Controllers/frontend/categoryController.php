<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class categoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(request $request, $slug)
    {
        $category = Category::active()->where('slug', $slug)->first();
        $posts = $category->posts()->paginate(9);
        return view('frontend.category-posts', compact('posts', 'category'));
    }
}
