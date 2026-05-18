<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom','email'];
public function evaluations(): HasMany{
    return $this->hasMany(Evaluation::class, 'teacher_id');
}
}
