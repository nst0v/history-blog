<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link_url',
        'position',
        'sort_order',
        'is_active',
        'starts_at',
        'ends_at',
        'clicks_count',
        'views_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // Скоупы
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('starts_at')
                          ->orWhere('starts_at', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('ends_at')
                          ->orWhere('ends_at', '>=', now());
                    });
    }

    public function scopeByPosition(Builder $query, $position)
    {
        return $query->where('position', $position);
    }

    // Методы-помощники
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function incrementClicks()
    {
        $this->increment('clicks_count');
    }

    public function getCtrAttribute()
    {
        return $this->views_count > 0
            ? round(($this->clicks_count / $this->views_count) * 100, 2)
            : 0;
    }
}
