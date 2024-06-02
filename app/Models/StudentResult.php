<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiztitle_id',     
        'score',
        'availability',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the User model
    public function quizTitle()
    {
        return $this->belongsTo(QuizTitle::class);
    }
}
