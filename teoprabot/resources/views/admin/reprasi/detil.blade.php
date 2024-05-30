@extends('admin.layouts.template')
@section('main-content')
<div class="container mt-5">
    <h2 class="mb-4">detil tukar tambah</h2>

    <div class="row">
        <!-- Left Card: Product Details and Status -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3>Id Reprasi : <span>{{$detilreprasi->id}}</span></h3>
                    @if ($detilreprasi->status == null)
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">Proses</span></h5>
                    @elseif($detilreprasi->status == 'terima')
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">diterima</span></h5>
                    @elseif($detilreprasi->status == 'tolak')
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">ditolak</span></h5>
                    @endif

                    <div class="mb-4">
                        <h5>Nama Barang:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">{{$detilreprasi->nama}}</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h5>Jenis:</h5>
                        <div>
                            <span class="badge bg-secondary">{{$detilreprasi->category->name_categories}}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Kondisi:</h5>
                        <span class="text-muted">{{$detilreprasi->kondisi}}</span>
                    </div>

                    <div class="mb-4">
                        <h5>Deskripsi:</h5>
                        <span class="text-muted">{{$detilreprasi->deskripsi}}</span>
                    </div>

                    <div class="mb-4">
                        <h5>Gambar Produk:</h5>
                            <div class="row">

                                @foreach ($productImage as $productIMG)
                                <div class="col-md-6 mb-3">
                                    <div class="card d-flex">
                                        <img src="{{asset($productIMG->image)}}" class="card-img-top" alt="Img" style="height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Right Card: Personal Data -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Data Pribadi</h5>
                    <div class="mb-4">
                        <h6>Nama:</h6>
                        <p class="text-muted">{{ $detilreprasi->nama }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Nomor Telepon:</h6>
                        <p class="text-muted">{{ $detilreprasi->phonenumber }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Province:</h6>
                        <p class="text-muted">{{ $detilreprasi->province->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Kabupaten:</h6>
                        <p class="text-muted">{{ $detilreprasi->regency->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Kecamatan:</h6>
                        <p class="text-muted">{{ $detilreprasi->district->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Desa:</h6>
                        <p class="text-muted">{{ $detilreprasi->village->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Alamat:</h6>
                        <p class="text-muted">{{ $detilreprasi->alamat }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>ZIP:</h6>
                        <p class="text-muted">{{ $detilreprasi->zip }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>


    <!-- Bottom Card: Pricing and Actions -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive mb-4">

            </div>
            @if ($detilreprasi->status == null)
            <div style="display: flex; margin-bottom: 10px;">
                <a href="{{ route('indexreprasi') }}" class="btn btn-danger me-2">Back</a>
                <form action="{{ route('rejectreq', $detilreprasi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Reject</button>
                </form>


                <form action="{{ route('approvereq', $detilreprasi->id) }}" method="POST">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="price" value="{{ $detilreprasi->hargadasar }}">
                    <button type="submit" class="btn btn-primary">Setuju</button>
                </form>
            </div>

@else
@if ($detilreprasi->status == 'terima')
<p class="text-danger">* untuk lebih lanjut hubungi langsung </p>
<a href="https://wa.me/{{$detilreprasi->phonenumber}}" target="_blank" class="btn btn-success">
    <i class="bi bi-whatsapp"></i> Chat via WhatsApp
</a>
@endif
<div style="display: flex; margin-bottom: 10px;">
    <a href="{{ route('indexreprasi') }}" class="btn btn-danger me-2">Back</a>
                        <form action="{{ route('batalreprasi', $detilreprasi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning me-2">Batal</button>
                        </form>

</div>
                        @endif
        </div>
    </div>
</div>
@endsection
