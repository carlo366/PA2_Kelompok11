<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Images_Products;
use App\Models\Order;
use App\Models\Products;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $products = Products::latest()->get();

        $category = Category::all();
        $slider = Slider::all();


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

    $orders = Order::where('product_id', 'LIKE', '%' . $id_products . '%')->whereNotNull('komentar')->get();

    $comments = [];
    $userIds = [];
    $userNames = [];
    $createdDates = [];
    foreach ($orders as $order) {
        $productIds = json_decode($order->product_id);
//Memeriksa apakah ID produk yang diberikan ada dalam array $productIds menggunakan fungsi in_array.
//Jika iya, artinya pesanan tersebut terkait dengan produk yang sedang diproses dalam metode ini.
        if (in_array($id_products, $productIds)) {
            $comments[] = $order->komentar;
            $userIds[] = $order->user_id;
            $userNames[] = User::where('id', $order->user_id)->value('name');
            $createdDates[] = $order->created_at;
        }
    }
    return view('costumers.product_detail', compact('product_detil', 'images','comments', 'userIds', 'userNames', 'createdDates'));
}
public function AddProductToCart(Request $request)
{
    $product = Products::find($request->product_id);
    $userid = Auth::id();

    // Find the cart item for the current user and product
    $cartItem = Carts::where('user_id', $userid)
        ->where('product_id', $request->product_id)
        ->first();

    $totalQuantityRequested = $request->quantity;
    if ($cartItem) {
        $totalQuantityRequested += $cartItem->quantity;
    }

    if ($totalQuantityRequested <= $product->quantity) {
        if ($cartItem) {
            // Update the existing cart item
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Insert a new cart item
            Carts::create([
                'product_id' => $request->product_id,
                'user_id' => $userid,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);
        }

        return redirect()->back()->with('message', 'Barang Berhasil Ditambahkan ke Keranjang');
    } else {
        return redirect()->back()->with('error', 'Stok tidak cukup. Jumlah yang diminta: ' . $request->quantity . ', Stok tersedia: ' . $product->quantity . ', Jumlah di keranjang: ' . ($cartItem ? $cartItem->quantity : 0));
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
