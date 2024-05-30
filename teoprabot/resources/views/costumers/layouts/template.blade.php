@php
         $userid = Auth::id();
         $totalcart = App\Models\Carts::where('user_id', $userid)->count();
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>@yield('title', 'pagetitle')</title>
   @yield('css')
    <!-- Google Font -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{asset('costumer/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('costumer/css/linearicons.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link href="{{asset('costumer/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('costumer/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/elegant-icons.css')}}" type="text/css">
    {{-- <link rel="stylesheet" href="{{asset('costumer/css/nice-select.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href="{{asset('costumer/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- Libraries Stylesheet -->
    <link href="{{asset('costumer/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('costumer/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
</head>

<body>

     <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{asset('costumer/img/logo.png')}}" class="logo-humber" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            @auth
    return view('costumers.about');       <div class="header__top__right__auth">
                <a href="#" id=""  data-bs-toggle="modal" data-bs-target="#profilmodal"><i class="fa fa-user"></i>  Hi, {{Auth::user()->name}}</a>
            </div>
            @endauth
            @guest
            <div class="header__top__right__auth">
                <a href="#" id=""  data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-user"></i> Login/Register</a>
            </div>
            @endauth


        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('dashboard')}} " class="text-light" >Home</a></li>
                <li><a href="{{route('semuaproduk')}}"class="text-light">Shop</a></li>

                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html"class="text-light">Jual Barang</a></li>
                        <li><a href="./shoping-cart.html"class="text-light">Perbaiki</a></li>
                        <li><a href="./checkout.html"class="text-light">Tukar Tambah</a></li>
                        <li><a href="./blog-details.html"class="text-light">Request Barang</a></li>
                    </ul>
                </li>
                <li><a href="{{route('gallery')}}"class="text-light">Gallery</a></li>
                <li><a href="{{route('about')}}"class="text-light">About</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> teo366perabot@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li class=" text-light"><i class="fa fa-envelope text-light"></i> teo366perabot@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook  text-light"></i></a>
                                <a href="#"><i class="fa fa-twitter  text-light"></i></a>
                                <a href="#"><i class="fa fa-linkedin  text-light"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p  text-light"></i></a>
                            </div>
                            <!-- <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> -->

                           <!-- Tombol Login -->
                           @auth

                           @if(auth()->user()->hasRole('costumer'))
                           <div class="header__top__right__auth dd">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle text-light" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user me-2 "></i> Hi, {{Auth::user()->name}}
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <div class="dropdown-item user-info">
                                            @if(Auth::user()->user_img == null)
                                            <img src="https://pluspng.com/img-png/png-user-icon-circled-user-icon-2240.png"class="rounded-circle me-2" alt="Profile Picture" width="40">
                                            @else
                                            <img src="{{asset(Auth::user()->user_img)}}"class="rounded-circle me-2" alt="Profile Picture" width="40">
                                            @endif                                               <span class="user-name">{{Auth::user()->name}}</span>
                                            <div>

                                            </div>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{route('profil')}}">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="{{route('pesan')}}">Pembelian Saya</a></li>

                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                           @endif
                           @endauth
                           @guest
                           <div class="header__top__right__auth dd ">
                               <a href="#" class=" text-light" id="loginBtn" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-user"></i> Login/Register</a>
                           </div>
                           @endguest


<!-- Modal Form Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-muted text-center">Sudah punya akun? <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a></p>
            </div>
        </div>
    </div>
</div>



                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div style="width: 100%   ;">

            <div class="container" style="">

                <div class="row" >
                <div class="col-lg-1">
                    <div class="header__logo">
                        <a href="./index.html"><img class="logo" src="{{asset('costumer/img/logo.png')}}" alt="" ></a>
                    </div>

                </div>
                <div class="col-lg-8">
                    <nav class="header__menu">
                        <!-- Search bar -->
                        <div class="d-flex form-inputs">
                            <input class="form-control" type="text" placeholder="Search any product..." />
                            <i class="bx bx-search"></i>

                      </div>

                        <!-- Navigation menu -->
                        <div class="content">
                            <ul class="header__menu__horizontal ">
                                <li class="actie text-light"><a href="{{route('dashboard')}}" class="text-light">Home</a></li>
                                <li><a href="{{route('semuaproduk')}}" class="text-light">Shop</a></li>
                                <li><a href="#" class="text-light">Pages</a>
                                    <ul class="header__menu__dropdown" class="text-light">
                                        <li><a href="./shop-details.html" class="text-light">Jual Barang</a></li>
                                        <li><a href="./shoping-cart.html" class="text-light">Perbaiki</a></li>
                                        <li><a href="{{route('keranjang')}}" class="text-light">Tukar Tambah</a></li>
                                        <li><a href="./blog-details.html" class="text-light">Request Barang</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('gallery')}}" class="text-light">Gallery</a></li>
                                <li><a href="{{route('about')}}" class="text-light">About</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href=""><i class="bi bi-bell text-light"></i> <span>1</span></a></li>
                            <li><a href="{{route('keranjang')}}"><i class="bi bi-cart text-light"></i> <span>{{$totalcart}}</span></a></li>
                        </ul>
                        <div class="header__cart__price">

@if ($totalcart > 0)
<a href="{{route('keranjang')}}" class="btn btn-success jualbeli" style="padding:0.2em 0.9em;font-size:14px">+ <span class="text-dark">Tukar Tambah</span></a>
@else
<button class="btn btn-success jualbeli"  style="padding:0.2em 0.9em;font-size:14px" data-bs-toggle="popover" title="Peringatan" data-bs-content="Untuk melakukan tukar tambah harus memasukki barang kedalam keranjang dan pilih tukar tambah" data-bs-placement="bottom">+ <span class="text-dark">Tukar Tambah</span></button>
@endif

                        </div>

                        @php
                        $userid = Auth::id();
                        $totalreprasi = App\Models\Reprasi::where('user_id', $userid)->count();
                @endphp
                @if($totalreprasi == 0)
                        <div class="header__cart__price"><a href="{{route('perbaiki')}}" class="btn btn-success jualbeli" style="padding:0.01em 2em;margin:0.5em 0em;" >+ <span  class="text-dark">Perbaiki</span></a></div>
                        @else
                        <div class="header__cart__price"><a href="{{route('indexreprasi')}}" class="btn btn-success jualbeli" style="padding:0.01em 2em;margin:0.5em 0em;" >+ <span  class="text-dark">Perbaiki</span></a></div>

                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="humberger__open">

            <i class="fa fa-bars"></i>
        </div>

    </div>
</header>



@yield('main-content')



     <!-- Footer Start -->
     <div class="container-fluid footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Hubungi Kami</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-light me-3"></i>Jalan Gang Bonsau No 21 </p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-light me-3"></i>0812 6666 7757 / 0815 3017 366</p>
                    <p class="mb-2"><i class="fa fa-envelope text-light me-3"></i>teo366perabot@gmail.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Tautan Kami</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Jam Kerja</h4>
                    <p class="mb-1">senin - sabtu</p>
                    <h6 class="text-light">08:00 am - 23:59 pm</h6>
                    <p class="mb-1">Minggu</p>
                    <h6 class="text-light">10:00 am - 23:59 pm</h6>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Surat Berita</h4>
                    <p>Dolor amet sit justo amet elitr clita
                        ipsum elitr est.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                Copyright &copy; <a class="fw-medium text-light" href="#">TEO 366 PERABOT</a>
                </div>

            </div>
        </div>
    </div>
    @php
            $userid = Auth::id();
            $totaljual = App\Models\Jual::where('user_id', $userid)->count();
    @endphp
    @if($totaljual == 0)
    <a href="{{route('jualcategory')}}" class="show-button">+ Jual</a>
    @else
    <a href="{{route('indexjual')}}" class="show-button">+ Jual</a>

    @endif
<!-- Modal Form Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
      <div class="modal-content rounded-5">
        <div class="modal-header text-white">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            <h3 class="text-start mb-4">Masuk</h3> <!-- Added 'text-start' class and mb-4 for margin bottom -->
            <div class="mb-3">
              <label for="email" class="col-form-label float-start col-form-label-start">Email</label> <!-- Added 'col-form-label-start' class -->
              <input type="email" required name="email" class="form-control inputath @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="col-form-label float-start col-form-label-start">Password</label> <!-- Added 'col-form-label-start' class -->
              <input type="password" required name="password" class="form-control inputath @error('password') is-invalid @enderror" id="password" placeholder="Password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="block mt-4">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember">
                <span class="ml-2">Remember me</span>
              </label>
            </div>
            <!-- Button with 'w-100' class for full width -->
            <button type="submit" style="background-color:#AF8260 ;border:#AF8260" class="inputath w-100 p-2">Login</button>
          </form>
          <!-- <hr> -->
          <br>
          <p class="text-muted text-center mb-5">Belum punya akun? <a href="{{route('register')}}" class="" style="color: blue;">Daftar</a></p>
        </div>

      </div>
    </div>
  </div>


  @auth

  @if(auth()->user()->hasRole('costumer'))

  <div class="modal fade" id="profilmodal" tabindex="-1" aria-labelledby="profilLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content rounded-5">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="profilLabel">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                @if(Auth::user()->user_img == null)
                <img src="https://pluspng.com/img-png/png-user-icon-circled-user-icon-2240.png" alt="Gambar Profil" class="rounded-circle" style="width: 70px; height: 70px;">
                @else
                <img src="{{asset(Auth::user()->user_img)}}" alt="Gambar Profil" class="rounded-circle" style="width: 70px; height: 70px;">
                @endif            </div>
            <div>
              <h4 class="mb-1">{{Auth::user()->name}}</h4>
              <p class="text-muted mb-0">{{Auth::user()->email}}</p>
            </div>
          </div>
          <hr>
          <div class="d-flex flex-column">
            <a href="{{route('profil')}}" class="text-decoration-none mb-2">
              <i class="fas fa-user-edit me-2"></i>Edit Profil
            </a>
            <a href="{{route('pesan')}}" class="text-decoration-none mb-2">
              <i class="fas fa-shopping-cart me-2"></i>Pembelian Saya
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button class="dropdown-item me-4">
              <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
@endguest

    <!-- Js Plugins -->
    <script src="{{asset('costumer/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('costumer/js/bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    {{-- <script src="{{asset('costumer/js/jquery.nice-select.min.js')}}"></script> --}}
    <script src="{{asset('costumer/js/jquery-ui.min.js')}}"></script>

    {{-- <script src="{{asset('costumer/js/jquery.slicknav.js')}}"></script> --}}
    <script src="{{asset('costumer/js/mixitup.min.js')}}"></script>
    <script src="{{asset('costumer/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('costumer/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('costumer/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('costumer/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('costumer/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('costumer/js/testimoni.js')}}"></script>

    <!-- Bootstrap JS -->
    <script>
        // Function to show the selected slide based on thumbnail click
        function showSlide(slideIndex) {
            $('#imageCarousel').carousel(slideIndex); // Activate the carousel with specified slide index
        }

    </script>

<script>
    function calculateTotal() {
      var total = 0; //Inisialisasi variabel total dengan nilai 0.
      $('.checkbox_ids:checked').each(function() { //Menggunakan selector $('.checkbox_ids:checked') untuk memilih semua checkbox dengan class checkbox_ids yang sedang dicek dan Looping menggunakan fungsi .each() untuk setiap checkbox yang dipilih.
        var price = parseFloat($(this).closest('tr').find('.item_price').data('price')); //Di dalam loop, mengambil nilai harga dari elemen dengan class .item_price yang berada dalam row (<tr>) terdekat dari checkbox yang sedang dicek. Nilai harga diambil dengan menggunakan .data('price') yang mengambil data price dari elemen tersebut.Mengkonversi nilai harga menjadi tipe data float dengan parseFloat().
        total += price; //Menambahkan nilai harga ke variabel total.
      });

      if (total > 0) {
        var total_string = 'Rp ' + formatPrice(total);
    //Jika total lebih besar dari 0, maka:
    //Variabel total_string dibuat dengan format 'Rp ' + formatPrice(total). Format ini digunakan untuk menampilkan harga dengan format mata uang.
    //Mengubah isi elemen dengan id total_price menjadi total_string, sehingga tampilan total harga diperbarui.
        $('#total_price').text(total_string);
      } else {
        $('#total_price').text('Rp 0');
      }
    //Jika total kurang dari atau sama dengan 0, maka:
    //Mengubah isi elemen dengan id total_price menjadi 'Rp 0', menunjukkan bahwa total harga adalah 0.
    }

    function formatPrice(price) { // Mendefinisikan fungsi formatPrice(price) yang menerima argumen price (harga).
      var price_string = price.toFixed(0).toString(); // Menggunakan fungsi .toFixed(0) untuk membulatkan harga ke angka tanpa desimal. dan Mengkonversi harga menjadi string dengan toString().
      var formatted_price = ''; //Mendefinisikan variabel formatted_price untuk menyimpan harga yang diformat.
      var last_index = price_string.length - 1; // Menghitung indeks terakhir dari harga dalam string dengan last_index = price_string.length - 1.

      for (var i = last_index; i >= 0; i--) { //Melakukan loop mundur dari indeks terakhir hingga indeks pertama harga.
        formatted_price = price_string[i] + formatted_price; //Di dalam loop, menambahkan setiap digit harga ke awal formatted_price dengan menggunakan formatted_price = price_string[i] + formatted_price.
        var digit_index_from_right = last_index - i; //Menghitung indeks digit dari kanan ke kiri dengan digit_index_from_right = last_index - i.
        if (digit_index_from_right % 3 == 2 && i > 0) { //Jika indeks digit dari kanan ke kiri merupakan kelipatan 3 (digit ke-2, 5, 8, dst.) dan bukan digit pertama, maka tambahkan tanda titik sebagai pemisah ribuan dengan formatted_price = '.' + formatted_price.
          formatted_price = '.' + formatted_price;
        }
      }

      return formatted_price; ////Mengembalikan formatted_price yang merupakan harga yang diformat dengan tanda titik sebagai pemisah ribuan.
    }


    function updateSelisih() {
    var totalHarga = 0;
    $('.checkbox_ids:checked').each(function() {
        var price = parseFloat($(this).closest('tr').find('.item_price').data('price'));
        totalHarga += price;
    });

    var totalBayar = parseFloat($('#total_bayar').val()) || 0;
    var selisih = totalBayar - totalHarga;

    $('#total_price').text('Rp ' + formatPrice(totalHarga));
    $('#selisih').text('Rp ' + formatPrice(selisih));
}

// Panggil updateSelisih() saat ada perubahan pada total bayar atau checkbox
$('#total_bayar').on('input', function() {
    updateSelisih();
});

$('.checkbox_ids').change(function() {
    updateSelisih();
});


    $(function() {
      // Checkbox all
      $('#select_all_ids').click(function() {
        $('.checkbox_ids').prop('checked', $(this).prop('checked'));//baris ini akan mengubah properti checked (centang) dari semua elemen dengan class checkbox_ids menjadi nilai yang sama dengan properti checked dari elemen yang diklik ($(this).prop('checked')).
        calculateTotal();
      });

      $('.checkbox_ids').click(function() {
        calculateTotal();
      });
    });

    </script>
  <script>
    $(document).ready(function() {
      // Ketika tombol "Tukar Tambah" diklik
      $('#toggleTableBtn').click(function() {
        $('#tableContainer').toggleClass('hidden'); // Tampilkan atau sembunyikan tabel
      });
    });
  </script>
{{--
<script>
    function updateSelisih() {
    var totalHarga = 0;
    $('.checkbox_ids:checked').each(function() {
        var price = parseFloat($(this).closest('tr').find('.item_price').data('price'));
        totalHarga += price;
    });

    var totalDiskon = 0;
    @foreach ($tradein as $tr)
        totalDiskon -=  totalDiskon;
    @endforeach

    var totalBayar = parseFloat($('#total_bayar').val()) || 0;
    var selisih = totalBayar - totalHarga - totalDiskon;

    $('#total_price').text('Rp ' + formatPrice(totalHarga));
    $('#hasil_kurang').text('Rp ' + formatPrice(selisih));
}

// Panggil updateSelisih() saat ada perubahan pada total bayar atau checkbox
$('#total_bayar').on('input', function() {
    updateSelisih();
});

$('.checkbox_ids').change(function() {
    updateSelisih();
});

</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('confirm') }}") {
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            myModal.show();
        }
    });
