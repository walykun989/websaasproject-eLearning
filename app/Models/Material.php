<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content_type',
        'content',
        'order',
        'tier_required',
        'duration_minutes',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByTier($query, $tier)
    {
        return $query->where('tier_required', $tier);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function isAccessibleBy(User $user): bool
    {
        $tierHierarchy = ['free' => 0, 'apik' => 1, 'sangar' => 2];
        return $tierHierarchy[$user->tier] >= $tierHierarchy[$this->tier_required];
    }

    public function isFree(): bool
    {
        return $this->tier_required === 'free';
    }
}
