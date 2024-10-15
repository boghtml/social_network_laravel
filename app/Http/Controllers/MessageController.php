<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{

    public function index()
    {
        $following = Auth::user()->followingUsers;

        return view('messages.index', compact('following'));
    }

    public function show($username)
    {
        $user = Auth::user();

        $chatUser = User::where('username', $username)->firstOrFail();

         $isFollowing = $user->followingUsers->contains('id', $chatUser->id);

         if (!$isFollowing) {
             abort(403, 'Ви не можете писати цьому користувачу, оскільки ви його не відстежуєте.');
         }

        $following = $user->followingUsers;

        $messages = Message::where(function($query) use ($user, $chatUser) {
            $query->where('sender_id', $user->id)->where('receiver_id', $chatUser->id);
        })->orWhere(function($query) use ($user, $chatUser) {
            $query->where('sender_id', $chatUser->id)->where('receiver_id', $user->id);
        })->orderBy('created_at')->get();

        return view('messages.show', compact('chatUser', 'messages', 'following'));
    }


    public function store(Request $request, $username)
    {
        $user = Auth::user();

        $chatUser = User::where('username', $username)->firstOrFail();

        $isFollowing = $user->followingUsers->contains('id', $chatUser->id);

        if (!$isFollowing) {
            abort(403, 'Ви не можете писати цьому користувачу, оскільки ви його не відстежуєте.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $chatUser->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('messages.show', $chatUser->username);
    }
}
