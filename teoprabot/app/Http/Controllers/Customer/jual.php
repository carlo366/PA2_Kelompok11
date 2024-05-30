<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\jual as ModelsJual;
use App\Models\jual_image;
use App\Models\Province;
use App\Models\Regency;
use App\Models\tradeinsimage;
use App\Models\Village;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
use PhpParser\Node\Stmt\Return_;

class jual extends Controller
{
    public function jualcategory() {
        $category = Category::latest()->get();
        $selectedCategory = FacadesSession::get('selectedCategory');
        return view('costumers.jualcategory', compact('category', 'selectedCategory'));
    }

    public function saveCategory(Request $request) {
        $selectedCategoryId = $request->input('merek');
        FacadesSession::put('selectedCategory', $selectedCategoryId);
        return redirect()->route('jual');
    }

    public function jual() {
        $selectedCategoryId = FacadesSession::get('selectedCategory');
        $selectedCategory = null;

        if ($selectedCategoryId) {
            $selectedCategory = Category::find($selectedCategoryId);
        }

        $provinces = Province::where('name', 'SUMATERA UTARA')->first();

        return view('costumers.jual', compact('selectedCategory', 'provinces'));
    }

    public function getkabupatens(Request $request){
        $id_provinsi = $request->id_provinsi;

        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        return response()->json($kabupatens);
    }

    public function getkecamatans(Request $request){
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id', $id_kabupaten)->get();

        return response()->json($kecamatans);
    }

    public function getdesas(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $desas = Village::where('district_id', $id_kecamatan)->get();

        return response()->json($desas);
    }

    public function jualbarangs(Request $request)
    {

       $userid = Auth::id();

       $phonenumber = $request->input('phonenumber');
       $provinsi = $request->input('provinsi');
       $Kabupaten = $request->input('Kabupaten');
       $kecamatan = $request->input('kecamatan');
       $desa = $request->input('desa');
       $nama = $request->input('nama');
       $alamat = $request->input('alamat');
       $zip = $request->input('zip');
    //    $kategory = $request->input('kategory');
       $nameproduct = $request->input('nameproduct');

       $validatedData = $request->validate([
        'kondisi' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'deskripsi' => 'required|string',
        'hargadasar' => 'required',
        'kategory' => 'required|string',
    ]);

    $jual = new ModelsJual();
    $jual->nama = $nama;
    $jual->user_id = $userid;
    $jual->kondisi = $validatedData['kondisi'];
    $jual->deskripsi = $validatedData['deskripsi'];
    $jual->hargadasar = $validatedData['hargadasar'];
    $jual->phonenumber = $phonenumber;
    $jual->zip = $zip;
    $jual->provinsi = $provinsi;
    $jual->Kabupaten = $Kabupaten;
    $jual->kecamatan = $kecamatan;
    $jual->desa = $desa;
    $jual->alamat = $alamat;
    $jual->kategory = $validatedData['kategory'];
    $jual->nameproduct = $nameproduct;
    $jual->save();

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $path = 'uploads/jual/'; // Direktori penyimpanan gambar
            $file->move($path, $filename);

            // Simpan data gambar ke dalam tabel tradeinsimages
            $jualImage = new jual_image();
            $jualImage->jualid = $jual->id;
            $jualImage->image = $path . $filename;
            $jualImage->save();
        }
    }


       return redirect()->route('dashboard');



    }

    public function semuajual(){
        $userid = Auth::id();
        $jual = ModelsJual::where('user_id', $userid)->latest()->get();

        return view('costumers.indexjual', compact('jual'));
    }

    public function DetilJual($id){
        $detiljual = ModelsJual::findOrFail($id);
        $productImage = jual_image::where('jualid',$id)->latest()->get();
        return view('costumers.detiljual', compact('detiljual','productImage'));
    }

    public function tawaran(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id' => 'required|exists:juals,id',
            'hargadasar' => 'required|numeric|min:0',
        ]);

        try {
            // Cari record jual berdasarkan ID
            $jual = ModelsJual::findOrFail($request->id);

            // Pengecekan harga tawaran tidak boleh lebih tinggi dari harga jual
            if ($request->hargadasar > $jual->price) {
                return redirect()->back()->with('error', 'Harga tawaran tidak boleh lebih tinggi dari harga jual');
            }

            // Update field 'hargadasar'
            $jual->hargadasar = $request->hargadasar;
            $jual->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Tawaran berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani potensi error
            Log::error('Error: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tawaran');
        }
    }

    public function setujuu(Request $request)
    {
        // Validasi input data
        $request->validate([
            'id' => 'required|exists:juals,id',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            // Cari record jual berdasarkan ID
            $jual = ModelsJual::findOrFail($request->id);

            // Update field 'price' dan 'status'
            $jual->price = $request->price;
            $jual->status = 'terima';  // Mengubah status menjadi 'terima'
            $jual->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Harga berhasil disetujui dan status diubah menjadi terima');
        } catch (\Exception $e) {
            // Tangani potensi error
            Log::error('Error: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui harga');
        }
    }



}
