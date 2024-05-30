<?php

namespace App\Listeners;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendnotiftoadmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
//menerima event sebagai parameter langsung dalam method handle.
    public function handle($event)
    {
        //ita mencari admin berdasarkan kondisi tertentu, yaitu mencari pesanan (order)
        //yang memiliki nama (name) dengan ID 1.
        // Kemudian, menggunakan fasad Notification, kita mengirim notifikasi pesanan (OrderNotification)
        // kepada admin yang ditemukan.
        $admin = Order::whereHas('name',function($query){
            $query->where('id',1);
        })->get();
        Notification::send($admin,new OrderNotification ($event->order));
    }
}
