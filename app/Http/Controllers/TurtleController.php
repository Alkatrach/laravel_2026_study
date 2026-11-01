<?php

namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class TurtleController extends Controller
{
    public function index()
    {
        return view('turtles.index', ['turtles' => Turtle::orderBy('id')->get()]);
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

        Turtle::create($data);

        return $this->done($request, 'Черепаха добавлена');
    }

    public function show(Request $request, Turtle $turtle)
    {
        return $this->modal($request, 'turtles.show', compact('turtle'));
    }

    public function edit(Request $request, Turtle $turtle)
    {
        return $this->modal($request, 'turtles.form', compact('turtle'));
    }

    public function update(Request $request, Turtle $turtle)
    {
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
        $turtle->delete();

        return $this->done($request, 'Черепаха удалена');
    }

    private function modal(Request $request, string $view, array $data)
    {
        return $request->ajax() ? view($view, $data) : redirect()->route('turtles.index');
    }

    private function done(Request $request, string $message)
    {
        session()->flash('success', $message);

        return $request->expectsJson()
            ? response()->json(['ok' => true])
            : redirect()->route('turtles.index');
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
