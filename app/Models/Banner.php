<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{   
    protected $fillable = [
        'user_id',
        'article_id',
        'title',
        'image_path',
        'target_url',
        'is_active',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
