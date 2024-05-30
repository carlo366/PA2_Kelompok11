<?php

namespace App\Listeners;

use App\Events\OrderDelivered;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOrderDelivered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderDelivered  $event
     * @return void
     */
    public function handle(OrderDelivered $event)
    {
        $order = $event->order;
        $admin = User::where('role', 'admin')->first();//dari event dan mencari admin pertama yang memiliki peran (role) "admin" di database pengguna (user).

        // Buat notifikasi
        //kita membuat notifikasi pesanan (OrderNotification) menggunakan pesanan tersebut.
        $notification = new OrderNotification($order);

        // Kirim notifikasi ke admin
        //notifikasi dikirim ke admin melalui metode notify pada objek admin.
        $admin->notify($notification);
    }

}
