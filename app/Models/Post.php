<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

public static function boot()
{
    parent::boot();

    static::creating(function ($post) {
        $post->user()->associate(auth()->user());
        $post->category()->associate(request()->category);
    });

    self::updating(function ($post) {
        $post->category()->associate(request()->category);
    });
} 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($attribute)
    {
        return Str::title($attribute);
    }
}
