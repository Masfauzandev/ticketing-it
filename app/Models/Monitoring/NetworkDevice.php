<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NetworkDevice extends Model
{
    protected $fillable = [
        'name',
        'ip_address',
        'type',
        'location',
        'description',
        'status',
        'last_checked_at',
    ];

    protected $casts = [
        'last_checked_at' => 'datetime',
    ];

    public function checks(): HasMany
    {
        return $this->hasMany(NetworkCheck::class, 'device_id');
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(NetworkAlert::class, 'device_id');
    }
}
