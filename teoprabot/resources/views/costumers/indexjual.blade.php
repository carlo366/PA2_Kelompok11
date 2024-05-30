@extends('costumers.layouts.template')
@section('css')
<style>
    .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }
    .card-text {
      font-size: 0.9rem;
    }
    .btn-outline-primary {
      color: #007bff;
    }
    .btn-outline-primary:hover {
      background-color: #007bff;
      color: #fff;
    }
  </style>

@endsection
@section('main-content')
<div class="container mt-5">
    <h2>Semua Jual</h2>
    <div class="row">
      @foreach ($jual as $ju)
      @php
      $jual_id = $ju->id; // Mengambil ID produk dari item keranjang
      $images = App\Models\jual_image::where('jualid', $jual_id)->latest()->first();
      @endphp
      <div class="col-md-4 mb-4">
          <div class="card h-100">
              <img src="{{ asset($images->image) }}" class="card-img-top" alt="{{ $ju->nameproduct }}">
              <div class="card-body">
                  <h5 class="card-title">{{ $ju->nameproduct }}</h5>
                  <p class="card-text">{{ Str::limit($ju->deskripsi, 100) }}</p>
                  @if ($ju->status == null)
                  <p class="card-text"> <span class="badge bg-warning text-dark">Proses</span></p>
                    @endif
              </div>
              <div class="card-footer bg-transparent border-top-0">
                  <a href="{{ route('jual.show', $ju->id) }}" class="btn btn-info btn-block">Detil</a>
              </div>
          </div>
      </div>
      @endforeach
    </div>
    <!-- Request Jual Button -->
    <div class="mt-4">
        <a href="{{route('jualcategory')}}" class="btn btn-success">Request Jual</a>
    </div>
</div>
@endsection

