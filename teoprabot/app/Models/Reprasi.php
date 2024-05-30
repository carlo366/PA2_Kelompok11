<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reprasi extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'user_id',
        'kondisi',
        'nameproduct',
        'deskripsi',
        'price',
        'status',
        'kategory',
        'phonenumber',
        'zip',
        'provinsi',
        'Kabupaten',
        'kecamatan',
        'desa',
        'alamat',
        'request',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'Kabupaten');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'desa');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategory', 'id_categories');
    }
}
