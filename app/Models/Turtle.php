<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Turtle extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'type', 'description', 'details', 'publication_date', 'image'];

    protected static function booted(): void
    {
        static::updating(function (Turtle $turtle) {
            if (Auth::check()) {
                Gate::authorize('update-turtle', $turtle);
            }
        });

        static::deleting(function (Turtle $turtle) {
            if (! Auth::check()) {
                return;
            }

            if ($turtle->isForceDeleting()) {
                Gate::authorize('is-admin');
            } else {
                Gate::authorize('delete-turtle', $turtle);
            }
        });

        static::restoring(function (Turtle $turtle) {
            if (Auth::check()) {
                Gate::authorize('is-admin');
            }
        });
    }

    protected function casts(): array
    {
        return [
            'publication_date' => 'date:Y-m-d',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->oldest();
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(trim($value)),
        );
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
                $paragraphs = preg_split('/\R+/u', trim((string) $this->details));

                return collect($paragraphs)->filter()->map(function ($paragraph) {
                    $paragraph = preg_replace_callback(
                        '/\{\{(.+?)\|(.+?)\}\}/u',
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
