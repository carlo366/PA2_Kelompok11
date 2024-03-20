<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:costumer', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('users.dasboard');
    })->name('dashboard');
});

// Route::middleware(['auth','role:admin','verified'])->group(function () {
    Route::get('/dasboard-admin',function () {
        return view('admin.dasboard');
    })->name('admindasboard');
    Route::get('admin/semua-produk',function(){
        return view('admin.produk.allproduk');
    })->name('adminallproduk');
    Route::controller(CategoryController::class)->group(function(){
        Route::get('admin/semua-kategori','index')->name('adminallkategori');
        Route::post('admin/store-kategori','StoreKategori')->name('storekategori');
        Route::get('admin/delete-kategori/{id_categories}','DeleteCategory')->name('deletecategori');
        Route::post('admin/update-kategori','UpdateCategory')->name('updatecategory');
        Route::get('admin/edit-kategori/{id_categories}','EditCategory')->name('editcategory');
        Route::post('admin/update-kategori','UpdateCategory')->name('updatecategory');
    });

    Route::controller(ProductsController::class)->group(function(){
        Route::get('admin/semua-produk','index')->name('adminallproduk');
        Route::get('admin/tambah_gambar/{id_product}/kirim','indexgambar')->name('indexgambar');
        Route::post('admin/tambah_gambar/{id_product}/kirim','StoreGambar')->name('storegambar');
        Route::get('/admin/delete/{images_id}/hapus','HapusGambar')->name('hapusgambar');
    });

// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
