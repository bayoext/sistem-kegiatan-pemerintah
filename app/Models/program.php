<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
        'location',
        'thumbnail',
        'user_id',
        'is_public',
        'views',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
        'is_public' => 'boolean',
        'views' => 'integer',
    ];

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

     public function scopeByStatus($query, $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

     public function scopeSearch($query, $search)
    {
        return $search ? $query->where('title', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%") : $query;
    }

    /**
     * The categories that belong to the program.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the user that owns the program.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Generate slug from title.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            $program->slug = \Str::slug($program->title);
        });

        static::updating(function ($program) {
            $program->slug = \Str::slug($program->title);
        });
    }

    /**
     * Get status color for UI.
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'planning' => 'bg-blue-100 text-blue-800',
            'ongoing' => 'bg-green-100 text-green-800',
            'completed' => 'bg-gray-100 text-gray-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get status label in Indonesian.
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'planning' => 'Perencanaan',
            'ongoing' => 'Sedang Berjalan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    /**
     * Format budget with currency.
     */
    public function getFormattedBudgetAttribute()
    {
        return $this->budget ? 'Rp ' . number_format($this->budget, 0, ',', '.') : '-';
    }
}
