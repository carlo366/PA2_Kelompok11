<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_products',
        'name_products',
        'description_products',
        'product_category_id',
        'price',
        'quantity',
    ];
    protected $primaryKey = 'id_products';

    protected $tables = 'products';

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'product_category_id');
    }

}
