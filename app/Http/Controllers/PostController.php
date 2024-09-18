<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\SavedPost;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function toggleLike($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($like) {
            // Видалити лайк
            $like->delete();
        } else {
            // Додати лайк
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }

        return back()->with('status', 'Like updated!');
    }

    public function toggleSave($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        $savedPost = SavedPost::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($savedPost) {
            // Видалити збережений пост
            $savedPost->delete();
        } else {
            // Додати збережений пост
            SavedPost::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }

        return back()->with('status', 'Saved status updated!');
    }
}
