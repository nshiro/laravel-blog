<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * booted
     */
    protected static function booted()
    {
        static::deleting(function($comment) {
            logger("deleted ".$comment->id);
        });
    }
}
