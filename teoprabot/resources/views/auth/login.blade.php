<!doctype html>
<html lang="en">
  <head>
  	<title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('costumer/css/login.css')}}">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <img src="{{asset('costumer/img/logo.png')}}" style="width: 6em;padding:10px;" alt="" class="navbar-brand">
            <h4 class="text-light">Login</h4>
        </div>
    </nav>

    <!-- Tambahkan ikon back di sini -->
    <div class="container mt-5">
        <a href="{{route('dashboard')}}" onclick="history.back();"><i class="fa fa-arrow-left"></i></a>
    </div>
    <!-- Akhir dari ikon back -->

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Login</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form id="loginForm" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="email" required name="email" class="form-control inputath @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" required name="password" class="form-control inputath @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="background-color:#AF8260 ;border:#AF8260" class="inputath w-100 p-2">Login</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input id="remember_me" type="checkbox" name="remember">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Belum ada akun? <a data-toggle="tab" href="{{route('register')}}">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


  </body>
</html>
