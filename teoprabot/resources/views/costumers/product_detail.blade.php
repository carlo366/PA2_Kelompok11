@extends('costumers.layouts.template')
@section('main-content')

<br><br>
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

	<!--================Single Product Area =================-->
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <!-- Carousel Container -->
                <div id="imageCarousel" class="carousel slide carousel-thumbnails product-images" data-bs-ride="carousel">

                    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $key => $productImag)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($productImag->image) }}"  class="d-block imagedetil" alt="Slide 1">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Thumbnail Images -->
                    <div class="thumbnail-images text mt-3">
                        @foreach ($images as $key => $productImag)
                        <img src="{{ asset($productImag->image) }}" alt="Thumbnail {{ $key + 1 }}" onclick="showSlide({{ $key }})">
                    @endforeach
                    </div>
                    <br><br>

                    <!-- Carousel Controls -->
                </div>
            </div>
            <div class="col-lg-5">
                <div class="s_product_text">
                    <h3>{{$product_detil->name_products}}</h3>
                    <h2>Rp {{ number_format($product_detil->price, 0, ',', '.') }}</h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Kategori</span> : {{$product_detil->category->name_categories}}</a></li>
                        <li><a href="#"><span>Stok</span> : {{$product_detil->quantity}}</a></li>
                    </ul>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, recusandae error sapiente numquam, asperiores pariatur architecto magnam temporibus impedit repellendus, dicta amet nesciunt! Quas magni laboriosam quisquam amet numquam dicta!</p>
                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="number" name="qty" id="sst" maxlength="12" value="1" min="1" title="Quantity:" class="input-text qty">

                    </div>
                    <div class="card-area d-flex align-items-center">
                        <a class="primary-btn ad" href="#">Tambah Keranjang</a>
                        <form action="{{ route('addproducttocart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_detil->id_products }}">
                            <input type="hidden" name="price" value="{{ $product_detil->price }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="primary-btn ad">Beli Sekarang</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link  active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					 aria-selected="false">Specification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>{{$product_detil->description_products}}</p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Lebar</h5>
									</td>
									<td>
										<h5>{{$product_detil->width}} CM</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Tinggi</h5>
									</td>
									<td>
										<h5>{{$product_detil->length}} CM</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Check</h5>
									</td>
									<td>
										<h5>yes</h5>
									</td>
								</tr>

								<tr>
									<td>
										<h5>Warna</h5>
									</td>
									<td>
										<h5>{{$product_detil->color}}</h5>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>

				<div class="tab-pane fade " id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>4.0</h4>
										<h6>(03 Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on 3 Reviews</h3>
										<ul class="list">
											<li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
													 class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-1.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>
								<p>Your Rating:</p>
								<ul class="list">
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
								</ul>
								<p>Outstanding</p>
								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="primary-btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

@endsection
