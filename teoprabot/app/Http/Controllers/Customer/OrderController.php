<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\tradeinsimage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pesan(){
        $userid = Auth::id();
        $order = Order::where('user_id', $userid)->latest()->get();






// // Set your Merchant Server Key
// \Midtrans\Config::$serverKey = 'SB-Mid-server-IZMKh_Bg-lQM56F-42izTSA6';
// // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
// \Midtrans\Config::$isProduction = false;
// // Set sanitization on (default)
// \Midtrans\Config::$isSanitized = true;
// // Set 3DS transaction for credit card to true
// \Midtrans\Config::$is3ds = true;

// $params = array(
//     'transaction_details' => array(
//         'order_id' => rand(),
//         'gross_amount' => 1,
//     ),
//     'item_details' => array(
//         [
//             'id'=> 'a01',
//             'price'=> 2,
//             'quantity'=> 1,
//             'name'=> 'Apple'
//         ],
//         [
//             "id"=> "b02",
//             "price"=> 3,
//             "quantity"=> 2,
//             "name"=> "Orange"
//         ]
//     ),
//     'customer_details' => array(
//         'first_name' => 'budi',
//         'last_name' => 'pratama',
//         'email' => 'budi.pra@example.com',
//         'phone' => '08111222333',
//     ),
// );

// $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('costumers.layouts.pemesanan.semuapesanan',compact('order'));
    }

    // public function payment_post(Request $request){
    //     return $request;
    // }


    public function detilpemesanan($id_orders){
        $detilpemesanan = Order::findOrFail($id_orders);
        $productImage = tradeinsimage::latest()->get();
        return view('costumers.layouts.pemesanan.detilpemesanan',compact('detilpemesanan','productImage'));
    }
    public function uploadBayar(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        if ($request->hasFile('img_bayar')) {
            $image = $request->file('img_bayar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bayar'), $imageName);

            // Update the order record with the image path
            $order->img_bayar = 'uploads/bayar/' . $imageName; // Perbaikan path penyimpanan gambar
            $order->save();

            return redirect()->back()->with('message', 'Bukti Pembayaran Berhasil Dikirim');
        }

        return redirect()->back()->with('error', 'kirim bukti pembayaran');
    }

    public function delete($id)
{
    // Find the order record
    $order = Order::findOrFail($id);

    // Delete the image from storage
    Storage::delete($order->img_bayar);

    // Update the order record with a null value for the image
    $order->img_bayar = null;
    $order->save();

    // Redirect or return a response as needed
    return redirect()->back()->with('message', 'Berhasil Menghapus Bukti Pembayaran');
}

public function mengirim(){
    return view('costumers.layouts.pemesanan.mengirim');
}

public function updateTanggalAntar(Request $request, $id_orders)
{
    $request->validate([
        'tanggalantar' => 'required|date|after:today',
    ]);

    $order = Order::findOrFail($id_orders);
    $order->tanggalantar = $request->input('tanggalantar');
    $order->status = 'sedangperjalan'; // Mengatur status menjadi "sedang perjalanan"
    $order->save();

    return redirect()->back()->with('success', 'Tanggal antar berhasil ditambahkan.');
}

public function diterima(Request $request, $id)
{
    // Find the order record
    $order = Order::findOrFail($id);

    // Delete the image from storage
    Storage::delete($order->status);

    // Update the order record with a null value for the image
    $order->status = 'terima';

    // Set tanggalsampai to current date and time
    $order->tanggalsampai = Carbon::now();

    $order->save();
}

public function beriUlasan(Request $request, $id)
{
    $request->validate([
        'komentar' => 'required|string',
    ]);

    $order = Order::findOrFail($id);
    $order->komentar = $request->input('komentar');
    $order->save();

    return redirect()->back()->with('success', 'Ulasan berhasil diberikan.');
}
}
