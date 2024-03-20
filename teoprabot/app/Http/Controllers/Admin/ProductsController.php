<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Images_Products;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
      $products = Products::latest()->get();
      return view('admin.produk.allproduk', compact('products'));
  }
  public function indexgambar($id_products){
    $product = Products::findOrFail($id_products);
    $productImage = Images_Products::where('product_id',$id_products)->get();
    return view('admin.produk.imageproduk.semuagambar',compact('product','productImage'));
  }
  public function StoreGambar(Request $request, $id_products){
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

}
