<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime',
        'likes' => 'integer',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (BlogPost $post) {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function isLikedBy(?string $likerUuid): bool
    {
        if ($likerUuid === null) {
            return false;
        }

        return BlogPostLike::query()
            ->where('liker_uuid', $likerUuid)
            ->where('blog_post_id', $this->id)
            ->exists();
    }

    public function addLikeBy(string $likerUuid): void
    {
        BlogPostLike::create([
            'blog_post_id' => $this->id,
            'liker_uuid' => $likerUuid,
        ]);

        $this->likes += 1;

        $this->save();
    }
}
