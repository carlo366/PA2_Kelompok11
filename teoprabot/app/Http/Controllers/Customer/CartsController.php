<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Admin\Tradeins as AdminTradeins;
use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Category;
use App\Models\District;
use App\Models\Images_Products;
use App\Models\Order;
use App\Models\Products;
use App\Models\Province;
use App\Models\Regency;
use App\Models\tradeins;
use App\Models\tradeins_category;
use App\Models\tradeinsimage;
use App\Models\Village;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{


    public function keranjang(){
        $userid = Auth::id();
        $carts = Carts::where('user_id', $userid)->get();
        $kategori = Category::latest()->get();
        $names = tradeins::all();

        // foreach ($names as $name){
        //     $nam = $name->name;
        // }
        // $decodename = $nam;
        // $decodedArray = json_decode($decodename);
         $tradein = Tradeins::where('user_id', $userid)->latest()->get();//untuk mengambil semua dari table trednins dengan user id
        // $tradeins = Tradeins::where('user_id', $userid)->latest()->first();//untuk mengirim ke $tredca untuk mengambil dari tabel tredins_category sesuai id category
        $tredca = tradeins_category::latest()->get();


        //mengambil gambar
    $productImage = tradeinsimage::latest()->get();



    // return view('costumers.cart',compact('carts','kategori','decodedArray','tredca','tradein','productImage'));

        return view('costumers.cart',compact('carts','kategori','tradein','productImage','tredca'));
    }
    public function deletecart($id){
       $carts = Carts::findOrFail($id);
       $carts->delete();
     return redirect()->route('keranjang')->with('message', 'Berhasil Dihapus');
    }

    public function deletetradeins($id){
        $tradein = tradeins::findOrFail($id);

        // Hapus kategori yang terkait dengan tradein tertentu
        tradeins_category::where('tradeinsid', $id)->delete();

        // Hapus gambar yang terkait dengan tradein tertentu
        TradeinsImage::where('trendinsid', $id)->delete();

        // Hapus tradein itu sendiri
        $tradein->delete();
        // dd($tradein);
      return redirect()->route('keranjang')->with('message', 'Berhasil Dihapus');
     }

    public function decrementQuantity($id)
    {
        $product = Carts::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($product->quantity > 1) {
            $product->quantity--;
            $product->save();
        } else {
            // Jika jumlah sudah 1, tampilkan konfirmasi sebelum menghapus
            return redirect()->back()->with('confirm', 'Apakah Anda yakin ingin menghapus produk dari keranjang?');
        }

        return redirect()->back();
    }
    public function incrementQuantity($id)
    {
        $cartItem = Carts::find($id);
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product = Products::find($cartItem->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $totalQuantityInCart = Carts::where('product_id', $cartItem->product_id)
            ->where('user_id', $cartItem->user_id)
            ->sum('quantity');

        $availableQuantity = $product->quantity - $totalQuantityInCart;
        if ($totalQuantityInCart >= $product->quantity) {
            return redirect()->back()->with('error', 'Jumlah produk melebihi stok '.$totalQuantityInCart);
        }

        $cartItem->quantity++;
        $cartItem->save();

        return redirect()->back()->with('success', 'Quantity berhasil diincrement.');
    }
public function updateQuantity(Request $request)
{
    $request->validate([
        'cart_id' => 'required|exists:carts,id',
        'new_quantity' => 'required|numeric|min:1',
    ]);

    $cart = Carts::findOrFail($request->cart_id);
    $cart->quantity = $request->new_quantity;
    $cart->save();

    return response()->json(['message' => 'Jumlah berhasil diperbarui'], 200);
}

public function checkout(Request $request){
    $userid = Auth::id();
    $checkedItems = $request->input('ids', []);
    $checkedItemss = $request->input('idt', []);

    if (empty($checkedItems)) {
        return redirect()->back()->with('error', 'Pilih produk sebelum melanjutkan ke checkout.');
    }

    $productImage = tradeinsimage::latest()->get();

    $cart_items = Carts::whereIn('id', $checkedItems)->where('user_id', $userid)->get();
    $tradein_items = tradeins:: whereIn('id', $checkedItemss)->where('user_id', $userid)->get();

    $provinces = Province::where('name', 'SUMATERA UTARA')->first();




        return view('costumers.checkout' ,compact('cart_items','checkedItemss', 'checkedItems','provinces','tradein_items','productImage'));
    }
    public function getkabupaten(Request $request) {
        $id_provinsi = $request->id_provinsi;
        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        $shippingCosts = [
            'KABUPATEN ASAHAN' => 500000,
            'KABUPATEN BATU BARA' => 250000,
           'KABUPATEN DAIRI' => 200000,
           'KABUPATEN DELI SERDANG' => 100000,
                       'KABUPATEN HUMBANG HASUNDUTAN' => 400000,
                       'KABUPATEN KARO' => 100000,
                       'KABUPATEN LABUHAN BATU' => 400000,
                       'KABUPATEN LABUHAN BATU SELATAN' => 600000,
                       'KABUPATEN LABUHAN BATU UTARA' => 400000,
                       'KABUPATEN LANGKAT' => 50000,
                       'KABUPATEN MANDAILING NATAL' => 800000,
                       'KABUPATEN NIAS' => 900000,
                       'KABUPATEN NIAS BARAT' => 1000000,
                       'KABUPATEN NIAS SELATAN' => 1200000,
                       'KABUPATEN NIAS UTARA' => 900000,
                       'KABUPATEN PADANG LAWAS' => 800000,
                       'KABUPATEN PADANG LAWAS UTARA' => 700000,
                       'KABUPATEN PAKPAK BHARAT' => 600000,
                       'KABUPATEN SAMOSIR' => 500000,
                       'KABUPATEN SERDANG BEDAGAI' => 100000,
                       'KABUPATEN SIMALUNGUN' => 250000,
                       'KABUPATEN TAPANULI SELATAN' => 800000,
                       'KABUPATEN TAPANULI TENGAH' => 500000,
                       'KABUPATEN TAPANULI UTARA' => 500000,
                       'KABUPATEN TOBA SAMOSIR' => 500000,
                       'KOTA BINJAI' => 0,
                       'KOTA GUNUNGSITOLI' => 900000,
                       'KOTA MEDAN' => 0,
                       'KOTA PADANGSIDIMPUAN' => 700000,
                       'KOTA PEMATANG SIANTAR' => 200000,
                       'KOTA SIBOLGA' => 600000,
                       'KOTA TANJUNG BALAI' => 500000,
                       'KOTA TEBING TINGGI' => 100000
        ];

        $options = "<option value=''>Pilih Kabupaten</option>";
        foreach ($kabupatens as $kabupaten) {
            $ongkir = isset($shippingCosts[$kabupaten->name]) ? $shippingCosts[$kabupaten->name] : 0;
            $options .= "<option value='{$kabupaten->id}' data-name='{$kabupaten->name}' data-ongkir='{$ongkir}'>{$kabupaten->name}</option>";
        }

        return response()->json($options);
    }

    public function getkecamatan(Request $request){
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id',$id_kabupaten)->get();

        foreach($kecamatans as $kecamatan){
            echo "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }

    }
    public function getdesa(Request $request)
    {
            $id_kecamatan = $request->id_kecamatan;
            $desas = Village::where('district_id', $id_kecamatan)->get();
            $options = "<option value=''>Pilih Desa</option>";

        foreach ($desas as $desa) {
            $options .= "<option value='{$desa->id}'>{$desa->name}</option>";
        }

        return response()->json($options);
    }
    public function PlaceOrder(Request $request)
    {
        $userid = Auth::id();
    $checkedItems = $request->input('ids', []);

    if (empty($checkedItems)) {
        return redirect()->back()->with('error', 'Pilih produk sebelum melanjutkan ke checkout.');
    }

    $cart_items = Carts::whereIn('id', $checkedItems)->where('user_id', $userid)->get();

    // Proses penyimpanan data
    $nomortelp = $request->input('nohp');
    $tradeinsid = $request->input('tradeinsid');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');
    $nama = $request->input('fullname');
    $alamat = $request->input('alamat');
    $zip = $request->input('zip');
    $message = $request->input('message');
    $totalprice = $request->input('totalprice');
    $metode = $request->input('metode'); // Mendapatkan metode pembayaran dari request

    $productIds = [];
    $productimgs = [];
    $productnames = [];
    $quantities = [];
    $prices = [];

    foreach ($cart_items as $item) {
        $productIds[] = $item->product_id;
        $produkk = $item->products->id_products;
        $produkimage = Images_Products::where('product_id', $produkk)->latest()->first();
        $productimgs[] = $produkimage->image;
        $produk = $item->products->name_products;
        $productnames[] = $produk;
        $quantities[] = $item->quantity;
        $prices[] = $item->price;

        // Mengurangi jumlah produk yang tersedia
        $product = Products::findOrFail($item->product_id);
        $product->quantity -= $item->quantity;
        $product->save();

        // Menghapus item keranjang yang telah diproses dalam perulangan sebelumnya
        Carts::where('id', $item->id)->where('user_id', $userid)->delete();
    }

    // Simpan ke database
    Order::create([
        'user_id' => $userid,
        'totalprice' => $totalprice,
        'phonenumber' => $nomortelp,
        'provinsi' => $provinsi,
        'Kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'desa' => $desa,
        'tradeinsid' => $tradeinsid,
        'alamat' => $alamat,
        'nama' => $nama,
        'request' => $message,
        'zip' => $zip,
        'product_id' => json_encode($productIds),
        'product_nama' => json_encode($productnames),
        'product_img' => json_encode($productimgs),
        'quantity' => json_encode($quantities),
        'price' => json_encode($prices),
        'statuspembayaran' => 'Unpaid',
        'metode' => $metode, // Menyimpan metode pembayaran
    ]);

    // Perbarui status trade-in menjadi selesai
    if ($tradeinsid) {
        $tradein = tradeins::find($tradeinsid);
        if ($tradein) {
            $tradein->status = 'selesai';
            $tradein->save();
        }
    }

    return redirect()->route('keranjang')->with('message', 'Berhasil Memesan');
}

            public function tradeins(Request $request)
    {
        $validatedData = $request->validate([
            'name.*' => 'required|string',
            'id_categories' => 'nullable|array',
            'id_categories.*' => 'exists:categories,id_categories',
            'kondisi' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'hargadasar' => 'required',
        ]);

        // Debugging: Display validated data
        // dd($validatedData);

        $tradein = new tradeins();
        $tradein->name = json_encode($request->input('name'));
        $tradein->user_id = auth()->id();
        $tradein->kondisi = $validatedData['kondisi'];
        $tradein->deskripsi = $validatedData['deskripsi'];
        $tradein->hargadasar = $validatedData['hargadasar'];
        $tradein->save();

        // Attach categories to tradein
        if (isset($validatedData['id_categories'])) {
            $tradein->categories()->attach($validatedData['id_categories']);
        }

        $imageData = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'uploads/trades/'; // Direktori penyimpanan gambar
                $file->move($path, $filename);

                // Simpan data gambar ke dalam tabel tradeinsimages
                $tradeinImage = new TradeinsImage();
                $tradeinImage->trendinsid = $tradein->id;
                $tradeinImage->image = $path . $filename;
                $tradeinImage->save();
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function tawarancustom(Request $request)
    {
   // Validasi data input
   $request->validate([
    'id' => 'required|exists:tradeins,id',
    'hargadasar' => 'required|numeric|min:0',
]);

try {
    // Cari record trade-in berdasarkan ID
    $tradein = Tradeins::findOrFail($request->id);

    // Update field 'hargadasar'
    $tradein->hargadasar = $request->hargadasar;
    $tradein->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Tawaran berhasil ditambahkan');
} catch (\Exception $e) {
    // Tangani potensi error
    return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tawaran');
}
    }

    public function setujuu(Request $request)
    {
        // Validasi input data
        $request->validate([
            'id' => 'required|exists:tradeins,id',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            // Cari record trade-in berdasarkan ID
            $tradein = Tradeins::findOrFail($request->id);

            // Update field 'price' dan 'status'
            $tradein->price = $request->price;
            $tradein->status = 'terima';  // Mengubah status menjadi 'terima'
            $tradein->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Tawaran berhasil ditambahkan dan status diubah menjadi terima');
        } catch (\Exception $e) {
            // Tangani potensi error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tawaran');
        }
    }















}
