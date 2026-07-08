<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'tier', 'theme', 'border_style', 'profile_photo', 'bio', 'instagram_link', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function taughtCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'pengajar_id');
    }

    public function privateSessions(): HasMany
    {
        return $this->hasMany(PrivateSession::class, 'pengajar_id');
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopePengajar($query)
    {
        return $query->where('role', 'pengajar');
    }

    public function scopePeserta($query)
    {
        return $query->where('role', 'peserta');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByTier($query, $tier)
    {
        return $query->where('tier', $tier);
    }

    // Methods
    public function isPremium(): bool
    {
        return in_array($this->tier, ['apik', 'sangar']);
    }

    public function canAccessMaterial(Material $material): bool
    {
        $tierHierarchy = ['free' => 0, 'apik' => 1, 'sangar' => 2];
        return $tierHierarchy[$this->tier] >= $tierHierarchy[$material->tier_required];
    }

    public function hasActiveSubscription(): bool
    {
        return $this->tier !== 'free';
    }

    public function hasReviewedCourse(Course $course): bool
    {
        return $this->reviews()->where('course_id', $course->id)->exists();
    }

    public function hasCompletedCourse(Course $course): bool
    {
        $allMaterials = $course->materials()->published()->get();

        if ($allMaterials->isEmpty()) {
            return false;
        }

        $accessibleMaterials = $allMaterials->filter(function($material) {
            return $material->isAccessibleBy($this);
        });

        if ($accessibleMaterials->isEmpty()) {
            return false;
        }

        $completedCount = $this->progress()
            ->whereIn('material_id', $accessibleMaterials->pluck('id'))
            ->where('is_completed', true)
            ->count();

        return $completedCount === $accessibleMaterials->count();
    }
}
