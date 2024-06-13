<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'text',
        'is_active',
    ];

    public function editor(): BelongsTo
    {
        return $this->belongsTo(Editor::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
