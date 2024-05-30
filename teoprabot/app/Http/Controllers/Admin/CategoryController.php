<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $admin = Auth::user();

        $order = Order::get();
        // foreach ($order as $item) {
        //     $notif = $admin->notifications()->where('data->id',$item->id)->first();
        //     if(!$notif){
        //         $save = new OrderNotification($item);
        //         $admin->notify($save);
        //     }
        // }
        return view('admin.categori.allcategori', compact('categories'));
    }

    public function storeKategori(Request $request)
    {
        $user_id = Auth::id();
        // Validate the request
        $request->validate([
            'namakategori' => 'required|unique:categories,name_categories|regex:/^[A-Z][a-zA-Z\s]*$/',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ], [
            'namakategori.required' => 'Nama kategori wajib diisi.',
            'namakategori.unique' => 'Nama kategori sudah digunakan.',
            'namakategori.regex' => 'Nama kategori harus diawali dengan huruf besar dan hanya boleh berisi huruf dan spasi.'
        ]);

        // Handle the image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $image_name);
            $image_url = 'uploads/category/' . $image_name;

            // Insert the new category into the database
            Category::insert([
                'user_id' => $user_id,
                'name_categories' => $request->namakategori,
                'image' => $image_url
            ]);

            // Redirect with success message
            return redirect()->route('adminallkategori')->with('message', 'Tambah Kategori Berhasil!');
        }
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

    public function UpdateCategory(Request $request)
    {
        $id_categoriess = $request->id_categories;

        $request->validate([
            'name_categories' =>'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id_categoriess);

        // Update the name
        $category->name_categories = $request->input('name_categories');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the specified directory
            $image->move(public_path('uploads/category'), $image_name);

            // Delete the old image if it exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            // Update the image URL in the category model
            $category->image = 'uploads/category/' . $image_name;
        }


        // Save the updated category
        $category->save();

        return redirect()->route('adminallkategori')->with('message', 'Category updated successfully!');
    }




}
