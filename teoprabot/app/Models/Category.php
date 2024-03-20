<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_categories'
    ];
    protected $table = 'categories';
    protected $primaryKey = 'id_categories';

}
