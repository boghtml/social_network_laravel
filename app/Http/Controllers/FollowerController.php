<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function toggleFollow($username)
    {
        $userToFollow = User::where('username', $username)->firstOrFail();

        $authUser = Auth::user();

        $existingFollow = Follower::where('user_id', $authUser->id)
            ->where('following_user_id', $userToFollow->id)
            ->first();

        if ($existingFollow) {
            $existingFollow->delete();
        } else {

            Follower::create([
                'user_id' => $authUser->id,
                'following_user_id' => $userToFollow->id,
            ]);
        }

        return back()->with('status', 'Follow status updated!');
    }
}
