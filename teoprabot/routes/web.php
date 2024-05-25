<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Gallery;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\Customer\CartsController as CustomerCartsController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\ProfileController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependentDropdownController;
use App\Models\Slider;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::middleware(['auth', 'role:costumer', 'verified'])->group(function () {
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/produk/category/{id}','CategoryPage')->name('category');
        Route::get('/semua-produk', 'semuaproduk')->name('semuaproduk');
        Route::get('/produk-detil/{id_products}', 'ProdukDetil')->name('produkdetail');
        Route::post('/add-product-to-cart','AddProductToCart')->name('addproducttocart');
        Route::get('/gallery', 'gallery')->name('gallery');
        Route::get('/About', 'about')->name('about');

    });
    Route::controller(CustomerCartsController::class)->group(function(){
        Route::get('/keranjang','keranjang')->name('keranjang');
        Route::get('delete-cart/{id}','deletecart')->name('deletecart');
        Route::get('delete/tradeins/{id}','deletetradeins')->name('deletetradeins');
        Route::get('/cart/bertambah/{id}','incrementQuantity')->name('increment');
        Route::get('/cart/berkurang/{id}', 'decrementQuantity')->name('products.decrement');
        Route::post('/update-quantity','updateQuantity')->name('updateQuantity');
        Route::get('/checkout','checkout')->name('checkout');
        Route::get('/checkout','Checkout')->name('checkout');
        Route::post('/get-regencies','getRegencies')->name('getRegencies');
        Route::post('/getkabupaten','getkabupaten')->name('getkabupaten');
        Route::post('/getkecamatan','getkecamatan')->name('getkecamatan');
        Route::post('/getdesa','getdesa')->name('getdesa');
        Route::post('/place-order','PlaceOrder')->name('placeorder');
        Route::post('/trandins','tradeins')->name('tradeins');
        Route::get('/students/json', 'trandeins')->name('trandeins');
        Route::post('/user-profile/dashboard/updateprofil','updateprofile')->name('updateprofile');

    });
    Route::controller(CustomerProfileController::class)->group(function(){
      Route::get('/akun/profile','profil')->name('profil');
      Route::post('/akun-profile/dashboard/updateprofil','updateprofile')->name('updateprofile');
      Route::get('/akun/profile/pengaturanpassword','profilpassword')->name('profilpassword');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/pemesanan','pesan')->name('pesan');
        Route::get('/bayar','index')->name('index');
        Route::post('/bayar','payment_post')->name('payment_post');
        // Route::get('/akun/profile/pengaturanpassword','profilpassword')->name('profilpassword');
      });

// });




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
        Route::post('admin/tambah_gambar/{id_product}/kirim','StoreGambar')->name('storegambar');
        Route::get('/admin/delete/{images_id}/hapus','HapusGambar')->name('hapusgambar');
        Route::get('admin/tambah_gambar/{id_product}/kirim','indexgambar')->name('indexgambar');
        Route::delete('/admin/delete/{id}/hapus','HapusProduct')->name('hapusproduct');
        Route::get('/admin/view/{id}','viewProduct')->name('viewproduct');
        Route::get('admin/edit-produk/{id}','EditProduk')->name('editproduk');
        Route::post('admin/update-produk','Updateproduk')->name('updateproduk');
        Route::post('admin/tambah-produk','StoreProduct')->name('storeproduk');
    });
    Route::controller(Gallery::class)->group(function(){
        Route::get('admin/semua-gallery','index')->name('semua-gallery');
        Route::post('admin/tambah-gallery','storeGallery')->name('storeGallery');
        Route::get('admin/edit-gallery','editgallery')->name('editgallery');
    });

    Route::controller(SliderController::class)->group(function(){
        Route::get('admin/semua-slider','index')->name('semua-slider');
        Route::post('admin/tambah-slider','storeslider')->name('storeslider');
        Route::get('admin/edit-slider','editslider')->name('editslider');

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
Route::get('cities', 'DependentDropdownController@cities')->name('cities');
Route::get('districts', 'DependentDropdownController@districts')->name('districts');
Route::get('villages', 'DependentDropdownController@villages')->name('villages');

require __DIR__.'/auth.php';
