<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tradeinsimage extends Model
{
    use HasFactory;


    protected $fillable = ['trendinsid', 'image'];
    public function tradein()
    {
        return $this->belongsTo(tradeins::class, 'tradeins_id');
    }
}
