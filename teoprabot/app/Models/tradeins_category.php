<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tradeins_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'tradeinsid',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tradein()
    {
        return $this->belongsTo(tradeins::class, 'tradeinsid');
    }
}
