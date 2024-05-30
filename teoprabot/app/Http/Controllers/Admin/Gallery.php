<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery as ModelsGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gallery extends Controller
{
    public function index(){
        $galery = ModelsGallery::latest()->get();

        return view('admin.gallery.index', compact('galery'));
    }

    public function storeGallery(Request $request)
    {
        $user_id = Auth::id();
        // Validate the request
        $request->validate([
            'name' => 'required|unique:categories,name_categories|regex:/^[A-Z][a-zA-Z\s]*$/',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ], [
            'name.required' => 'Nama gallery wajib diisi.',
            'name.unique' => 'Nama gallery sudah digunakan.',
            'name.regex' => 'Nama gallery harus diawali dengan huruf besar dan hanya boleh berisi huruf dan spasi.'
        ]);

        // Handle the image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $image_name);
            $image_url = 'uploads/gallery/' . $image_name;

            // Insert the new gallery into the database
            ModelsGallery::insert([
                'user_id' => $user_id,
                'name' => $request->name,
                'image' => $image_url
            ]);

            // Redirect with success message
            return redirect()->route('semua-gallery')->with('message', 'Tambah Kategori Berhasil!');
        }
    }

    public function editgallery($id){
        $gallerydetil = ModelsGallery::findOrFail($id);
        return view('admin.gallery.edit',compact('gallerydetil'));
    }

    public function Deletegallery($id){
        $gallery = ModelsGallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('semua-gallery')->with('message', 'Hapus Kategori Berhasil');
    }
}
