<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'teacher_id', 'subject_id', 'rating', 'commentary'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function teacher(): BelongsTo{
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }
}
