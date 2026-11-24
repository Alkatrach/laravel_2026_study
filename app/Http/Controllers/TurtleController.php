<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class TurtleController extends Controller
{
    public function index()
    {
        return redirect()->route('users.show', Auth::user());
    }

    public function create(Request $request)
    {
        return $this->modal($request, 'turtles.form', ['turtle' => new Turtle]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $request->user()->turtles()->create($data);

        return $this->done($request, 'Черепаха добавлена');
    }

    public function show(Request $request, Turtle $turtle)
    {
        if ($turtle->trashed()) {
            Gate::authorize('is-admin');
        }

        return $this->modal($request, 'turtles.show', [
            'turtle' => $turtle,
            'comments' => $turtle->comments()->with('user')->get(),
            'friendIds' => $request->user()->friends()->pluck('users.id'),
        ]);
    }

    public function edit(Request $request, Turtle $turtle)
    {
        Gate::authorize('update-turtle', $turtle);

        return $this->modal($request, 'turtles.form', compact('turtle'));
    }

    public function update(Request $request, Turtle $turtle)
    {
        Gate::authorize('update-turtle', $turtle);

        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            if ($turtle->image) {
                Storage::disk('public')->delete($turtle->image);
            }
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $turtle->update($data);

        return $this->done($request, 'Изменения сохранены');
    }

    public function destroy(Request $request, Turtle $turtle)
    {
        Gate::authorize('delete-turtle', $turtle);

        $turtle->delete();

        return $this->done($request, 'Черепаха удалена');
    }

    public function restore(Request $request, int $id)
    {
        Gate::authorize('is-admin');

        Turtle::onlyTrashed()->findOrFail($id)->restore();

        return $this->done($request, 'Черепаха восстановлена');
    }

    public function forceDelete(Request $request, int $id)
    {
        Gate::authorize('is-admin');

        $turtle = Turtle::onlyTrashed()->findOrFail($id);

        if ($turtle->image) {
            Storage::disk('public')->delete($turtle->image);
        }

        $turtle->forceDelete();

        return $this->done($request, 'Черепаха удалена навсегда');
    }

    private function modal(Request $request, string $view, array $data)
    {
        return $request->ajax() ? view($view, $data) : redirect()->route('turtles.index');
    }

    private function done(Request $request, string $message)
    {
        session()->flash('success', $message);

        return $request->expectsJson() ? response()->json(['ok' => true]) : back();
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'details' => ['nullable', 'string'],
            'publication_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:4096'],
        ], [
            'required' => 'Поле «:attribute» обязательно.',
            'max.string' => 'Поле «:attribute» слишком длинное.',
            'max.file' => 'Файл больше :max КБ.',
            'image' => 'Нужен файл-изображение.',
            'date' => 'Неверная дата.',
        ], [
            'title' => 'название',
            'type' => 'семейство',
            'description' => 'описание',
            'details' => 'подробности',
            'publication_date' => 'дата',
            'image' => 'изображение',
        ]);

        unset($data['image']);

        return $data;
    }

    private function saveImage($file): string
    {
        $image = ImageManager::usingDriver(Driver::class)
            ->decodePath($file->getRealPath())
            ->cover(800, 500);

        $path = 'turtles/' . Str::uuid() . '.jpg';

        Storage::disk('public')->put($path, (string) $image->encodeUsingFormat(Format::JPEG, quality: 85));

        return $path;
    }
}
