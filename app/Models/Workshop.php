<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Workshop extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'date',
        'category',
        'content',
        'type',
        'code_snippet',
        'image_url',
        'video_url'
    ];

    protected $casts = [
        'date' => 'date',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
