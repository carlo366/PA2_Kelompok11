@extends('costumers.layouts.template')
@section('main-content')
@section('css')
<link rel="stylesheet" href="{{asset('costumer/css/style2.css')}}">
@endsection


    <div class="sliderr">
<div class="container">
    <div class="text-center">
        <div class="row">
          <div class="col-md-8 pt-3 ps-0 pe-0">



              <div class="banner">

                  <div class="container">

                      <div class="slider-container has-scrollbar">

                          @foreach ($slider as $slid )

                          <div class="slider-item">

                              <img src="{{asset($slid->gambar)}}" alt="women's latest fashion sale" class="banner-img">

                              <div class="banner-content">


                            </div>

                        </div>
                        @endforeach





              </div>

            </div>

          </div>

        </div>

        <div class="col-md-4 ">
            <div class="row gambarr">
                <div class="col-md-12 pt-3 pb-3 ps-0">
                    <div class="banner__pic">
                        <img src="{{asset('costumer/img/catsemprot.png')}}" class="img_slider" alt="">
                    </div>
                </div>
                <div class="col-md-12 ps-0">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" class="img_slider"  alt="">
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
<div class="top-category-box">
    <div class="container">
        <div class="category-box">
            <div class="category-container">

                @foreach ($category as $cat)

                <div class="category">
                    <div class="icon-text-container">
                        <a href="{{route('category',$cat->id_categories)}}">
                            <img src="{{$cat->image}}" alt="">
                            <p class="category-text">{{$cat->name_categories}}</p>
                        </a>
                        </div>
                </div>
                @endforeach

                <!-- Tambahkan kategori lainnya sesuai kebutuhan -->
            </div>
        </div>
        <hr>
    </div>
</div>


    </div>
    <!-- <div style="width: 100%;height:3em;background-color:#AF8260"></div> -->
<br><br><br>

      <div class="container produkk" >
        <div class="row justify-content-center" >
            <div class=" text-center" >
                <div class="section-title container-fluid"    >
                    <h1>Produk Terbaru</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore
                        magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">


            @foreach ($products->take(8) as $product)
            @php
            $product_id = $product->id_products; // Mengambil ID produk dari item keranjang
            $images = App\Models\Images_Products::where('product_id', $product_id)->latest()->first();
        @endphp

<div class="col-lg-3 col-md-6 cardColumn" >
<a href="{{route('produkdetail', $product->id_products)}}" class="aa">
<div class="single-product" style="border:1px solid rgb(220, 220, 220);">
                    <div class="product-img">
                        @if(!empty($images->image))
                        <img class="card-img" src="{{$images->image}}" alt="" style="height:15em;" />
                    @else
                        <p  class="card-img"  style="padding: 6.2em 2em 6.26em 2em;border:1px solid black;">Tidak ada gambar tersedia</p>
                    @endif

              </div>
              <div class="product-btm">
                  <h4><b>{{$product->name_products}}</b></h4>
                <div class="">
                    <p style="font-size: 13px">Kategori :{{$product->category->name_categories}}</p>
                </div>
                <div class="mt-3">
                    <span class="mr-4" style="font-size: 15px">Rp {{ number_format($product->price, 0, ',', '.') }}</span>

                </div>
                <div class="text-end mt-2">
                    @php
                    // Tanggal dari database atau variabel lain
                    $created_at = \Carbon\Carbon::parse($product->created_at);

                    // Tanggal hari ini
                    $today = \Carbon\Carbon::now()->startOfDay();

                    // Bandingkan tanggal
                    if ($created_at->isSameDay($today)) {
                        $date_text = 'Hari ini';
                    } elseif ($created_at->isYesterday()) {
                        $date_text = 'Kemarin';
                    } else {
                        $date_text = $created_at->format('d M Y');
                    }
                @endphp
<p style="font-size: 12px;">{{ $date_text }}</p>   </div>
            </div>
            </div>
        </a>
        <div>

        </div>
        </div>
        @endforeach



        </div>
    </div>
</div>


    <!-- Feature Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container feature py-5 px-lg-0" style="	background-color:#402218;
        ">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Fitur Kami</h6>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-headphones text-light fa-3x flex-shrink-0 text-light"></i>
                        <div class="ms-4">
                            <h5>Layanan Pelanggan 24/7</h5>
                            <p class="mb-0 text-light">Jangan Ragu untuk Hubungi Kami! Tim Layanan Pelanggan Kami
                                Siap Membantu Anda Setiap Saat</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-light fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Jangan Ragu untuk Hubungi Kami! Tim Layanan Pelanggan Kami
                                Siap Membantu Anda Setiap Saat</h5>
                            <p class="mb-0 text-light">Kami punya banyak pilihan perabotan baru dan bekas yang bisa
                                kamu jelajahi. Dengan begitu, kamu bisa menemukan sesuatu yang cocok dengan selera dan anggaranmu</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-light fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Opsi Tukar Tambah</h5>
                            <p class="mb-0 text-light">Tingkatkan koleksi perabotan Anda dengan mudah melalui program tukar tambah kami. Dapatkan nilai tukar yang bisa langsung digunakan untuk membeli perabotan baru, memudahkan Anda untuk menghadirkan suasana segar dalam dekorasi rumah Anda</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-light fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Solusi Pengiriman yang Fleksibel dan Terpercaya</h5>
                            <p class="mb-0 text-light">Kami siap menyediakan pengiriman yang sesuai dengan kebutuhan Anda, termasuk waktu dan jenis barang yang Anda kirimkan. Anda dapat mempercayai kami untuk pengiriman yang aman dan tepat waktu.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-light fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Solusi Pengiriman yang Fleksibel dan Terpercaya</h5>
                            <p class="mb-0 text-light">Layanan kami menawarkan perbaikan yang handal untuk barang-barang yang rusak. Dari perbaikan kecil hingga pemulihan total, kami siap membantu menjaga barang Anda tetap dalam kondisi terbaik."</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{asset('costumer/img/pengirim.jpg')}}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->



    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center">
                <h6 class="text-secondary text-uppercase">Riview </h6>
                <h1 class="mb-0">Customer Kami</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('costumer/img/testimonial-1.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('costumer/img/testimonial-2.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('costumer/img/testimonial-3.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('costumer/img/testimonial-4.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('img/testimonial-4.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('img/testimonial-4.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="{{asset('img/testimonial-4.jpg')}}" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1">Client Name</h5>
                            <p class="m-0">Profession</p>
                        </div>
                    </div>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection
