<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'image',
    ];
    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(Module::class);
    }

}
