<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request; // Переконайтеся, що ви використовуєте правильний клас
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower; // Імпорт моделі Follower

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
   
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        $authUser = Auth::check() ? Auth::user() : null;
        $isOwner = $authUser && $authUser->id === $user->id;

        $isFollowing = $authUser ? Follower::where('user_id', $authUser->id)
                                            ->where('following_user_id', $user->id)
                                            ->exists() : false;

        $likedPosts = $user->likedPosts()->with('post')->get();
        $savedPosts = $user->savedPosts()->with('post')->get();
                                            

        return view('profile.show', compact('user', 'isOwner', 'followersCount', 'followingCount', 'savedPosts', 'likedPosts', 'isFollowing'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
