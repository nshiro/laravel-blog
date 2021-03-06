<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $casts = [
        'is_open' => 'boolean',
    ];

    protected $guarded = [];

    /**
     * booted
     */
    protected static function booted()
    {
        static::deleting(function ($blog) {
            $blog->deletePictFile();

            // この書き方では、Comment側ではイベントは発生しない（今回は特にイベントが発生する必要はないが）
            // $blog->comments()->delete();

            // Comment モデルを取得してから削除すれば、イベントは発生する
            $blog->comments->each(function ($comment) {
                $comment->delete();
            });

            // 上記は、こんな風にも書ける（higher order messaging）
            // https://laravel.com/docs/8.x/collections#higher-order-messages
            // $blog->comments->each->delete();
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('pict') && $blog->getOriginal('pict')) {
                $blog->deletePictFile();
            }
        });
    }

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
        return $this->hasMany(Comment::class)->oldest();
    }

    public function scopeOnlyOpen($query)
    {
        return $query->where('is_open', true);
    }

    /**
     * 画像ファイルの削除
     */
    public function deletePictFile()
    {
        if ($path = $this->getOriginal('pict')) {
            Storage::disk('public')->delete($path);
        }
    }
}
