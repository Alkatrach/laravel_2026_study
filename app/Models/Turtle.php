<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class Turtle extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'publication_date', 'image'];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::ucfirst(trim($value)),
        );
    }

    protected function releaseDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value?Carbon::parse($value) : null,
            set: fn ($value)=>Carbon::parse($value)->format('Y-m-d'),
        );
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image?asset('storage/' . $this->image):'https://placehold.co/600x400?text=No+image',
        );
    }
}
