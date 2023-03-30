<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisions extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'slug'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
