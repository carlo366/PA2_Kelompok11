<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderCOntroller extends Controller
{
    public function index(){
        $order = Order::latest()->get();
        $orderpackaging = Order::where('status', 'packaging')->latest()->get();
        return view('admin.order.index',compact('order','orderpackaging'));
    }

    public function detilpemesanan($id){
        $order = Order::findOrFail($id);
        return view('admin.order.detilpemesanan',compact('order'));
    }

public function approvepem($order_id)
{
    // Find the order by ID
    $order = Order::find($order_id);

    if ($order) {
        // Update the order status and payment status
        $order->statuspembayaran = 'paid';
        $order->status = 'packaging';
        $order->save();

        return redirect()->back()->with('success', 'Order approved and status updated.');
    } else {
        return redirect()->back()->with('error', 'Order not found.');
    }
}

}
