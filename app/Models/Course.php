<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster',
        'description',
        'assigned_roles'
    ];

    /**
     * Get the lessons for the Course.
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    /**
     * Get the Test for the Course.
     */
    public function test(): HasOne
    {
        return $this->hasOne(Test::class);
    }
    /**
     * Get the Questions for the Course.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the Enrollments for the Course.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

}
