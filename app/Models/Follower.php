<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'following_user_id'];

    public $timestamps = false;

    protected $primaryKey = 'follower_id';
}
