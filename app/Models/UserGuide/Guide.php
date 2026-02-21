<?php

namespace App\Models\UserGuide;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guide extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'author_id',
        'is_published',
        'view_count',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'view_count' => 'integer',
        'order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(GuideCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(GuideAttachment::class);
    }
}
