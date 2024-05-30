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
                        <form action="{{route('addproducttocart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_detil->id_products }}">
                            <input type="hidden" name="price" value="{{ $product_detil->price }}">
                            <input type="number" name="quantity" id="sst" maxlength="12" max="{{$product_detil->quantity}}" value="1" min="1" title="Quantity:" class="input-text qty">

                        </div>
                        <div class="card-area d-flex align-items-center">
                            <button class="primary-btn ad">Tambah Keranjang</button>
                        </form>
                        <form action="{{ route('addproducttocart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_detil->id_products }}">
                            <input type="hidden" name="price" value="{{ $product_detil->price }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="primary-btn add"><i class="bi bi-cart" style="font-size: 25px;"></i></button>
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
                    <h1>Ulasan</h1>
                    <div style="max-height: 300px; overflow: auto;">
                        @foreach ($comments as $index => $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="mt-0">{{ $userNames[$index] }} :</h5>
                                            <p class="comment-text">{{ $comment }}</p>
                                            @if (isset($createdDates[$index]))
                                                <p class="comment-date text-muted">{{ $createdDates[$index]->diffForHumans() }}</p>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                            </div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

@endsection
