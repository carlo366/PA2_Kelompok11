<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Gallery;
use App\Http\Controllers\Admin\jual as AdminJual;
use App\Http\Controllers\Admin\OrderCOntroller as AdminOrderCOntroller;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\reprasi as AdminReprasi;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Tradeins as AdminTradeins;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\Customer\CartsController as CustomerCartsController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\jual;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\reprasi;
use App\Http\Controllers\ProfileController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependentDropdownController;
use App\Models\Slider;
use App\Models\tradeins;
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
        Route::post('/getkabupaten','getkabupaten')->name('getkabupaten');
        Route::post('/getkecamatan','getkecamatan')->name('getkecamatan');
        Route::post('/getdesa','getdesa')->name('getdesa');
        Route::post('/place-order','PlaceOrder')->name('placeorder');
        Route::post('/trandins','tradeins')->name('tradeins');
        Route::get('/students/json', 'trandeins')->name('trandeins');
        Route::post('/user-profile/dashboard/updateprofil','updateprofile')->name('updateprofile');
        Route::post('customer/tawaran','tawarancustom')->name('tawarancustom');
        Route::post('customer/tawaran/approve','setujuu')->name('setujuu');

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
        Route::get('customer/order/detil-pemesanan/{id}','detilpemesanan')->name('detilpemesanan');
        Route::post('/customer/order/bayar/{id}','uploadbayar')->name('uploadbayar');
        Route::get('/payment/{id}/delete', 'delete')->name('deletePayment');
        Route::get('customer/order/hapuspemesanan/{id}', 'hapuspemesanan')->name('hapuspemesanan');
        Route::get('admin/order/mengirim','mengirim')->name('mengirim');
        Route::get('customer/order/diterima/{id}','diterima')->name('diterima');
        Route::post('/beri-ulasan/{id}', 'beriUlasan')->name('beri.ulasan');
        Route::get('customer/order/jadwal','jadwal')->name('jadwal');
        Route::get('customer/order/history/{id}', 'history')->name('history');
        Route::put('admin/orders/{id_orders}/tanggalantar', 'updateTanggalAntar')->name('updateTanggalAntar');

        // Route::get('/akun/profile/pengaturanpassword','profilpassword')->name('profilpassword');
      });

      Route::controller(jual::class)->group(function(){
  Route::get('customer/jual', 'jual')->name('jual');
    Route::get('customer/jualcategory', 'jualcategory')->name('jualcategory');
    Route::post('customer/saveCategory', 'saveCategory')->name('saveCategory');
    Route::post('/getkabupatens', 'getkabupatens')->name('getkabupatens');
    Route::post('/getkecamatans', 'getkecamatans')->name('getkecamatans');
    Route::post('/getdesas', 'getdesas')->name('getdesas');
    Route::post('/customer/jualbarang','jualbarangs')->name('jualbarangs');
    Route::get('/customer/semuajual','semuajual')->name('indexjual');
    Route::get('/customer/detil-jual/{id}','DetilJual')->name('jual.show');

    Route::get('delete/jual/{id}','delete')->name('deletejual');
    Route::post('customer/tawaranjual','tawaran')->name('tawaranjual');
    Route::post('customer/tawaranjual/approve','setujuu')->name('setujujual');

      });

      Route::controller(reprasi::class)->group(function(){
        route::get('customer/perbaiki','perbaiki')->name('perbaiki');
        Route::post('/getkabupatenss', 'getkabupatenss')->name('getkabupatenss');
        Route::post('/getkecamatanss', 'getkecamatanss')->name('getkecamatanss');
        Route::post('/getdesass', 'getdesass')->name('getdesass');
        Route::post('/customer/reprasibarang','reprasibarang')->name('repraibarangs');
        Route::get('/customer/semuareprasi','semuareprasi')->name('indexreprasi');
        Route::get('/customer/detil-reprasi/{id}','Detilreprasi')->name('reprasi.show');

      });


// });




