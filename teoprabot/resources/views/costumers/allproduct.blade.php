@extends('costumers.layouts.template')

@section('main-content')
@section('css')
<link rel="stylesheet" href="{{asset('costumer/css/style2.css')}}">
@endsection
@php
$minPrice = $products->min('price');
$maxPrice = $products->max('price');
@endphp

<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <div class="left_dorp">
                        <select class="sorting" id="sorting">
                            <option value="default">Default sorting</option>
                            <option value="name_asc">Sort by name: A to Z</option>
                            <option value="name_desc">Sort by name: Z to A</option>
                            <option value="price_asc">Sort by price: low to high</option>
                            <option value="price_desc">Sort by price: high to low</option>
                        </select>
                        <input type="search" class="p-2" style="border:none" id="searchInput" placeholder="Cari ...">
                    </div>
                </div>

                <div class="latest_product_inner">
                    <div class="row" id="productGrid">

                        @foreach ($products as $product)
                        @php
                        $product_id = $product->id_products; // Mengambil ID produk dari item keranjang
                        $images = App\Models\Images_Products::where('product_id', $product_id)->latest()->first();
                        @endphp

                        <div class="col-lg-4 col-md-6 cardColumn" data-category="{{$product->category->name_categories}}" data-name="{{$product->name_products}}" data-price="{{$product->price}}">
                            <a href="{{route('produkdetail', $product->id_products)}}" class="aa">
                                <div class="single-product">
                                    <div class="product-img">
                                        @if(!empty($images->image))
                                        <img class="card-img" src="{{$images->image}}" alt="" style="height:15em;" />
                                        @else
                                        <p class="card-img" style="padding: 6.2em 2em 6.26em 2em;border:1px solid black;">Tidak ada gambar tersedia</p>
                                        @endif
                                    </div>
                                    <div class="product-btm">
                                        <h4><b>{{$product->name_products}}</b></h4>
                                        <div class="">
                                            <p style="font-size: 13px">Kategori : {{$product->category->name_categories}}</p>
                                        </div>
                                        <div class="mt-3">
                                            <span class="mr-4" style="font-size: 15px">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="text-end mt-2">
                                            @php
                                            $created_at = \Carbon\Carbon::parse($product->created_at);
                                            $today = \Carbon\Carbon::now()->startOfDay();
                                            if ($created_at->isSameDay($today)) {
                                                $date_text = 'Hari ini';
                                            } elseif ($created_at->isYesterday()) {
                                                $date_text = 'Kemarin';
                                            } else {
                                                $date_text = $created_at->format('d M Y');
                                            }
                                            @endphp
                                            <p style="font-size: 12px;">{{ $date_text }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach

                    </div>
                    <div class="no-results text-center mt-4" style="display:none;">
                        <p>Belum ada Berita Terbaru</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach ($categories as $category)
                                <li>
                                    <a href="{{route('category',$category->id_categories)}}" class="categoryFilter" data-category="{{$category->name_categories}}">{{$category->name_categories}}</a>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{route('semuaproduk')}}" class="categoryFilter" data-category="all">All Categories</a>
                                </li>
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Price Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <div class="range_item">
                                <div id="slider-range"></div>
                                <div class="">
                                    <label for="amount">Price : </label>
                                    <input type="text" id="amount" readonly />
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            var $cardColumns = $('.cardColumn');

            $cardColumns.each(function () {
                var cardText = $(this).text().toLowerCase();
                if (cardText.indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($cardColumns.filter(':visible').length === 0) {
                $('.no-results').show(); // Show a message if no results found
            } else {
                $('.no-results').hide(); // Hide the message if there are results
            }
        });


        $('#sorting').on('change', function () {
            var sortValue = $(this).val();
            var $productGrid = $('#productGrid');
            var $products = $('.cardColumn');

            $products.sort(function (a, b) {
                var an = $(a).data('name').toLowerCase(),
                    bn = $(b).data('name').toLowerCase(),
                    ap = parseFloat($(a).data('price')),
                    bp = parseFloat($(b).data('price'));

                if (sortValue === 'name_asc') {
                    return an > bn ? 1 : an < bn ? -1 : 0;
                } else if (sortValue === 'name_desc') {
                    return an < bn ? 1 : an > bn ? -1 : 0;
                } else if (sortValue === 'price_asc') {
                    return ap > bp ? 1 : ap < bp ? -1 : 0;
                } else if (sortValue === 'price_desc') {
                    return ap < bp ? 1 : ap > bp ? -1 : 0;
                } else {
                    return 0;
                }
            });

            $products.detach().appendTo($productGrid);
        });

        // Show "Belum ada Berita Terbaru" message if no news articles available
        if ($('.cardColumn').length === 0) {
            $('.no-results').show();
        }
    });
    $(document).ready(function () {
    // Inisialisasi slider
    $("#slider-range").slider({
        range: true,
        min: {{$minPrice}},
        max: {{$maxPrice}},
        values: [{{$minPrice}}, {{$maxPrice}}],
        slide: function (event, ui) {
            $("#amount").val("Rp " + ui.values[0].toLocaleString('id') + " - Rp " + ui.values[1].toLocaleString('id'));
        },
        stop: function (event, ui) {
            var minPrice = ui.values[0];
            var maxPrice = ui.values[1];
            $(".cardColumn").each(function () {
                var productPrice = parseFloat($(this).data("price"));
                if (productPrice >= minPrice && productPrice <= maxPrice) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($(".cardColumn:visible").length === 0) {
                $(".no-results").show();
            } else {
                $(".no-results").hide();
            }
        }
    });
    $("#amount").val("Rp " + $("#slider-range").slider("values", 0).toLocaleString('id') + " - Rp " + $("#slider-range").slider("values", 1).toLocaleString('id'));

    // Penanganan perubahan rentang harga saat slider digunakan
    $("#slider-range").on("slidechange", function (event, ui) {
        var minPrice = ui.values[0];
        var maxPrice = ui.values[1];
        $(".cardColumn").each(function () {
            var productPrice = parseFloat($(this).data("price"));
            if (productPrice >= minPrice && productPrice <= maxPrice) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        if ($(".cardColumn:visible").length === 0) {
            $(".no-results").show();
        } else {
            $(".no-results").hide();
        }
    });
});



</script>
@endsection
