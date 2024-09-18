<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    public $timestamps = false; // Вимкнення автоматичних міток часу

   // Додаємо зв'язок з моделлю Post
   public function post()
   {
       return $this->belongsTo(Post::class, 'post_id');
   }
}
