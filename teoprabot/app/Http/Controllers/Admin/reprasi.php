<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\jual;
use App\Models\jual_image;
use Illuminate\Http\Request;
use App\Models\Reprasi as ModelsReprasi;
use App\Models\reprasis_image;
use App\Models\tradeins;

class reprasi extends Controller
{

    public function index(){
        $reprasi = ModelsReprasi::latest()->get();
        return view('admin.reprasi.index',compact('reprasi'));
    }
    public function detilreprasi($id){
        $detilreprasi = ModelsReprasi::findOrFail($id);
        $productImage = reprasis_image::where('reprasiid',$id)->latest()->get();
        return view('admin.reprasi.detil',compact('detilreprasi','productImage'));

}

public function approvereq(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsReprasi::findOrFail($id);
        $tradein->update([
            'status' => 'terima', // Perbarui status menjadi null
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tawaran berhasil dibatalkan.');
    }

    public function batalreprasi(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsReprasi::findOrFail($id);
        $tradein->update([
            'status' => null, // Perbarui status menjadi null
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tawaran berhasil dibatalkan.');
    }


    public function rejectreq(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsReprasi::findOrFail($id);
        $tradein->update([
            'status' => 'tolak', // Perbarui status menjadi null
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tawaran berhasil dibatalkan.');
    }



}
