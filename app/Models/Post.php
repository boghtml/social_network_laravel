<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image_url', 'user_id']; // додайте ваші поля

    // Зв'язок з таблицею users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        // Зв'язок з моделлю Post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function savedPosts()
    {
        return $this->hasMany(SavedPost::class);
    }

    
}
