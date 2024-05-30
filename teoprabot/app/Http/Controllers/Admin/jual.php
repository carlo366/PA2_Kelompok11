<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\jual as ModelsJual;
use App\Models\jual_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class jual extends Controller
{
    public function index(){
        $jual = ModelsJual::latest()->get();
        return view('admin.jual.index',compact('jual'));
    }

    public function detiljual($id){
        $detiljual  = ModelsJual::findOrFail($id);
        $jualImage = jual_image::where('jualid',$id)->latest()->get();
        return view('admin.jual.detiljual',compact('detiljual','jualImage'));
    }
    public function batal(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $jual = ModelsJual::findOrFail($id);
        $jual->update([
            'status' => null, // Perbarui status menjadi null
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status tawaran berhasil dibatalkan.');
    }

    public function rejectjual(Request $request, $id)
    {
        // Temukan record trade-in berdasarkan ID dan perbarui statusnya
        $tradein = ModelsJual::findOrFail($id);
        $tradein->update([
            'status' => 'tolak', // Perbarui status menjadi "tolak"
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Tawaran berhasil ditolak.');
    }


    public function tawaran(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id' => 'required|exists:juals,id',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            // Cari record jual berdasarkan ID
            $jual = ModelsJual::findOrFail($request->id);

            // Pengecekan harga tawaran tidak boleh lebih tinggi dari harga jual
            if ($request->price > $jual->hargadasar) {
                return redirect()->back()->with('error', 'Harga tawaran tidak boleh lebih tinggi dari harga jual');
            }

            // Update field 'hargadasar'
            $jual->price = $request->price;
            $jual->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Tawaran berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani potensi error
            Log::error('Error: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tawaran');
        }
    }
    public function approvejual(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        // Find the trade-in record by ID and update it
        $jual = ModelsJual::findOrFail($id);
        $jual->update([
            'price' => $request->price,
            'status' => 'terima', // Update the status to "diterima"
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');


}}