Route::middleware(['auth','role:admin','verified'])->group(function () {
    Route::get('/dasboard-admin',function () {

        return view('admin.dasboard');
    })->name('admindasboard');
    Route::get('admin/semua-produk',function(){
        return view('admin.produk.allproduk');
    })->name('adminallproduk');
    Route::controller(CategoryController::class)->group(function(){
        Route::get('admin/semua-kategori','index')->name('adminallkategori');
        Route::post('admin/store-kategori','StoreKategori')->name('storekategori');
        Route::post('admin/update-kategori','UpdateCategory')->name('updatecategory');
        Route::get('admin/edit-kategori/{id_categories}','EditCategory')->name('editcategory');
        Route::get('admin/delete-kategori/{id_categories}','DeleteCategory')->name('deletecategori');


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
        Route::get('admin/edit-gallery/{id}','editgallery')->name('editgallery');
        Route::post('admin/update-gallery','Updategallery')->name('updategallery');
        Route::get('admin/delete-gallery/{id}','Deletegallery')->name('deletegallery');
    });

    Route::controller(SliderController::class)->group(function(){
        Route::get('admin/semua-slider','index')->name('semua-slider');
        Route::post('admin/tambah-slider','storeslider')->name('storeslider');
        Route::post('admin/update-slider','Updateslider')->name('updateslider');
        Route::get('admin/edit-slider/{id}','Editslider')->name('editslider');
        Route::get('admin/delete-slider/{id}','Deleteslider')->name('deleteslider');
    });

    Route::controller(AdminTradeins::class)->group(function(){
     Route::get('admin/semua-tradeins','index')->name('semua-tradeins');
     Route::get('admin/detil-tradeins/{id}','detil')->name('detil-tradeins');
     Route::post('admin/tawaran/{id}','tawaran')->name('tawaran');
     Route::post('admin/tawaran/approve/{id}','setuju')->name('setuju');
     Route::post('admin/tawaran/approvenoprice/{id}','setujunoprice')->name('setujunoprice');
     Route::post('admin/tawaran/reject/{id}','reject')->name('reject');
     Route::post('admin/tawaran/batal/{id}','batal')->name('batal');
     Route::post('admin/trade','tawarantrade')->name('tawarantrade');

    });

    Route::controller(AdminOrderCOntroller::class)->group(function(){
        Route::get('admin/semua-pemesanan','index')->name('semua-pemesanan');
        Route::get('/admin/detilpemesanan/{id}', 'detilpemesanan')->name('detil-pemesanan');
        Route::post('admin/approvepem/{order_id}','approvepem')->name('approvepem');
        Route::post('admin/rejectpem/{order_id}','rejectpem')->name('rejectpem');
        Route::get('/orders-chart-pdf', 'exportPDF')->name('chart.pdf');
        Route::get('/orders-chart','showChart')->name('chart');
        Route::post('admin/approveorder/{id}','approveorder')->name('approveorder');
        Route::post('admin/rejectorder/{id}','rejectorder')->name('rejectorder');
    });



    Route::controller(AdminJual::class)->group(function(){
        Route::get('admin/semua-jual','index')->name('semuajual');
        Route::post('admin/tawaran/bataljual/{id}','batal')->name('bataljual');
        Route::get('/admin/detiljual/{id}', 'detiljual')->name('detil-jual');
        Route::post('admin/tawaranjual','tawaran')->name('tawaranjualadmin');
        Route::post('admin/approvepe/{id}','approvejual')->name('approvejual');
        Route::post('admin/rejectjual/{id}','rejectjual')->name('rejectjual');
        Route::post('admin/batalorder/{id}','batalorder')->name('batalorder');

    });



    Route::controller(AdminReprasi::class)->group(function(){
        Route::get('admin/semua-reprasi','index')->name('semua-reprasi');
        Route::get('/admin/detilreprasi/{id}', 'detilreprasi')->name('detil-reprasi');
        // Route::post('admin/approvepe/{order_id}','approvepem')->name('approvepem');
        Route::post('admin/batal/{id}','batalreprasi')->name('batalreprasi');
        Route::post('admin/approvereq/{id}','approvereq')->name('approvereq');
        Route::post('admin/rejectreq/{id}','rejectreq')->name('rejectreq');
    });
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
