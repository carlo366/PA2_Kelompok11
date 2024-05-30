<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nameproduct',
        'nama',
        'phonenumber',
        'kondisi',
        'deskripsi',
        'zip',
        'provinsi',
        'kategory',
        'Kabupaten',
        'kecamatan',
        'desa',
        'alamat',
        'price',
        'hargadasar',
        'status'
    ];


    protected $primaryKey = 'id';

    protected $table = 'juals';


    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function jualimages()
    {
        return $this->hasMany(jual_image::class, 'jualid');
    }

    public function kategorys(){
        return $this->belongsTo(Category::class, 'id_categories');
    }
}
