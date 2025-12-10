<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'user_id'
    ];

    /**
     * The programs that belong to the category.
     */
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }

    /**
     * Get the user that owns the category.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate slug from name.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = \Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = \Str::slug($category->name);
        });
    }
}
