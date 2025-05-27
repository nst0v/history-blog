<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'user_id',
        'category_id',
        'status',
        'published_at',
        'views_count',
        'comments_count',
        'meta_data',
        'is_featured',
        'allow_comments',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'meta_data' => 'array',
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
    ];

    // Связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    // Скоупы (фильтры)
    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    // Методы-помощники
    public function getRouteKeyName()
    {
        return 'slug'; // Для роутинг по slug вместо id
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        return ceil($words / 200); // 200 слов в минуту
    }
}
