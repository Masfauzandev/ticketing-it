<?php

namespace App\Services;

/**
 * Business logic untuk modul User Guide.
 */
class UserGuideService
{
    /**
     * Increment view count sebuah guide.
     */
    public function incrementViewCount(int $guideId): void
    {
        // TODO: Implement view count increment
    }

    /**
     * Generate slug dari judul.
     */
    public function generateSlug(string $title): string
    {
        return \Illuminate\Support\Str::slug($title);
    }
}
