<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $friendIds = $request->user()->friends()->pluck('users.id');
        $turtles = Turtle::whereIn('user_id', $friendIds)->with('user')->latest()->get();
        return view('feed.index', compact('turtles'));
    }
}
