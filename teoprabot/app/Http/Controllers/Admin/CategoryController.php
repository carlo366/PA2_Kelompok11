<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function index()
      {
        $categories = Category::latest()->get();
        return view('admin.categori.allcategori', compact('categories'));
    }
    public function storeKategori(Request $request)
    {
        $request->validate([
            'namakategori' => 'required|unique:categories,name_categories|regex:/^[A-Z][a-zA-Z\s]*$/'
        ], [
            'namakategori.required' => 'Nama kategori wajib diisi.',
            'namakategori.unique' => 'Nama kategori sudah digunakan.',
            'namakategori.regex' => 'Nama kategori harus diawali dengan huruf besar dan hanya boleh berisi huruf dan spasi.'
        ]);

        Category::insert([
            'name_categories' => $request->namakategori
        ]);

        return redirect()->route('adminallkategori')->with('message','Tambah Produk Berhasil!');
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('adminallkategori')->with('message', 'Hapus Kategori Berhasil');
    }
    public function EditCategory($id_categories){
        $category_info = Category::findOrFail($id_categories);
        return view('admin.categori.editcategori', compact('category_info'));
    }

    public function UpdateCategory(Request $request){
        $id_categories = $request->id_categories;

        $request->validate([
            'name_categories' => 'required|unique:categories'
        ]);

        Category::findOrFail($id_categories)->update([
            'name_categories' => $request->name_categories,
        ]);

        return redirect()->route('adminallkategori')->with('message','Categories Update Succesfullly!');

    }
}
