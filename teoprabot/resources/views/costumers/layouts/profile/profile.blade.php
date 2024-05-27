@extends('costumers.layouts.template')
@section('main-content')
@section('css')

@endsection
<div class="container mt-5">
    <div class="row">
      <div class="col-lg-2 col-md-4">
        <!-- Informasi Pengguna -->
        <div class="profile-info">
            @if(Auth::user()->user_img == null)
            <img src="https://pluspng.com/img-png/png-user-icon-circled-user-icon-2240.png" alt="Gambar Profil" class="img-fluid">
            @else
            <img src="{{asset(Auth::user()->user_img)}}" alt="Gambar Profil" class="img-fluid">
            @endif          <div class="user-profile">
            <h6 class="mb-1">{{Auth::user()->name}}</h6>
  <!-- Menggunakan Font Awesome untuk ikon setting -->
  <a href="#" class="btn btn-link text- text-decoration-none">
      <i class="fas fa-cog text-dark me-1"></i > Edit Profil
    </a>
            </div>
        </div>
        <hr>
        <!-- Dropdown untuk Profil Akun -->
        <div class="dropdown">
          <a class="btn dropdown-toggle text-start me-2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user me-1"></i> Profil Saya
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{route('profil')}}">Lihat Profil</a></li>
            <li><a class="dropdown-item" href="{{route('profilpassword')}}">Ganti Kata Sandi</a></li>
          </ul>
          <a href="{{route('pesan')}}" class="d-block text-start text-decoration-none" style="margin-left: 10px; color:black"><i class="fas fa-shopping-cart me-1"></i> Daftar Pesanan</a>
        </div>
      </div>

      <div class="col-lg-10 col-md-8">
        <!-- Riwayat Pemesanan -->
        @yield('content-profil')
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    // Preview image when selecting a file
    const uploadInput = document.querySelector('.upload-input');
    const imgPreview = document.querySelector('.upload-container img');
    const uploadBtn = document.querySelector('.upload-btn');

    uploadInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imgPreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    // Handle click event for upload button
    uploadBtn.addEventListener('click', function () {
      uploadInput.click();
    });
  </script>
  @endsection
