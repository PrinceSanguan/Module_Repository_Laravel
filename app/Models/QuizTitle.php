<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiztitle_id'); // Explicitly specify the foreign key
    }
}
