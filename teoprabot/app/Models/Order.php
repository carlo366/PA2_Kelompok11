<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_nama',
        'user_id',
        'product_img',
        'nama',
        'phonenumber',
        'zip',
        'provinsi',
        'Kabupaten',
        'kecamatan',
        'alamat',
        'request',
        'desa',
        'address',
        'quantity',
        'totalprice',
        'statuspembayaran',
        'komentar',
        'kodeorder',
        'metode',
        'status',
        'price',

    ];

    protected $primaryKey = 'id_orders';


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->kodeorder = self::generateOrderCode();
        });
    }

    private static function generateOrderCode()
    {
        $latestOrder = self::latest('id_orders')->first();
        $nextNumber = $latestOrder ? ((int) substr($latestOrder->kodeorder, 3)) + 1 : 1;
        return 'ord' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    // Relasi ke Regency
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'Kabupaten');
    }

    // Relasi ke District
    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    // Relasi ke Village
    public function village()
    {
        return $this->belongsTo(Village::class, 'desa');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
