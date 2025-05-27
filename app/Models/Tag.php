<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'posts_count',
    ];

    // Связи
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function publishedPosts()
    {
        return $this->belongsToMany(Post::class)
                    ->published();
    }

    // Методы-помощники
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function updatePostsCount()
    {
        $this->update(['posts_count' => $this->publishedPosts()->count()]);
    }
}
