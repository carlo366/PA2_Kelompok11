@extends('costumers.layouts.profile.profile')
@section('content-profil')
@section('csss')

.container-custom {
    max-width: 900px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
}
.header-custom {
    border-bottom: 1px solid #ddd;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.header-custom .nav-link {
    color: #000;
    padding: 10px 20px;
}
.header-custom .nav-link.active {
    border-bottom: 2px solid #ff5722;
    background-color: white;
    color: #000;
}
.header-custom .nav-link:hover {
    background-color: #f8f9fa;
}
.search-bar {
    background-color: #f8f9fa;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.content-custom {
    text-align: center;
    color: #888;
    padding: 50px 20px;
}
.content-custom img {
    width: 80px;
    margin-bottom: 10px;
}
table {
    width: 100%;
    margin-top: 20px;
}
.nav-pills {
    display: flex;
    width: 100%;
    justify-content: space-between;
}
.dropend{
    display: none;
}

/* Media query untuk layar kecil */
@media (max-width: 991px) {
    .nav-pills {
        display: none;
    }
    .dropend {
        display: block;
    }
}

@media (min-width: 992px) {
    .dropdown-menu {
        display: none;
    }
    .dropend {
        display: none;
    }

    .nav-pills {
        display: flex;
        justify-content: space-between;
    }
}


@endsection

<div class="container container-custom">
    <div class="header-custom">
        <!-- Dropdown for small screens -->
        <div class="btn-group dropend d-lg-none ">
            <button type="button" class="btn btn-secondary">
              Split dropend
            </button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropright</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">All</a></li>
                <li><a class="dropdown-item" href="#">To Pay</a></li>
                <li><a class="dropdown-item" href="#">To Ship</a></li>
                <li><a class="dropdown-item" href="#">To Receive</a></li>
                <li><a class="dropdown-item" href="#">Completed</a></li>
                <li><a class="dropdown-item" href="#">Cancelled</a></li>
                <li><a class="dropdown-item" href="#">Return Refund</a></li>
            </ul>
          </div>
        <!-- Default nav for larger screens -->
        <ul class="nav nav-pills d-none d-lg-flex">
            <li class="nav-item">
                <a class="nav-link " href="#">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">To Pay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">To Ship</a>
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
