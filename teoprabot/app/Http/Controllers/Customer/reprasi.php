<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Reprasi as ModelsReprasi;
use App\Models\reprasis_image;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reprasi extends Controller
{
    public function perbaiki(){
        $kategori = Category::latest()->get();
        $provinces = Province::where('name', 'SUMATERA UTARA')->first();

        return view('costumers.perbaikan',compact('kategori','provinces'));
    }


    public function getkabupatenss(Request $request){
        $id_provinsi = $request->id_provinsi;

        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        return response()->json($kabupatens);
    }

    public function getkecamatanss(Request $request){
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id', $id_kabupaten)->get();

        return response()->json($kecamatans);
    }

    public function getdesass(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $desas = Village::where('district_id', $id_kecamatan)->get();

        return response()->json($desas);
    }

    public function reprasibarang(Request $request){
        $userid = Auth::id();

        $phonenumber = $request->input('phonenumber');
        $provinsi = $request->input('provinsi');
        $Kabupaten = $request->input('Kabupaten');
        $kecamatan = $request->input('kecamatan');
        $desa = $request->input('desa');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $kategory = $request->input('kategory');
        $zip = $request->input('zip');
        $kategory = $request->input('kategory');
        $nameproduct = $request->input('nameproduct');

        $validatedData = $request->validate([
         'kondisi' => 'required|string',
         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
         'deskripsi' => 'required|string',
         'request' => 'required|string',

     ]);

     $reprasi = new ModelsReprasi();
     $reprasi->nama = $nama;
     $reprasi->user_id = $userid;
     $reprasi->kondisi = $validatedData['kondisi'];
     $reprasi->deskripsi = $validatedData['deskripsi'];
     $reprasi->phonenumber = $phonenumber;
     $reprasi->zip = $zip;
     $reprasi->provinsi = $provinsi;
     $reprasi->Kabupaten = $Kabupaten;
     $reprasi->kecamatan = $kecamatan;
     $reprasi->desa = $desa;
     $reprasi->request = $validatedData['request'];
     $reprasi->alamat = $alamat;
     $reprasi->kategory =  $kategory;
     $reprasi->nameproduct = $nameproduct;
     $reprasi->save();

     if ($request->hasFile('images')) {
         foreach ($request->file('images') as $file) {
             $extension = $file->getClientOriginalExtension();
             $filename = time() . '_' . uniqid() . '.' . $extension;
             $path = 'uploads/reprasi/'; // Direktori penyimpanan gambar
             $file->move($path, $filename);

             // Simpan data gambar ke dalam tabel tradeinsimages
             $reprasiImage = new reprasis_image();
             $reprasiImage->reprasiid = $reprasi->id;
             $reprasiImage->image = $path . $filename;
             $reprasiImage->save();
         }
     }


        return redirect()->route('dashboard');
    }

    public function semuareprasi(){
        $reprasi = ModelsReprasi::latest()->get();
        return view('costumers.indexreprasi',compact('reprasi'));
    }

    public function Detilreprasi($id){
        $detilreprasi = ModelsReprasi::findOrFail($id);
        $productImage = reprasis_image::where('reprasiid',$id)->latest()->get();
        return view('costumers.detilreprasi',compact('detilreprasi','productImage'));
    }
}
