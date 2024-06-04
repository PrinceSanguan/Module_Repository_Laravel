<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiztitle_id',
        'question',
        'choicesA',
        'choicesB',
        'choicesC',
        'choicesD',
        'answer',
    ];

    // Define the relationship: a question belongs to a quiz title
    public function quizTitle()
    {
        return $this->belongsTo(QuizTitle::class);
    }
}
