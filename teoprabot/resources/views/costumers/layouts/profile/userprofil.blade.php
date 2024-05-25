@extends('costumers.layouts.profile.profile')
@section('content-profil')
<div class="card">
    <div class="card-body">
      <h6>Profil Saya</h6>
      <hr>
      <div class="row">
        <div class="col-md-9">
          <form action="{{route('updateprofile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="nama" class="form-label">Nama</label>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nama" name="name" value="{{Auth::user()->name}}" placeholder="Masukkan nama">
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
              </div>
              <div class="col-md-9">
                <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" id="email" placeholder="Masukkan email">
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
              </div>
              <div class="col-md-9">
                <input type="tel" class="form-control" name="phone" id="phone" value="{{Auth::user()->phone}}" placeholder="Masukkan nomor telepon">
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="birthdate" class="form-label">Tanggal Lahir</label>
              </div>
              <div class="col-md-9">
                <input type="date" id="birthdate" value="{{Auth::user()->birthdate}}" name="birthdate" class="form-control">
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
              </div>
              <div class="col-md-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ Auth::user()->gender === 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ Auth::user()->gender === 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            </div>


        </div>

        <div class="col-md-3 text-center">
                            <div class="row  p-4 justify-content-center align-items-center">
            <div class="upload-container gambar mb-2 rounded-circle">
                <!-- Gambar bulat di tengah -->
                @if(Auth::user()->user_img == null)
                <img src="https://pluspng.com/img-png/png-user-icon-circled-user-icon-2240.png" alt="Gambar Profil" class="img-fluid">
                @else
                <img src="{{asset(Auth::user()->user_img)}}" alt="Gambar Profil" class="img-fluid">
                @endif
            </div>
            <input type="file" name="user_img" id="file-input" name="file-input" class="upload-input"/>

            <label id="file-input-label" for="file-input">Pilih Gambar</label>
        </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mb-3 mt-3">Simpan</button>
          </div>
    </form>
      </div>
    </div>
  </div>
</div>
@endsection
