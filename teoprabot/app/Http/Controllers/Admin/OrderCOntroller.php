<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\tradeinsimage;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderCOntroller extends Controller
{
    public function index(){
        $order = Order::latest()->get();
        $orderpackaging = Order::where('status', 'packaging')->latest()->get();
        return view('admin.order.index',compact('order','orderpackaging'));
    }

    public function detilpemesanan($id){
        $productImage = tradeinsimage::latest()->get();
        $order = Order::findOrFail($id);
        return view('admin.order.detilpemesanan',compact('order','productImage'));
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


public function showChart(Request $request)
{
    $selectedYear = $request->input('year', date('Y'));
    $ordersData = Order::totalPriceByMonth($selectedYear);
    return view('admin.statistik.index', compact('ordersData', 'selectedYear'));
}

public function approveorder(Request $request, $id)
{
    // Find the trade-in record by ID and update it
    $jual = Order::findOrFail($id);
    $jual->update([
        'status' => 'terima', // Update the status to "diterima"
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');

}


public function rejectjual(Request $request, $id)
{
    // Find the trade-in record by ID and update it
    $jual = Order::findOrFail($id);
    $jual->update([
        'status' => 'tolak', // Update the status to "diterima"
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');

}

public function batalorder(Request $request, $id)
{
    // Find the trade-in record by ID and update it
    $jual = Order::findOrFail($id);
    $jual->update([
        'status' => 'proses', // Update the status to "diterima"
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Tawaran berhasil disetujui tanpa harga');

}

}
