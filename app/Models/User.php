<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'position',
        'department',
        'is_active',
        'last_login_at'
    ];

     protected $casts = [
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];
     public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['superadmin', 'admin']);
    }

    public function getRoleDisplayAttribute(): string
    {
        return match($this->role) {
            'superadmin' => 'Super Admin',
            'admin' => 'Admin',
            default => 'User',
        };
    }

    
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

