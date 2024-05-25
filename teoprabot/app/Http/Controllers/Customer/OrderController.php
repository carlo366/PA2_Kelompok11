<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pesan(){
        $userid = Auth::id();
        $order = Order::where('user_id', $userid)->latest()->get();






// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-IZMKh_Bg-lQM56F-42izTSA6';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => 1,
    ),
    'item_details' => array(
        [
            'id'=> 'a01',
            'price'=> 2,
            'quantity'=> 1,
            'name'=> 'Apple'
        ],
        [
            "id"=> "b02",
            "price"=> 3,
            "quantity"=> 2,
            "name"=> "Orange"
        ]
    ),
    'customer_details' => array(
        'first_name' => 'budi',
        'last_name' => 'pratama',
        'email' => 'budi.pra@example.com',
        'phone' => '08111222333',
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('costumers.layouts.pemesanan.semuapesanan',compact('order'),['snap_token' => $snapToken]);
    }

    public function payment_post(Request $request){
        return $request;
    }

}