</script>


<!--ini untuk mengatur quantity secara otomatis-->
<script>
  // Mendefinisikan URL untuk pembaruan jumlah menggunakan route Laravel
const updateUrl = '{{ route('updateQuantity') }}';

// Fungsi untuk memperbarui jumlah produk dalam keranjang
function updateQuantity(cartId, inputElement) {
    // Ambil nilai input
    var newQuantity = parseInt(inputElement.value);

    // Validasi agar tidak kurang dari 1
    if (newQuantity < 1) {
        inputElement.value = 1; // Set nilai kembali menjadi 1
        alert('Jumlah tidak boleh kurang dari 1.'); // Tampilkan pesan peringatan
        return; // Hentikan proses jika nilai tidak valid
    }

    // Kirim permintaan pembaruan ke server menggunakan AJAX atau fetch API
    fetch(updateUrl, {
        method: 'POST', // Metode HTTP POST untuk mengirim data
        headers: {
            'Content-Type': 'application/json', // Jenis konten yang dikirim adalah JSON
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF untuk keamanan Laravel
        },
        body: JSON.stringify({ // Mengonversi objek ke JSON
            cart_id: cartId, // ID keranjang untuk diupdate
            new_quantity: newQuantity // Jumlah baru untuk produk dalam keranjang
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Terjadi kesalahan saat memperbarui jumlah.'); // Tangkap kesalahan jika terjadi
        }
        // Jika berhasil, reload halaman untuk memperbarui tampilan
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error); // Log kesalahan ke konsol
        alert('Terjadi kesalahan saat memperbarui jumlah.'); // Tampilkan pesan kesalahan kepada pengguna
    });
}
</script>
<script>
$(document).ready(function() {
    // Validasi Form Login
    $('#login_form').validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element); // Menempatkan pesan kesalahan di bawah elemen
        },
        submitHandler: function(form) {
            $.LoadingOverlay("show");
            // Lakukan pengiriman AJAX atau logika lainnya
            // Contoh AJAX request
            $.ajax({
                url: "{{ route('login') }}",
                type: "POST",
                data: $(form).serialize(),
                success: function(data) {
                    // Logika setelah berhasil
                    toastr.success(data.message, 'Success', { timeOut: 5000 });
                    form.reset();
                    // Tutup modal jika diperlukan
                    $('#loginModal').modal('hide');
                    $.LoadingOverlay("hide");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $.LoadingOverlay("hide");
                    var response = jqXHR.responseJSON;
                    var status = jqXHR.status;

                    if (status == '422') {
                        // Tampilkan pesan kesalahan validasi dari server
                        for (const property in response.errors) {
                            toastr.error(response.errors[property][0], 'Error', { timeOut: 5000 });
                        }
                    } else {
                        // Tampilkan pesan kesalahan umum
                        toastr.error('Internal server error.', 'Error', { timeOut: 5000 });
                    }
                    // Tampilkan kembali modal login jika diperlukan
                    $('#loginModal').modal('show');
                }
            });
        }
    });

    // Tombol Login Modal
    $('.login_button').on('click', function() {
        $('#registerModal').modal('hide');
        $('#loginModal').modal('show');
    });

    // Tombol Register Modal
    $('.register_button').on('click', function() {
        $('#loginModal').modal('hide');
        $('#registerModal').modal('show');
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
      });
    });
    </script>

<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@yield('js')

</body>

</html>
