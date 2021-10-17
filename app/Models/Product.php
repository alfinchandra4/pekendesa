<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_category() {
        // return $this->belongsTo(ProductCategory::class, 'id');
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function seller() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
//
