<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TurtleController extends Controller
{
    public function index()
    {
        $turtles = Turtle::latest()->get();

        return view('turtles.index', compact('turtles'));
    }

    public function create()
    {
        return view('turtles.create', ['turtle' => new Turtle]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        Turtle::create($data);

        return redirect()->route('turtles.index')->with('success', 'Объект добавлен');
    }

    public function show(Request $request, Turtle $turtle)
    {
        if ($request->ajax()) {
            return view('turtles._details', compact('turtle'));
        }

        return view('turtles.show', compact('turtle'));
    }

    public function edit(Turtle $turtle)
    {
        return view('turtles.edit', compact('turtle'));
    }

    public function update(Request $request, Turtle $turtle)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            if ($turtle->image) {
                Storage::disk('public')->delete($turtle->image);
            }
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $turtle->update($data);

        return redirect()->route('turtles.index')->with('success', 'Объект обновлён');
    }

    public function destroy(Turtle $turtle)
    {
        $turtle->delete();

        return redirect()->route('turtles.index')->with('success', 'Объект удалён');
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'publication_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];
    }

    private function saveImage($file): string
    {
        return $file->store('turtles', 'public');
    }
}
