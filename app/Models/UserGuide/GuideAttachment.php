<?php

namespace App\Models\UserGuide;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuideAttachment extends Model
{
    protected $fillable = ['guide_id', 'filename', 'path'];

    public function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class);
    }
}
