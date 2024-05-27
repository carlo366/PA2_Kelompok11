<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reprasi extends Model
{
    use HasFactory;

    protected $fillable = ['name',
    'user_id', 'kondisi','nameproduct', 'deskripsi', 'price', 'status'];

}
