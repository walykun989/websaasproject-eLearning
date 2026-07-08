<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'pengajar_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByPengajar($query, $pengajarId)
    {
        return $query->where('pengajar_id', $pengajarId);
    }

    public function averageRating(): float
    {
        return $this->reviews()->approved()->avg('rating') ?? 0.0;
    }

    public function totalReviews(): int
    {
        return $this->reviews()->approved()->count();
    }

    public function totalMaterials(): int
    {
        return $this->materials()->count();
    }

    public function freeMaterialsCount(): int
    {
        return $this->materials()->where('tier_required', 'free')->count();
    }

    public function hasMandatoryReviewFrom(User $user): bool
    {
        return $this->reviews()->where('user_id', $user->id)->exists();
    }
}
