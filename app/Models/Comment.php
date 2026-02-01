<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

 
    protected $fillable = [
        'workshop_id',
        'user_name',
        'comment'
    ];


    public function workshop(): BelongsTo
    {

        return $this->belongsTo(Workshop::class);
    }
}
