<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'pagetitle')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('costumer/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('costumer/css/linearicons.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link href="{{asset('costumer/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('costumer/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('costumer/css/nice-select.css')}}" type="text/css">
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

  <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

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

            <div class="header__top__right__auth">
                <a href="#" id=""  data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-user"></i> Login/Register</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
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
                <li>Free Shipping for all Order of $99</li>
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
                                <li class=" text-light">Free Shipping for all Order of $99</li>
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
                                            <img src="{{asset('admin/images/avatar/avatar-1.png')}}" class="rounded-circle me-2" alt="Profile Picture" width="40">
                                            <span class="user-name">{{Auth::user()->name}}</span>
                                            <div>

                                            </div>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
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
<!-- Modal Form Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
      <div class="modal-content rounded-5">
        <div class="modal-header text-white">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" action="{{route('login')}}" method="POST">
            @csrf
            <h3 class="text-start mb-4">Masuk</h3> <!-- Added 'text-start' class and mb-4 for margin bottom -->
            <div class="mb-3">
              <label for="email" class="col-form-label float-start col-form-label-start">email</label> <!-- Added 'col-form-label-start' class -->
              <input type="email" name="email" class="form-control inputath" id="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label for="password"  class="col-form-label float-start col-form-label-start">Password</label> <!-- Added 'col-form-label-start' class -->
              <input type="password" name="password" class="form-control inputath" id="password" placeholder="Password">
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
          <p class="text-muted text-center mb-5">Belum punya akun? <a href="#" class="" style="color: blue;" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Daftar</a></p>
        </div>

      </div>
    </div>
  </div>


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
                            <input class="form-control " type="text" placehaolder="Search any product...">
                            <i class="bx bx-search"></i>

                      </div>

                        <!-- Navigation menu -->
                        <div class="content">
                            <ul class="header__menu__horizontal ">
                                <li class="actie text-light"><a href="./index.html" class="text-light">Home</a></li>
                                <li><a href="./shop-grid.html" class="text-light">Shop</a></li>
                                <li><a href="#" class="text-light">Pages</a>
                                    <ul class="header__menu__dropdown" class="text-light">
                                        <li><a href="./shop-details.html" class="text-light">Shop Details</a></li>
                                        <li><a href="./shoping-cart.html" class="text-light">Shoping Cart</a></li>
                                        <li><a href="./checkout.html" class="text-light">Check Out</a></li>
                                        <li><a href="./blog-details.html" class="text-light">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.html" class="text-light">Blog</a></li>
                                <li><a href="./contact.html" class="text-light">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>




                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="bi bi-bell text-light"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="bi bi-cart text-light"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price"><button class="btn btn-success jualbeli" style="padding:0.01em 3em;">+ <span class="text-dark">Jual</span></button></div>
                        <div class="header__cart__price"><button class="btn btn-success jualbeli" style="padding:0.01em 2em;margin:0.5em 0em;">+ <span  class="text-dark">Perbaiki</span></button></div>

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


    <!-- Js Plugins -->
    <script src="{{asset('costumer/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('costumer/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('costumer/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('costumer/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('costumer/js/jquery.slicknav.js')}}"></script>
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





</body>

</html>
