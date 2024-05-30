@extends('costumers.layouts.template')
@section('main-content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
        .comment-box {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            min-height: 150px;
            background-color: #f9f9f9;
            white-space: pre-wrap; /* Preserve whitespace and line breaks */
        }
</style>
@endsection
<div class="container mt-5">
    <!-- Tombol Back -->
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('pesan') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <!-- Grid untuk Data Diri dan Detil Order Pesanan -->
    <div class="row">
        <!-- Card Data Diri -->
        <div class="col-11 col-md-5">
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title">Data Diri</h5>
                    <div class="row">
                        <div class="col-12">
                            <p><strong>Nama:</strong> {{ $detilpemesanan->nama }}</p>
                            <p><strong>Phone Number:</strong> {{ $detilpemesanan->phonenumber }}</p>
                            <p><strong>Provinsi:</strong> {{ $detilpemesanan->province->name }}</p>
                            <p><strong>Kabupaten:</strong> {{ $detilpemesanan->regency->name }}</p>
                            <p><strong>Kecamatan:</strong> {{ $detilpemesanan->district->name }}</p>
                            <p><strong>Desa:</strong> {{ $detilpemesanan->village->name }}</p>
                            <p><strong>Alamat:</strong> {{ $detilpemesanan->alamat }}</p>
                            <p><strong>ZIP:</strong> {{ $detilpemesanan->zip }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Detil Order Pesanan -->
        <div class="col-12 col-md-7">
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title">Detil Order Pesanan</h5>
                    <p class="card-text">This is the right card with supporting text below as a natural lead-in to additional content.</p>
                    <div class="mb-3">
                        <span>Status:</span>
                        <span class="badge bg-{{ $detilpemesanan->status === 'pending' ? 'warning' : ($detilpemesanan->status === 'processing' ? 'info' : ($detilpemesanan->status === 'completed' ? 'success' : 'danger')) }}">{{ $detilpemesanan->status }}</span>
                    </div>
                    <div class="mb-3">
                        <span>Code Order:</span>
                        <span class="badge bg-primary">{{ $detilpemesanan->kodeorder }}</span>
                    </div>
                    <div class="mb-3">
                        <span>Metode:</span>
                        <span class="badge bg-secondary">{{ $detilpemesanan->metode }}</span>
                    </div>
                    @if ($detilpemesanan->metode == 'payment')
                        <div class="mb-3">
                            <span>Status Pembayaran:</span>
                            <span class="badge bg-primary">{{ $detilpemesanan->statuspembayaran }}</span>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Nama</th>
                                    <th>Product Img</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
    $grandTotal = 0;
@endphp
                                @foreach (json_decode($detilpemesanan->product_id) as $key => $productId)
                                    <tr>
                                        <td>{{ $productId }}</td>
                                        <td>{{ json_decode($detilpemesanan->product_nama)[$key] }}</td>
                                        <td><img src="{{ asset(json_decode($detilpemesanan->product_img)[$key]) }}" style="max-width: 100px; height: auto;" alt=""></td>
                                        <td>{{ json_decode($detilpemesanan->quantity)[$key] }}</td>
                                        <td>Rp {{ number_format(json_decode($detilpemesanan->price)[$key], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        @php
                                    $quantity = json_decode($detilpemesanan->quantity)[$key];
                                    $price = json_decode($detilpemesanan->price)[$key];
                                    $total = $quantity * $price;
                                    $grandTotal += $total;

                                    @endphp
                                @endforeach
                                @if(isset($detilpemesanan->tradeinsid))
                            <tr>
                                <td>tukar tambah</td>
                                @php
                                $decodedArray = json_decode($detilpemesanan->tradein->name, true);
                            @endphp
                                <td></td>
                                <td> <ul class="list-group">
                                    @if (is_array($decodedArray))
                                        @foreach ($decodedArray as $item)
                                            <li class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    @foreach ($productImage->take(1) as $productIMG)
                                                        <div class="me-3">
                                                            <img src="{{ asset($productIMG->image) }}" class="img-thumbnail" alt="Img" style="height: 100px; object-fit: cover;">
                                                        </div>
                                                    @endforeach
                                                    <span>{{ $item }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item">Tidak ada data barang yang valid.</li>
                                    @endif
                                </ul></td>
                                <td></td>
                                <td>Rp.{{number_format($detilpemesanan->tradein->price, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Sisa</td>
                                <td>Rp.{{number_format($grandTotal - $detilpemesanan->tradein->price, 0, ',', '.') }}-</td>
                            </tr>

                                @endif
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Ongkir</td>
                                    @if(isset($detilpemesanan->tradeinsid))
                                    <td colspan="2"><span class="last">{{ 'Rp '.number_format((($detilpemesanan->totalprice - $grandTotal) + $detilpemesanan->tradein->price ), 0, ',', '.') }}</span></td>
                                    @else
                                    <td colspan="2"><span class="last">{{ 'Rp '.number_format(($detilpemesanan->totalprice - $grandTotal), 0, ',', '.') }}</span></td>
                                    @endif
                                    {{-- <p>{{($detilpemesanan->totalprice - $detilpemesanan->price)[$key])}}</p> --}}

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Price :</td>
                                    <td>Rp {{ number_format($detilpemesanan->totalprice, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Aksi -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body">
                    @if ($detilpemesanan->metode == 'payment')
                    @if ($detilpemesanan->statuspembayaran == 'Unpaid')
                        @if ($detilpemesanan->img_bayar == null)
                            <h5 class="card-title">Upload Bukti Pembayaran</h5>
                            <!-- Form untuk upload bukti pembayaran -->
                            <form id="uploadForm" action="{{ route('uploadbayar', $detilpemesanan->id_orders) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="bukti_pembayaran">Pilih File</label>
                                    <input type="file" class="form-control-file" id="bukti_pembayaran" name="img_bayar" onchange="previewImage()">
                                </div>
                                <div id="imagePreview" class="image-preview mt-3"></div>
                                <button type="submit" class="btn btn-success mt-2">Upload</button>
                            </form>
                        @endif

                    @if($detilpemesanan->statuspembayaran == 'Unpaid' && $detilpemesanan->status == 'proses' && $detilpemesanan->img_bayar != null)
                        <h5 class="card-title">Bukti Pembayaran</h5>
                        <img src="{{ asset($detilpemesanan->img_bayar) }}" alt="Bukti Pembayaran" class="img-fluid">
                        <div class="mt-3">
                            <a href="{{route('deletePayment', $detilpemesanan->id_orders)}}" class="btn btn-danger">Hapus Pembayaran</a>

                        </div>
                        @endif
                    @endif
                @endif

                @if ($detilpemesanan->status == 'packaging' && $detilpemesanan->statuspembayaran == 'Paid')
                <h5 class="card-title">Bukti Pembayaran</h5>
                <img src="{{ asset($detilpemesanan->img_bayar) }}" alt="Bukti Pembayaran" class="img-fluid">
                        <br><br>
                        <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#tanggalAntarModal">
                            Tambah Tanggal Antar
                        </button>

                        <div class="modal fade" id="tanggalAntarModal" tabindex="-1" role="dialog" aria-labelledby="tanggalAntarModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tanggalAntarModalLabel">Tambah Tanggal Antar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('updateTanggalAntar', $detilpemesanan->id_orders) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tanggalantar">Tanggal Antar</label>
                                                <input type="datetime-local" class="form-control" id="tanggalantar" name="tanggalantar" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @elseif($detilpemesanan->status == 'sedangperjalan')
                        <h5 class="card-title">Bukti Pembayaran</h5>
                        <img src="{{ asset($detilpemesanan->img_bayar) }}" alt="Bukti Pembayaran" class="img-fluid">
                        <h5 class="card-title">Tanggal Pengiriman</h5>
                        <h3>{{ \Carbon\Carbon::parse($detilpemesanan->tanggalantar)->format('d F Y \j\a\m h.i A') }}</h3>
                        <br>
                        <a href="{{route('diterima',$detilpemesanan->id_orders)}}" class="btn btn-success">Pesanan Diterima</a>
                        {{-- <a href="" class="btn btn-info">Membuat Jadwal Antar</a> --}}
                        @elseif($detilpemesanan->status == 'terima' && $detilpemesanan->komentar == null)
                        <h4>Beri Ulasan</h4>
                        <form action="{{ route('beri.ulasan', ['id' => $detilpemesanan->id_orders]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea id="summernote" name="komentar"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Beri Ulasan</button>
                        </form>
                        @elseif($detilpemesanan->status == 'terima' && $detilpemesanan->komentar != null)
                        <h4>Ulasan</h4>
                        <div class="mb-3">
                            <div class="comment-box">{{ $detilpemesanan->komentar }}</div>
                        </div>

                @elseif($detilpemesanan->metode == 'cod')
                    <h3>Order menggunakan metode COD</h3>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('js')

<script>
    function previewImage() {
        const fileInput = document.getElementById('bukti_pembayaran');
        const imagePreview = document.getElementById('imagePreview');

        // Menghapus gambar sebelumnya (jika ada)
        while (imagePreview.firstChild) {
            imagePreview.removeChild(imagePreview.firstChild);
        }

        // Membuat elemen img untuk menampilkan gambar yang diunggah
        const img = document.createElement('img');
        img.classList.add('img-fluid');
        img.src = URL.createObjectURL(fileInput.files[0]);
        imagePreview.appendChild(img);
    }
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

@endsection
