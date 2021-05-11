<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vtwostudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_name',
        'image',
        'email',
        'phone',
    ];

    // Join Categorie

}
