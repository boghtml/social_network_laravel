<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedPost extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    public $timestamps = false; // Вимкнення автоматичних міток часу

    // Вказання поля primary key
    protected $primaryKey = 'savedpost_id';

    // Вимкнення автоінкремента для primary key
    public $incrementing = false;

    // Вказання типу primary key як int
    protected $keyType = 'int';

     // Додаємо зв'язок з моделлю Post
     public function post()
     {
         return $this->belongsTo(Post::class);
     }
}
