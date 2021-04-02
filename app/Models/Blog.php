<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '（退会者）'
        ]);
    }

    /**
     * hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
