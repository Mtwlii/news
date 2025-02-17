<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = []; // This will automatically exclude the 'id' and 'created_at' fields from mass assignment.
    // protected $fillable = ['name', 'email', 'phone', 'ip_address', 'title', 'body'];
}
