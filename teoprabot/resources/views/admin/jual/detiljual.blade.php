@extends('admin.layouts.template')
@section('main-content')

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detil Table</h3>
                <p class="text-subtitle text-muted">Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Table</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12 col-md-6">
    <div class="card" style="height: 38em" >
      <div class="card-header">
        <h3>Data</h3>
        <h6 for="">Nama : {{$detiljual->user->name}}</h5><br>
        <h6 for="">Email : <span>{{$detiljual->user->email}}</span></h6>
        <h6 for="">phone : <span>{{$detiljual->phonenumber}}</span></h6>
        <p class="text-danger">* untuk lebih lanjut hubungi langsung </p>
        <a href="https://wa.me/{{$detiljual->phonenumber}}" target="_blank" class="btn btn-success">
            <i class="bi bi-whatsapp"></i> Chat via WhatsApp
        </a>
<br>

       @if ($detiljual->status == null)
        <h5 class="card-title" style="">Status: <span class="badge bg-warning text-dark">Proses</span></h5>
        @elseif($detiljual->status == 'tolak')
        <h5 class="card-title" style="">Status: <span class="badge bg-warning text-dark">{{$detiljual->status}}</span></h5>
        @elseif($detiljual->status == 'terima')
        <h5 class="card-title" style="">Status: <span class="badge bg-success text-dark">{{$detiljual->status}}</span></h5>
        @endif
      </div>
      <div class="card-content">
        <div class="card-body">
            @php
            // Mendekode string JSON menjadi array PHP
            $decodedArray = json_decode($detiljual->name, true);
        @endphp
                            <div class="mb-4">

 <h5>Nama Barang:</h5>
 <ul class="list-group">
    <li class="list-group-item  ">{{ $detiljual->nameproduct }}</li>

 </ul>
                            </div>
          <!-- Table with outer spacing -->

        <div class="mb-4">
            <h5>Deskripsi:</h5>
            <div>

                <p>{{$detiljual->deskripsi}}</p>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="card" style="height: 38em">
      <div class="card-header">
        <h4 class="card-title">Gambar</h4>
      </div>
      <div class="card-content">
        <div class="card-body d-flex" style="flex-wrap: wrap;">
            @foreach ($jualImage as $productIMG)
            <div class="col-md-3 m-2">
                <div class="card-img">
                    <img src="{{ asset($productIMG->image) }}" class="card-img-top" alt="Img" style="height: 150px; object-fit: cover;">
                </div>
            </div>
        @endforeach
        </div>

        <!-- Table with no outer spacing -->

      </div>
    </div>
  </div>
</div>

<div class="card">
<div class="card-header">
    <h4 class="card-title">Hasil</h4>
  </div>
  <div class="card-content">
    <div class="card-body">




        <div class="table-responsive">
            @if ($detiljual->status == null)
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Harga Customer</td>
                        <td id="hasil_kurang">Rp {{ number_format($detiljual->hargadasar, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Harga Tawaran</td>
                        <td id="hasil_kurang">
                            @if ($detiljual->price != null)
                            Rp {{ number_format($detiljual->price, 0, ',', '.') }}
                            @elseif($detiljual->price == null)
                        <form action="{{ route('tawaranjualadmin', $detiljual->id) }}" method="POST">
                            @csrf <!-- Ensure CSRF token is included for security -->
                            <input type="number" class="form-control" name="price" min="0" required>
                            <button type="submit" class="btn btn-info me-2 mt-3">Beri Tawaran</button>
                        </form>

                        @endif</td>


                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-start mt-4">
                <form action="{{route('rejectjual',$detiljual->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Reject</button>
                </form>
                @if ($detiljual->price == null)

                <form action="{{ route('approvejual', $detiljual->id) }}" method="POST">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="price" value="{{ $detiljual->hargadasar }}">
                    <button type="submit" class="btn btn-primary">Setuju Harga Customer</button>
                </form>
                @else
                <a href="#" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#tawarModal">Tawar lagi</a>
                <div class="modal fade" id="tawarModal" tabindex="-1" aria-labelledby="tawarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tawarModalLabel">Masukkan Tawaran Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="tawarForm" action="{{ route('tawaranjualadmin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="{{ $detiljual->id }}">
                                        <label for="price" class="form-label">Harga Tawaran</label>
                                        <input type="number" class="form-control" name="price" id="price" min="0" required>
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

                <form action="{{ route('approvejual', $detiljual->id) }}" method="POST">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="price" value="{{ $detiljual->hargadasar }}">
                    <button type="submit" class="btn btn-primary">Setuju Harga Customer</button>

                </form>
                @endif
            </div>
            @elseif($detiljual->status == 'terima')
            <h1>Harga : Rp{{number_format($detiljual->price, 0, ',', '.')}} </h1>
            <div class="d-flex justify-content-start mt-4">
                <form action="{{route('rejectjual',$detiljual->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Reject</button>
                </form>
                <form action="{{ route('bataljual', $detiljual->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning me-2">Batal</button>
                </form>            </div>
            @elseif($detiljual->status  == 'tolak')
            <div class="d-flex justify-content-start mt-4">
                <form action="{{ route('bataljual', $detiljual->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning me-2">Batal</button>
                </form>

            </div>
            @endif
        </div>
    </div>
  </div>
</div>
</div>

@endsection
