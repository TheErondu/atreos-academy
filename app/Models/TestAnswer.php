<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_id',
        'question_id',
        'answer'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
