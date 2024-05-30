@extends('costumers.layouts.profile.profile')
@section('content-profil')
@section('css')


@endsection

 <div class="container container-custom">
        <div class="header-custom">
            <!-- Dropdown for small screens -->
            <div class="btn-group dropend mb-2">
                <button type="button" class="btn btn-secondary drop">
                  Split dropend
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">All</a></li>
                    <li><a class="dropdown-item" href="{{route('mengirim')}}">To Ship</a></li>
                    <li><a class="dropdown-item" href="#">To Receive</a></li>
                    <li><a class="dropdown-item" href="#">Completed</a></li>
                    <li><a class="dropdown-item" href="#">Cancelled</a></li>
                    <li><a class="dropdown-item" href="#">Return Refund</a></li>
                </ul>
              </div>
            <!-- Default nav for larger screens -->
            <ul class="nav nav-pills d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link active" href="#">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('mengirim')}}">To Ship</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">To Receive</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cancelled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Return Refund</a>
                </li>
            </ul>
        </div>
    @yield('pemesanan')
</div>
@endsection
