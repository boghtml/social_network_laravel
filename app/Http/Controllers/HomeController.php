<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Отримати всі пости з їх користувачами
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        // Повернути view з постами
        return view('home', compact('posts'));
    }
}
