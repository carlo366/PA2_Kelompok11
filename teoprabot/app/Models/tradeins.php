<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tradeins extends Model
{
    use HasFactory;

    protected $fillable = ['name',
    'user_id', 'kondisi', 'deskripsi', 'price', 'status'];

    protected $casts = [
        'name' => 'json'
    ];

    protected $tables = 'tradeins';

    protected $primaryKey = 'id';
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tradeins_categories', 'tradeinsid', 'category_id');
    }

    public function tradeimages()
    {
        return $this->hasMany(TradeinsImage::class, 'tradeins_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }





}
