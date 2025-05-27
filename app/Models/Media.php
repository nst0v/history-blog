<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_name',
        'mime_type',
        'path',
        'size',
        'metadata',
        'uploaded_by',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    // Связи
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Методы-помощники
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }

    public function getSizeInMbAttribute()
    {
        return round($this->size / (1024 * 1024), 2);
    }

    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function getAltTextAttribute()
    {
        return $this->metadata['alt'] ?? $this->original_name;
    }
}
