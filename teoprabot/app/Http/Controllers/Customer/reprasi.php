<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Reprasi as ModelsReprasi;
use App\Models\Village;
use Illuminate\Http\Request;

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
}
