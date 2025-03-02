<?php

namespace App\Utils;

use Illuminate\Support\Str;

class imaGeMangment
{
    public static function uploadImage($request, $post)
    {
        $hasImages = $request->hasFile('images');
        if ($hasImages) {
            foreach ($request->images as $image) {
                $filename = Str::uuid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/posts', $filename, ['disk' => 'uploads']);

                $post->images()->create([
                    'path' => $path
                ]);
            }
        }
    }
}
