<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Turtle extends Model
{
    //Астрологи объявили неделю стрелочных функций!
    //Количество function, return и фигурных скобок в коде снижено на 50%. Прирост лаконичности во всех репозиториях увеличился вдвое! 
    //До этого здесь была грязь.

    use SoftDeletes;

    protected $fillable = ['title', 'type', 'description', 'details', 'publication_date', 'image'];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(trim($value)), //самый типичный пример мутатора. делает первую букву заглавной
        );
    }

    //protected function publicationDate(): Attribute
    //{
    //    return Attribute::make(
    //        get: fn ($value) => $value ? Carbon::parse($value) : null,
    //        set: fn ($value) => $value ? Carbon::parse($value)->format('Y-m-d') : null,
    //    );
    //}

    protected function casts(): array //так в вики 13 ларавела
    {
        return [
            'publication_date' => 'date:Y-m-d',
        ];
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image
                ? asset('storage/' . $this->image)
                : 'https://placehold.co/800x500?text=No+image',
        );
    }

    protected function detailsHtml(): Attribute
    {
        return Attribute::make(
            get: function () {
                $paragraphs = preg_split('/\R+/u', trim((string) $this->details));//абзацы по переносам строк
                //убираю пустые абзацы, парсю html заранее
                return collect($paragraphs)->filter()->map(function ($paragraph) {
                    $paragraph = preg_replace_callback(
                        '/\{\{(.+?)\|(.+?)\}\}/u',//регулярка для разбития
                        fn ($m) => '<span class="popover-term" tabindex="0" data-bs-toggle="popover" data-bs-title="'
                            . Str::ucfirst($m[1]) . '" data-bs-content="' . $m[2] . '">' . $m[1] . '</span>',
                        e($paragraph)
                    );

                    return '<p>' . $paragraph . '</p>';
                })->implode('');
            },
        );
    }
}
