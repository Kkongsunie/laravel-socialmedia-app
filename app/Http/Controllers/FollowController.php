<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function createFollow(User $user)
    {
        // Cannot follow yourself
        if (auth()->user()->id === $user->id) {
            return back()->with('failure', "Can't follow yourself bozo!");
        }
        // Cannot follow someone you're already following
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->count();

        if ($existCheck) {
            return back()->with('failure', 'Already followed that user');
        }

        $newFollow = new Follow();
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followedUser = $user->id;
        $newFollow->save();

        return back()->with('success', 'User successfully followed.');
    }

    public function removeFollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->delete();

        return back()->with('success', 'User unfollowed');
    }
}
