@extends('costumers.layouts.template')

@section('main-content')
<div class="container mt-5">
    <h2 class="mb-4">Tukar Tambah</h2>

    <div class="row">
        <!-- Left Card: Product Details and Status -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    @if ($detiljual->status == null)
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">Proses</span></h5>
                    @elseif($detiljual->status == 'terima')
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">diterima</span></h5>
                    @elseif($detiljual->status == 'ditolak')
                    <h5 class="card-title">Status: <span class="badge bg-warning text-dark">ditolak</span></h5>
                    @endif

                    <div class="mb-4">
                        <h5>Nama Barang:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">{{$detiljual->nama}}</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h5>Jenis:</h5>
                        <div>
                            <span class="badge bg-secondary">{{$detiljual->kategory}}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Kondisi:</h5>
                        <span class="text-muted">{{$detiljual->kondisi}}</span>
                    </div>

                    <div class="mb-4">
                        <h5>Deskripsi:</h5>
                        <span class="text-muted">{{$detiljual->deskripsi}}</span>
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
                        <p class="text-muted">{{ $detiljual->nama }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Nomor Telepon:</h6>
                        <p class="text-muted">{{ $detiljual->phonenumber }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Province:</h6>
                        <p class="text-muted">{{ $detiljual->province->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Kabupaten:</h6>
                        <p class="text-muted">{{ $detiljual->regency->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Kecamatan:</h6>
                        <p class="text-muted">{{ $detiljual->district->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Desa:</h6>
                        <p class="text-muted">{{ $detiljual->village->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>Alamat:</h6>
                        <p class="text-muted">{{ $detiljual->alamat }}</p>
                    </div>
                    <div class="mb-4">
                        <h6>ZIP:</h6>
                        <p class="text-muted">{{ $detiljual->zip }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>


    <!-- Bottom Card: Pricing and Actions -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive mb-4">
                <table class="table table-bdetiljualed">
                    <tbody>
                        @if ($detiljual->status == null)
                        <tr>
                            <td>Harga Saya</td>
                            <td>Rp {{ number_format($detiljual->hargadasar, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Harga Tawaran</td>
                            <td id="hasil_kurang">Rp {{ number_format($detiljual->price, 0, ',', '.') }}@if ($detiljual->price == null)
                                <span class="text-danger">(*Menunggu Harga Tawaran Admin)</span>
                            @endif</td>


                        </tr>
                        @elseif($detiljual->status == 'terima')
                        <h1>Harga : Rp{{number_format($detiljual->price, 0, ',', '.')}} </h1>
                        @endif
                    </tbody>
                </table>
            </div>

            <a href="{{route('indexjual')}}" class="btn btn-danger">Back</a>
            @if ($detiljual->status == null)
            <a href="#" onclick="confirmDelete('1')" class="btn btn-danger mb-2">Hapus</a>
            @if ($detiljual->price != null)

            <!-- "Tawar lagi" button to trigger the modal -->
            <a href="#" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#tawarModal">Tawar lagi</a>
            <div class="modal fade" id="tawarModal" tabindex="-1" aria-labelledby="tawarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tawarModalLabel">Masukkan Tawaran Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="tawarForm" action="{{ route('tawaranjual') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $detiljual->id }}">
                                    <label for="price" class="form-label">Harga Tawaran</label>
                                    <input type="number" class="form-control" name="hargadasar" id="price" min="0" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tawar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <form action="{{route('setujujual')}}" method="POST">
                @csrf
                <input type="hidden" name="price" value="{{$detiljual->price}}">
                <input type="hidden" name="id" value="{{$detiljual->id}}">
                <button type="submit" class="btn btn-success">Setuju Harga Admin</button>
            </form>


            @endif
            @endif
        </div>
    </div>
</div>
@endsection
