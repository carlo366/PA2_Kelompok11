<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_Products extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image',
    ];

    protected $primaryKey = 'images_id';

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id_products');
    }
}
