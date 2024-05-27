<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reprasi as ModelsReprasi;

class reprasi extends Controller
{

    public function index(){
        $reprasi = ModelsReprasi::latest()->get();
        return view('admin.reprasi.index',compact('reprasi'));
    }
}
