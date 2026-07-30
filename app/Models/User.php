<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // @use HasFactory<UserFactory>
    use HasFactory, Notifiable;

    // The attributes that are mass assignable.
    // @var list<string>
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'phone',
        'position',
        'department',
        'avatar',
    ];

    // Get the user's avatar URL or fallback.
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return null;
    }

    // Role Helper Methods
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    public function canApprove(): bool
    {
        return in_array($this->role, ['manager', 'supervisor']);
    }

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'manager' => 'Manajer Keuangan',
            'supervisor' => 'Supervisor Keuangan',
            'staff' => 'Staff Keuangan',
            default => 'Staff Keuangan',
        };
    }

    // The attributes that should be hidden for serialization.
    // @var list<string>
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Get the attributes that should be cast.
    // @return array<string, string>
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
