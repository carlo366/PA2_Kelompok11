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
        <h6 for="">Nama : {{$trade->user->name}}</h5><br>
        <h6 for="">Email : <span>{{$trade->user->email}}</span></h6>

       @if ($trade->status == null)
        <h5 class="card-title" style="">Status: <span class="badge bg-warning text-dark">Proses</span></h5>
        @elseif($trade->status == 'tolak')
        <h5 class="card-title" style="">Status: <span class="badge bg-warning text-dark">{{$trade->status}}</span></h5>
        @elseif($trade->status == 'terima')
        <h5 class="card-title" style="">Status: <span class="badge bg-success text-dark">{{$trade->status}}</span></h5>
        @endif
      </div>
      <div class="card-content">
        <div class="card-body">
            @php
            // Mendekode string JSON menjadi array PHP
            $decodedArray = json_decode($trade->name, true);
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
          <!-- Table with outer spacing -->
          <div class="mb-4">
            <h5>Jenis:</h5>
            <div>
                @foreach ($tredca as $tred)
                    <span class="badge bg-secondary">{{ $tred->category->name_categories }}</span>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <h5>Deskripsi:</h5>
            <div>

                <p>{{$trade->deskripsi}}</p>
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
            @foreach ($productImage as $productIMG)
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
            @if ($trade->status == null)
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Harga Customer</td>
                        <td id="hasil_kurang">Rp {{ number_format($trade->hargadasar, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Harga Tawaran</td>
                        <td id="hasil_kurang">
                            @if ($trade->price != null)
                            Rp {{ number_format($trade->price, 0, ',', '.') }}
                            @elseif($trade->price == null)
                        <form action="{{ route('tawaran', $trade->id) }}" method="POST">
                            @csrf <!-- Ensure CSRF token is included for security -->
                            <input type="number" class="form-control" name="price" min="0" required>
                            <button type="submit" class="btn btn-info me-2 mt-3">Beri Tawaran</button>
                        </form>

                        @endif</td>


                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-start mt-4">
                <form action="{{route('reject',$trade->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Reject</button>
                </form>                @if ($trade->price == null)
                <form action="{{ route('setujunoprice', $trade->id) }}" method="POST">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="price" value="{{ $trade->hargadasar }}">
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
                                <form id="tawarForm" action="{{ route('tawarantrade') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="{{ $trade->id }}">
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

                <form action="{{ route('setujunoprice', $trade->id) }}" method="POST">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="price" value="{{ $trade->hargadasar }}">
                    <button type="submit" class="btn btn-primary">Setuju Harga Customer</button>

                </form>
                @endif
            </div>
            @elseif($trade->status == 'terima')
            <h1>Harga : Rp{{number_format($trade->price, 0, ',', '.')}} </h1>
            <div class="d-flex justify-content-start mt-4">
                <form action="{{route('reject',$trade->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Reject</button>
                </form>
                <form action="{{ route('batal', $trade->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning me-2">Batal</button>
                </form>            </div>
            @elseif($trade->status  == 'tolak')
            <div class="d-flex justify-content-start mt-4">
                <form action="{{ route('batal', $trade->id) }}" method="POST">
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
