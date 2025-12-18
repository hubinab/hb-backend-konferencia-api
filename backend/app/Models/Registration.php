<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    // Csak igy van ertelme a soft delete-nek.
    use SoftDeletes;
    
    protected $fillable = [
        "name",
        "vegetarian",
        "date",
        "arrived"
    ];
}
