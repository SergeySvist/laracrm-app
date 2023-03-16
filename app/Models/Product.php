<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'qty',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function subCategories(): BelongsTo{
        return $this->belongsTo(SubCategory::class);
    }
}
