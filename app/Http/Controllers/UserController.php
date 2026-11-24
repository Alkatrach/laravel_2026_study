<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index', [
            'users' => User::withCount('turtles')->orderBy('username')->get(),
            'friendIds' => $request->user()->friends()->pluck('users.id'),
        ]);
    }

    public function show(User $user)
    {
        $query = $user->turtles()->orderBy('id');

        if (Gate::allows('is-admin')) {
            $query->withTrashed();
        }

        return view('turtles.index', ['owner' => $user, 'turtles' => $query->get()]);
    }
}
