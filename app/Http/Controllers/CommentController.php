<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Turtle $turtle)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ], [
            'required' => 'Напишите комментарий.',
            'max' => 'Комментарий слишком длинный.',
        ]);

        $turtle->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return $request->expectsJson() ? response()->json(['ok' => true]) : back();
    }
}
