<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_categories',
        'name_categories'
    ];
    protected $table = 'categories';
    protected $primaryKey = 'id_categories';


    public function tradeins()
    {
        return $this->belongsToMany(tradeins::class, 'tradeins_categories', 'category_id', 'tradeins_id');
    }
}
