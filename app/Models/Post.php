<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = []; // to allow mass assignment of attributes
    // protected $fillable = [
    //     'title',
    //     'description',
    //     'slug',
    //     'image',
    //     'category_id',
    //     'user_id',
    //     'status',
    //     'comment_able',
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
