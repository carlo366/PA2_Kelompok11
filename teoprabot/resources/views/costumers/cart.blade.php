    @php
     $userid = Auth::id();
// Menghitung jumlah produk di keranjang untuk pengguna yang sedang login
$totalcart = App\Models\Carts::where('user_id', $userid)->count();
$totaltred = App\Models\tradeins::where('user_id', $userid)->count();
// $totalAcceptedTred = App\Models\Tradein::where('user_id', $userid)
//     ->where('status', 'terima') // ganti 'terima' dengan nilai status yang sesuai jika berbeda
//     ->count();
@endphp
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .quantity-input {
        display: flex;
        align-items: center;
    }
    .hidden {
      display: none;
    }
    .quantity-input input[type="text"] {
        width: 80px;
        padding: 8px;
        height: 41px;
        text-align: center;
        border: 1px solid #ccc;
        /* border-radius: 4px; */
        outline: none;
        margin: 0; /* Menghilangkan margin pada input */
    }

    .quantity-input a {
        background-color: transparent;
        /* border-left: none; */
        border: 1px solid #ced4da;
        color: #212529;
        font-size: 17px;
        cursor: pointer;
        margin: 0; /* Menghilangkan margin pada tombol */
        transition: background-color 0.3s ease;
    }

    .quantity-input a:hover {
        background-color: white;
        border: 1px solid #ced4da;
    }

    .quantity-input a:active {
        background-color: white;
        border: 1px solid black;
    }

    .quantity-input a:focus {
        background-color: white;
        border: 1px solid #ced4da;
    }




    /* Menyesuaikan lebar tombol agar sesuai dengan input */
    .quantity-input a.decrement,
    .quantity-input a.increment {
        width: 30px; /* Sesuaikan lebar sesuai kebutuhan */
    }
    .table-responsive-custom {
        overflow-x: auto;
        /* background-color:#ced4da; */
    }

    .table-responsive-custom table {
        width: 100%;
        min-width: 800px; /* Atur lebar minimum tabel */
    }




    .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
        .table{
            background-color: #F1F1F1;
        }
</style>
@endsection
@extends('costumers.layouts.template')
@section('title' | 'Keranjang')
@section('main-content')
<section class="cart_area">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
            @if($totalcart > 0)
<br>
@if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<br>
<div class="table-responsive-custom">
    <form c654321 action="{{route('checkout')}}">
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="select_all_ids"></th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">@Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
        $total = 0;
        $nomor = 1;
        @endphp
        <tbody>
            @foreach ($carts as $cart)
            @php
            $product_id = $cart->products->id_products; // Mengambil ID produk dari item keranjang
            $images = App\Models\Images_Products::where('product_id', $product_id)->latest()->first();
        @endphp
            <tr>
                <td><input type="checkbox" name="ids[{{$cart->id}}]" class="checkbox_ids" id="" value="{{$cart->id}}"></td>
                <td>
                    <div class="media">
                        <div class="d-flex">
                            {{-- @foreach ($images as $image) --}}
                            <a href="{{route('produkdetail',$cart->products)}}"><img src="{{ asset($images->image) }}" alt="" style="max-width: 100px; max-height: 100px;"></a>
                        {{-- @endforeach --}}
                           {{ $cart->products->name_products }}
                        </div>
                    </div>
                </td>
                <td>
                    <p>Rp {{ number_format($cart->products->price, 0, ',', '.') }}</p>
                </td>
                <td>
                    <div class="quantity-input">
                        @if(session('confirm'))
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered"> <!-- Tambahkan class modal-dialog-centered untuk menempatkan modal di tengah -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ session('confirm') }}
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('deletecart', $cart->id) }}" class="btn" style="background-color:#402218;color:white">Ya, Hapus</a>
                                        <a href="{{ route('keranjang') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
