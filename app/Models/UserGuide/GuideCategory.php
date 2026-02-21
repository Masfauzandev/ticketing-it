<?php

namespace App\Models\UserGuide;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuideCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];

    public function guides(): HasMany
    {
        return $this->hasMany(Guide::class, 'category_id');
    }
}
