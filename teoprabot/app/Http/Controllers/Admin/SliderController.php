<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $slider = Slider::latest()->get();
        return view('admin.slider.index', compact('slider'));
    }

    public function storeslider(Request $request)
    {
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

        // Handle the image file
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $image_name);
            $image_url = 'uploads/slider/' . $image_name;

            // Insert the new slider into the database
            Slider::create([
                'name' => $request->name,
                'gambar' => $image_url
            ]);

            // Redirect with success message
            return redirect()->route('semua-slider')->with('message', 'Tambah Slider Berhasil!');
        }
    }
}
