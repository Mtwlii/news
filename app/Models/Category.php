<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = [
    //     'name',
    //     'slug',
    //     'status',
    // ];

    // public function post()
    // {
    //     return $this->belongsTo(Post::class, 'category_id');
    // }
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
