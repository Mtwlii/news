<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchControler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);
        $keyword = strip_tags($request->search);

        $posts = Post::active()->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->paginate(9);
        return view('frontend.search', compact('posts'));
    }
}
