<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user)
    {
        $me = $request->user();

        abort_if($me->is($user), 422, 'Нельзя добавить в друзья самого себя.');

        Friendship::firstOrCreate(['user_id' => $me->id, 'friend_id' => $user->id]);

        return back();
    }

    public function destroy(Request $request, User $user)
    {
        $me = $request->user();
        Friendship::where(fn ($q) => $q->where('user_id', $me->id)->where('friend_id', $user->id))
            ->orWhere(fn ($q) => $q->where('user_id', $user->id)->where('friend_id', $me->id))->delete();
        return back();
    }
}
