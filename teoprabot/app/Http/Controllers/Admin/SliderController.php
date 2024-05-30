<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function index(){
        $slider = Slider::latest()->get();
        return view('admin.slider.index', compact('slider'));
    }

    public function storeslider(Request $request)
    {
        $user_id = Auth::id();
        $jumlah_slider = Slider::count();

        // Validasi jumlah slider
        if ($jumlah_slider >= 3) {
            return redirect()->route('semua-slider')->with('error', 'Anda hanya dapat memiliki maksimum tiga slider.');
        }

        $request->validate([
            'name' => 'required|unique:categories,name_categories|regex:/^[A-Z][a-zA-Z\s]*$/',
            'gambar' => 'required|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ], [
            'name.required' => 'Nama slider wajib diisi.',
            'name.unique' => 'Nama slider sudah digunakan.',
            'name.regex' => 'Nama slider harus diawali dengan huruf besar dan hanya boleh berisi huruf dan spasi.',
            'gambar.required' => 'Gambar slider wajib diunggah.',
            'gambar.mimes' => 'Gambar slider harus dalam format PNG, JPG, JPEG, GIF, atau SVG.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $image_name);
            $image_url = 'uploads/slider/' . $image_name;

            // Insert the new slider into the database
            Slider::create([
                'user_id' => $user_id,
                'name' => $request->name,
                'gambar' => $image_url
            ]);

            // Redirect with success message
            return redirect()->route('semua-slider')->with('message', 'Tambah Slider Berhasil!');
        }
    }

    public function Editslider($id){
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function Updateslider(Request $request)
{
    $id = $request->id;

    $request->validate([
        'name' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $slider = Slider::findOrFail($id);

    // Update the name
    $slider->name = $request->input('name');

    // Handle file upload if a new image is uploaded
    if ($request->hasFile('gambar')) {
        $image = $request->file('gambar');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        // Move the uploaded image to the specified directory
        $image->move(public_path('uploads/slider'), $image_name);

        // Delete the old image if it exists
        if ($slider->gambar && file_exists(public_path($slider->gambar))) {
            unlink(public_path($slider->gambar));
        }

        // Update the image URL in the slider model
        $slider->gambar = 'uploads/slider/' . $image_name;
    }

    // Save the updated slider
    $slider->save();

    return redirect()->route('semua-slider')->with('message', 'Slider updated successfully!');
}

public function Deleteslider($id)
{
    $category = Slider::findOrFail($id);
    $category->delete();

    return redirect()->route('semua-slider')->with('message', 'Hapus Kategori Berhasil');
}
}
