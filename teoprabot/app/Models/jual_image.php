<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual_image extends Model
{
    use HasFactory;

    protected $fillable = ['jualid', 'image'];

    public function jual()
    {
        return $this->belongsTo(jual::class, 'id');
    }
}
