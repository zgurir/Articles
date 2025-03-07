<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Rating extends Model
{
    use HasFactory;
  
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
