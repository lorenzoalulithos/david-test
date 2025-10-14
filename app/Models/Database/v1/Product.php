<?php

namespace App\Models\Database\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $color
 */
class Product extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
