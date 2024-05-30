<?php

namespace App\Models;

use App\Http\Controllers\Admin\Tradeins;
use App\Models\tradeins as ModelsTradeins;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory,Notifiable;

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
        'tradeinsid',
        'tanggalsampai',
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
    public function tradein()
    {
        return $this->belongsTo(ModelsTradeins::class, 'tradeinsid');
    }


    	/**
	 * @return mixed
	 */
	public function getFillable() {
		return $this->fillable;
	}

	/**
	 * @param mixed $fillable
	 * @return self
	 */
	public function setFillable($fillable): self {
		$this->fillable = $fillable;
		return $this;
	}

    public static function totalPriceByMonth($selectedYear)
    {     $months = range(1, 12);

        $orderData = self::select(
            DB::raw('MONTH(tanggalsampai) as month'),
            DB::raw('SUM(totalprice) as total_price')
        )
        ->whereYear('tanggalsampai', $selectedYear)
        ->groupBy(DB::raw('MONTH(tanggalsampai)'))
        ->orderBy(DB::raw('MONTH(tanggalsampai)'))
        ->get()
        ->keyBy('month')
        ->toArray();

        $result = [];
        foreach ($months as $month) {
            $result[] = [
                'month' => $month,
                'total_price' => isset($orderData[$month]) ? $orderData[$month]['total_price'] : 0
            ];
        }

        return $result;
    }
}
