<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_products',
        'name_products',
        'description_products',
        'product_category_id',
        'price',
        'quantity',
        'length',
        'width',
        'color',
    ];
    protected $primaryKey = 'id_products';

    protected $tables = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category_id', 'id_categories');
    }
    public function carts()
    {
        return $this->hasMany(Carts::class, 'product_id', 'id_products');
    }

    public function images()
    {
        return $this->hasMany(Images_Products::class, 'product_id', 'id_products');
    }

    public function hapusProduct($id)
    {
        $product = Products::findOrFail($id);

        // Hapus gambar produk yang terkait
        $product->images()->delete();

        // Hapus produk
        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('adminallproduk')->with('status', 'Hapus Produk Berhasil');
    }
}