@endif
                        <a href="{{route('products.decrement',$cart->id)}}" class="btn btn-secondar dec" onclick="decrement()" style="background-color:#402218;color:white">-</a>
                        <input type="text" id="quantityInput" value="{{ $cart->quantity }}" onchange="updateQuantity({{ $cart->id }}, this)">
                        <a href="{{route('increment',$cart->id)}}" class="btn btn-secondary in" onclick="increment()" style="background-color:#402218;color:white">+</a>
                    </div>
                </td>
                @php
                $total = $cart->quantity * $cart->price
                @endphp
                <td class="item_price" data-price="{{ $total }}">{{'Rp '.number_format($total)}}</td>
                <td><a href="{{route('deletecart',$cart->id)}}" class="text-dark" >delete</a></td>
            </tr>
            @php
            $total = $total + $cart->price;
            @endphp
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h5>Subtotal</h5>
                </td>
                <td id="total_price">{{'Rp '.number_format(0)}}</td>
                <td>
                    <div class="checkout_btn_inner">
                        <button type="submit" class="main_btn btn btn-success" href="#" style="background-color:#402218;color:white">Checkout</button>
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
    </form>



    @if ($totaltred > 0)
    <div class="container mt-5">
        <h2 class=" mb-4">Tukar Tambah</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Status: <span class="badge bg-warning text-dark">Proses</span></h5>

                @foreach ($tradein as $tr)
                    @php
                        // Mendekode string JSON menjadi array PHP
                        $decodedArray = json_decode($tr->name, true);
                    @endphp

                    <div class="mb-4">
                        <h5>Nama Barang:</h5>
                        <ul class="list-group">
                            @if (is_array($decodedArray))
                                @foreach ($decodedArray as $item)
                                    <li class="list-group-item  ">{{ $item }}</li>
                                @endforeach
                            @else
                                <li class="list-group-item">Tidak ada data barang yang valid.</li>
                            @endif
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h5>Jenis:</h5>
                        <div>
                            @foreach ($tredca as $tred)
                                <span class="badge bg-secondary">{{ $tred->category->name_categories }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Kondisi:</h5>
                        <span class="text-muted">{{ $tr->kondisi }}</span>
                    </div>

                    <div class="mb-4">
                        <h5>Gambar Produk:</h5>
                        <div class="row">
                            @foreach ($productImage as $productIMG)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset($productIMG->image) }}" class="card-img-top" alt="Img" style="height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Harga Dasar</td>
                                    <td id="hasil_kurang">Rp {{ number_format($tr->hargadasar, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>Harga Tawaran</td>
                                    <td id="hasil_kurang">Rp {{ number_format($tr->price, 0, ',', '.') }}@if ($tr->price == null)
                                        <span class="text-danger">(*Menunggu Harga Tawaran Admin)</span>
                                    @endif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('deletetradeins',$tr->id)}}"  class="btn btn-danger">Hapus </a>
                    @if ($tr->price != null)
                    <a href="" class="btn btn-secondary">Tawar lagi</a>
                        <a href="" class="btn btn-success">Setuju</a>
                    @endif
                    </form>
                    @endforeach
            </div>
        </div>
    </div>
@endif



</div>


          @else
          <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center flex-column" style="margin-top: 3em;margin-bottom:2em;">
                    <i class="bi bi-cart3" style="font-size: 4em;"></i>
                    <p class="text-center ">Keranjang Anda kosong</p>
                    <a href="{{route('semuaproduk')}}" class="btn btn-success">Pergi Ke Toko Sekarang</a>
                </div>
            </div>
        </div>



          @endif



          @if ($totalcart > 0)
          @if($totaltred == 0)
          <p id="toggleTableBtn">Tukar Tambah <span class="text-dark">v</span></p>
          <div class="container hidden" id="tableContainer">
              <ul>
                          <h2 class="mt-5 mb-3">Form Tukar Tambah</h2>
                          <p class="text-danger">*request tukar tambah hanya bisa dilakukan 1 kali!</p>

                          <form id="formTambah" method="POST" action="{{ route('tradeins') }}" enctype="multipart/form-data">
                              @csrf
                                <div class="mb-3">
                                    <label for="inputNama" class="form-label">Nama</label>
                                    <div id="formContainer">
                                        <div class="input-group pb-2">
                                            <input type="text" class="form-control inputNama" name="name[]" placeholder="Masukkan nama" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" id="btnTambah">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                </div>
                              <div class="mb-3">
                                  <label for="inputJenis" class="form-label">Jenis</label>
                                  <select class="form-control js-example-basic-multiple-limit" style="width: 100%" id="id_categories" name="id_categories[]" multiple required>
                                      @foreach ($kategori as $kateg)
                                          <option value="{{ $kateg->id_categories }}">{{ $kateg->name_categories }}</option>
                                      @endforeach
                                  </select>

                              </div>
                              <div class="mb-3">
                                  <label for="inputKondisi" class="form-label">Kondisi</label>
                                  <select class="form-control" name="kondisi" style="width: 100%" required>
                                      <option value="Bekas">Bekas</option>
                                      <option value="Baru">Baru</option>
                                  </select>
                              </div>
                              <div class="mb-3">
                                      <label for="inputGambar" class="form-label">Gambar</label>
                                      <label for="images">Kirim Gambar (Max:20 images only)</label>
                                      <input type="file" name="images[]" multiple class="form-control" id="images">
                                      <div class="image-preview mt-5" id="imagePreview"></div>
                                         </div>
                                      <div class="mb-3">
                                          <label for="inputDeskripsi" class="form-label">Deskripsi</label>
                                          <textarea id="summernote"  name="deskripsi" ></textarea>
                                      </div>

                                      <div class="mb-3">
                                        <label for="inputHargaAwal" class="form-label">Harga Dasar</label>
                                        <input type="number" class="form-control" placeholder="Harga" name="hargadasar">
                                    </div>


                                      <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>

                       @endif
          @else
          <p id="toggleTableBtn">Tukar Tambah</p>

          <div class="container hidden" id="tableContainer">


                        <h2 class="mt-5 mb-3 text-muted text-center">Masukkin Barang Ke Keranjang</h2>
                      </div>
              @endif



        </div>
      </div>
    </div>
  </section>
  <br><br>


@endsection
@section('js')
<script>
    $(document).ready(function() {
      $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2
      });
    });
    </script>

<script>
    $(document).ready(function() {
        // Event handler untuk tombol Tambah
        $("#btnTambah").click(function() {
            // Buat elemen input group baru
            var $inputGroupBaru = $('<div class="input-group pb-2"><input type="text" class="form-control inputNama" name="name[]" placeholder="Masukkan nama" required><button type="button" class="btn btn-danger btnHapus"><i class="fas fa-minus"></i> Hapus</button></div>');

            // Tambahkan input group baru ke dalam form container
            $("#formContainer").append("<br>").append($inputGroupBaru);
        });

        // Event handler untuk tombol Hapus
        $(document).on("click", ".btnHapus", function() {
            // Hapus input group yang sesuai
            $(this).closest(".input-group").prev("br").remove(); // hapus <br> sebelumnya
            $(this).closest(".input-group").remove();
        });
    });
</script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script>
    $('#summernote').summernote({
        placeholder: 'deskripsi',
      tabsize: 2,
      height: 400
});
  </script>
<script>

// Ambil konten dari Summernote saat form disubmit
$('form').submit(function() {
  var content = $('#summernote').summernote('code');
  // Hilangkan tag <p></p> dari konten
  content = content.replace(/<p>/g, '').replace(/<\/p>/g, '');
  // Set kembali konten tanpa tag <p></p>
  $('#summernote').summernote('code', content);
});
</script>
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // Clear any existing previews

        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
