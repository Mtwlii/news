<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
    public static function deleteImage($post)
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                if (File::exists(public_path($image->path))) {
                    File::delete(public_path($image->path));
                }
            }
        }
    }
}
