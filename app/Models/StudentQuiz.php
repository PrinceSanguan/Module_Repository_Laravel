<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    use HasFactory;

    protected $table = 'student_quizzes';

    public function responses()
    {
        return $this->hasMany(Question::class, 'student_quiz_id');
    }
}
