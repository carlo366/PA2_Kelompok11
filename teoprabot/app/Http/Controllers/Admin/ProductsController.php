<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Images_Products;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
      $products = Products::latest()->get();
      $categories = Category::latest()->get();
      return view('admin.produk.allproduk', compact('products','categories'));
  }
  public function indexgambar($id_products){
    $product = Products::findOrFail($id_products);
    $productImage = Images_Products::where('product_id',$id_products)->get();
    return view('admin.produk.imageproduk.semuagambar',compact('product','productImage'));
  }
  public function StoreGambar(Request $request, $id_products){
    $user_id = Auth::id();
    $request->validate([
        'images.*'=> 'required|image|mimes:png,jpg,jpeg,webp',
    ]);

    $imageData = [];

    if ($request->hasFile('images')) {
        foreach($request->file('images') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $path = "uploads/products/";
            $file->move($path, $filename);
            $imageData[] = [
                'user_id' => $user_id,
                'product_id' => $id_products,
                'image' => $path.$filename,
            ];
        }
        // Simpan data gambar ke database
        Images_Products::insert($imageData);

        return redirect()->back()->with('status', 'Upload Success');
    } else {
        return redirect()->back()->withErrors(['images' => 'No images were provided']);
    }

  }
  public function HapusGambar($id_images)
  {
      $product_image = Images_Products::where('images_id', $id_images)->firstOrFail();
      $product_image->delete();
      return redirect()->back()->with('status', 'Hapus Kategori Berhasil');
  }
  public function HapusProduct($id)
  {
      $product = Products::findOrFail($id);
      Images_Products::where('product_id', $id)->delete();
      $product->delete();

    return redirect()->back()->with('status', 'Hapus Produk Berhasil');
    }

  public function EditProduk($id){
    $produkdetil = Products::FindOrFail($id);
    $category = Category::latest()->get();
    return view('admin.produk.tambahproduk',compact('produkdetil','category'));
  }


public function Updateproduk(Request $request){
    $id_products = $request->id_products;

    $request->validate([
        'name_products' => 'required|unique:products,name_products,'.$id_products.',id_products',
        'description_products' => 'required',
        'product_category_id' => 'required|exists:categories,id_categories',
        'price' => 'required|numeric|min:0',
        'length' => 'required|numeric|min:0',
        'width' => 'required|numeric|min:0',
        'color' => 'required',
        'quantity' => 'required|integer|min:0',
    ]);

    Products::findOrFail($id_products)->update([
        'name_products' => $request->name_products,
        'description_products' => $request->description_products,
        'product_category_id' => $request->product_category_id,
        'price' => $request->price,
        'length' => $request->length,
        'width' => $request->width,
        'color' => $request->color,
        'quantity' => $request->quantity,
    ]);

    // Redirect with a success message
    return redirect()->route('adminallproduk')->with('message', 'Produk berhasil diperbarui!');
}
  public function StoreProduct(Request $request)
  {
    $user_id = Auth::id();

      // Validasi inputan
      $request->validate([
          'name_products' => 'required|string|max:255',
          'id_categories' => 'required|exists:categories,id_categories',
          'description_products' => 'required|string',
          'harga' => 'required|numeric|min:0',
          'jumlah' => 'required|integer|min:0',
          'panjang' => 'required|integer|min:0',
          'lebar' => 'required|integer|min:0',
          'warna' => 'required|string|max:255',
      ]);

      // Simpan data produk ke dalam database
      Products::create([
        'user_id' => $user_id,
          'name_products' => $request->name_products,
          'product_category_id' => $request->id_categories,
          'description_products' => $request->description_products,
          'price' => $request->harga,
          'quantity' => $request->jumlah,
          'length' => $request->panjang,
          'width' => $request->lebar,
          'color' => $request->warna,
      ]);

      // Redirect ke halaman yang sesuai (misalnya, halaman dengan daftar produk)
      return redirect()->route('adminallproduk');
  }


}
