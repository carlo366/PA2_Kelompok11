<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\jual as ModelsJual;
use App\Models\jual_image;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session as FacadesSession;

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

    public function jualbarang(Request $request)
    {
        $validatedData = $request->validate([
            'nameproduct' => 'required|string',
            'kategory' => 'required|string',
            'nama' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:13',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string',
            'zip' => 'required|string',
            'provinsi' => 'required|string',
            'Kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'alamat' => 'required|string',
            'penentuprice' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Log validated data
        dd($validatedData);

        $jual = new ModelsJual();
        $jual->user_id = auth()->id();
        $jual->nameproduct = $validatedData['nameproduct'];
        $jual->kategory = $validatedData['kategory'];
        $jual->nama = $validatedData['nama'];
        $jual->phonenumber = $validatedData['phonenumber'];
        $jual->kondisi = $validatedData['kondisi'];
        $jual->deskripsi = $validatedData['deskripsi'];
        $jual->zip = $validatedData['zip'];
        $jual->provinsi = $validatedData['provinsi'];
        $jual->Kabupaten = $validatedData['Kabupaten'];
        $jual->kecamatan = $validatedData['kecamatan'];
        $jual->desa = $validatedData['desa'];
        $jual->alamat = $validatedData['alamat'];
        $jual->penentuprice = $validatedData['penentuprice'];
        $jual->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/jual', $filename, 'public');

                $jual_image = new jual_image();
                $jual_image->jualid = $jual->id;
                $jual_image->image = $path;
                $jual_image->save();
            }
        }

        return redirect()->route('about')->with('success', 'Barang berhasil dijual');
    }


}
