<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tradeins as ModelsTradeins;
use App\Models\tradeins_category;
use App\Models\tradeinsimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Tradeins extends Controller
{
    public function index(){
        $trade = ModelsTradeins::get();

        return view('admin.tradeins.index',compact('trade'));
    }
    public function detil($id){
        $trade = ModelsTradeins::FindOrFail($id);
        $productImage = tradeinsimage::where('trendinsid',$id)->latest()->get();
        $tredca = tradeins_category::latest()->get();
        return view('admin.tradeins.detil', compact('trade','productImage','tredca'));
    }

    public function tawaran(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0', // Added validation for numeric and minimum value
        ]);

        $tradein = ModelsTradeins::findOrFail($id);
        $tradein->update([
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Tawaran berhasil di tambahkan');
    }

    public function setujunoprice(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        // Find the trade-in record by ID and update it
        $tradein = ModelsTradeins::findOrFail($id);
        $tradein->update([
            'price' => $request->price,
            'status' => 'terima', // Update the status to "diterima"
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');
    }

    public function setuju(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        // Find the trade-in record by ID and update it
        $tradein = ModelsTradeins::findOrFail($id);
        $tradein->update([
            'status' => 'terima', // Update the status to "diterima"
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');
    }
    public function reject(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsTradeins::findOrFail($id);
        $tradein->update([
            'status' => 'tolak', // Perbarui status menjadi "tolak"
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Tawaran berhasil ditolak.');
    }

    public function batal(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsTradeins::findOrFail($id);
        $tradein->update([
            'status' => null, // Perbarui status menjadi null
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tawaran berhasil dibatalkan.');
    }

    public function tawarantrade(Request $request)
    {
       // Validasi data input
   $request->validate([
    'id' => 'required|exists:tradeins,id',
    'price' => 'required|numeric|min:0',
]);

try {
    // Cari record trade-in berdasarkan ID
    $tradein = ModelsTradeins::findOrFail($request->id);

    // Update field 'price'
    $tradein->price = $request->price;
    $tradein->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Tawaran berhasil ditambahkan');
} catch (\Exception $e) {
    // Tangani potensi error
    return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tawaran');
}
    }




}
