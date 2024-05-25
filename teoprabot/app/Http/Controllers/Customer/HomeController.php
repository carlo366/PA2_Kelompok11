<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Images_Products;
use App\Models\Products;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $products = Products::latest()->get();

        $category = Category::first()->get();
        $slider = Slider::first()->get();


        // Ambil gambar pertama untuk setiap produk

        // Kirim data produk dan gambar ke tampilan
        return view('costumers.dasboard', compact('products','slider','category'));
    }

    public function semuaproduk(){
        $products = Products::latest()->get();

        $categories = Category::latest()->get();
        // Ambil gambar pertama untuk setiap produk

        // Kirim data produk dan gambar ke tampilan
        return view('costumers.allproduct', compact('products','categories'));
    }
public function ProdukDetil($id_products) {
    $product_detil = Products::findOrFail($id_products);
    $images = Images_Products::where('product_id',$id_products)->get();
    return view('costumers.product_detail', compact('product_detil', 'images'));
}
public function AddProductToCart(Request $request)
{
    $product = Products::find($request->product_id);

    $userid = Auth::id();

    $totalQuantityInCart = Carts::where('user_id', $userid)
        ->where('product_id', $request->product_id)
        ->sum('quantity');

    $totalQuantityRequested = $totalQuantityInCart + $request->quantity;

    if ($totalQuantityRequested <= $product->quantity) {
        Carts::Insert([
            'product_id' => $request->product_id,
            'user_id' => $userid,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('message', 'Barang Berhasil Ditambahkan ke Keranjang');
    } else {
        return redirect()->back()->with('error', 'Stok tidak cukup. Jumlah yang diminta: ' . $request->quantity . ', Stok tersedia: ' . $product->quantity . ', Jumlah di keranjang: ' . $totalQuantityInCart);
    }
}
public function gallery(){
$gallery = Gallery::latest()->get();

return view('costumers.gallery', compact('gallery'));


}
public function about(){
    return view('costumers.about');
}

public function CategoryPage($id){
    $cat = Category::latest()->get();
    $categories = Category::findOrFail($id);
    $products = Products::where('product_category_id',$id)->latest()->get();
return view('costumers.categoryproduk',compact('categories','products','cat'));
}
}
