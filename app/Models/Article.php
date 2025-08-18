<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'image_content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class, 'article_views')
                    ->withTimestamps()
                    ->withPivot('viewed_at');
    }

    public function banners()
    {
        return $this->hasOne(Banner::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }
        
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isViewedBy($user)
    {
        if (!$user) {
            return false;
        }
        
        return $this->views()->where('user_id', $user->id)->exists();
    }

    public function getViewsCount()
    {
        return $this->views()->count();
    }

    public function getLikesCount()
    {
        return $this->likes()->count();
    }

}
