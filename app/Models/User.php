<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'callname',
        'gender',
        'employee_id',
        'email',
        'username',
        'password',
        'phone',
        'department',
        'branch',
        'photo',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    // ─── Relationships ───────────────────────────────────────

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignedTickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Ticketing\Ticket::class, 'assigned_to');
    }

    // ─── Role & Permission Helpers ───────────────────────────

    /**
     * Cek apakah user memiliki role tertentu.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Cek apakah user memiliki permission tertentu (via role).
     */
    public function hasPermission(string $permissionName): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissionName) {
                $query->where('name', $permissionName);
            })
            ->exists();
    }

    /**
     * Ambil semua permission user dari semua role-nya.
     */
    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        return $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->unique('id');
    }
}
