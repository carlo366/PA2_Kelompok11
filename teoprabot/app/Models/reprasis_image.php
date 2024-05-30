<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reprasis_image extends Model
{
    use HasFactory;
    protected $table ='reprasis_images';

    protected $fillable = [
       'reprasiid',
        'image',
    ];

    public function reprasi()
    {
        return $this->belongsTo(Reprasi::class, 'id');
    }
}
