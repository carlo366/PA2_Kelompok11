@extends('costumers.layouts.template')
@section('title' | 'Keranjang')
@section('css')
    <style>
        li {
            list-style: none;
        }
            /* CSS untuk dropdown select */
    .custom-select-wrapper {
        /* position: relative; */
        /* over/flow: hidden; */
        /* height: 50px; Atur ketinggian dropdown */
    }
    .custom-select {
        width: 100%;
        height: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #fff;
        cursor: pointer;
        overflow-y: auto; /* Aktifkan scrollbar jika lebih panjang */
        max-height: 200px; /* Atur ketinggian maksimum */
    }
    </style>
@endsection
@section('main-content')
    <br><br><br>
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Detail Penagihan</h3>
                        <form action="{{route('placeorder')}}" class="row contact_form" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Nama Lengkap" />
                                </div>
                                <div class="col-md-6 form-group p_star" style="display: flex; align-items: center;">
                                    <span style="margin-right: 10px;">+62</span>
                                    <input type="tel" class="form-control" id="nohp" name="nohp" placeholder="Format: xxx-xxx-xxxx" required
                                           oninput="this.value = this.value.replace(/\D/g, '').substring(0, 13);">
                                </div>


                            </div>

                            <div class="col-md-12 form-group" >
                                <div class="custom-select-wrapper">
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>

                                            <option value="{{ $provinces->id }}" class="custom-select">{{ $provinces->name }}</option>
                                    </select>
                                </div>
                            </div>






                            <div class="col-md-12 form-group">
                                <div class="custom-select-wrapper">
                                    <select name="kabupaten" id="kabupaten" class="form-control">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>

                         <div class="col-md-12 form-group">
                                <div class="custom-select-wrapper">
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="">Pilih Kecamatan</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 form-group">
                                <div class="custom-select-wrapper">
                                    <select name="desa" id="desa" class="form-control">
                                        <option value="">Pilih Desa</option>

                                    </select>
                                </div>
                            </div>








                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip"
                                    placeholder="Postcode/ZIP" />
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="alamat" id="address" rows="1" placeholder="detail alamat"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Catatan Pesanan"></textarea>
                            </div>
                        </div>
                        @php
                    $total = 0;
                @endphp
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Produk Order</h2>

                            <ul class="list">
                                <li>
                                    <a href="#">Produk
                                        <span>Total</span>
                                    </a>
                                </li>
                                @foreach ($cart_items as $item)
                                @php
                                $product_name = App\Models\Products::where('id_products', $item->product_id)->value('name_products');
                            @endphp
                                     @php
                                     $product_id = $item->products->id_products; // Mengambil ID produk dari item keranjang
                                     $images = App\Models\Images_Products::where('product_id', $product_id)->latest()->first();
                                 @endphp

                                <li>
                                    <input type="checkbox" name="ids[]" style="display:none;" value="{{ $item->id }}" {{ in_array($item->id, $checkedItems) ? 'checked' : '' }}>
                                    <img src="{{ asset($images->image) }}" alt="" style="max-width: 50px; max-height: 50px;">
                                    <a href="#">{{$product_name}}
                                        <span class="middle">x{{$item->quantity}}</span>
                                        @php
                                        $count = $item->quantity * $item->price;
                                    @endphp
                                        <span class="last">{{ 'Rp '.number_format($count) }}</span>
                                    </a>
                                </li>
                                @php
                                $total = $total + $count;
                            @endphp
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal
                                        <span>{{ 'Rp '.number_format($total, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                                <li>

                                    @foreach ($tradein_items as $item)
                                    <a href="#">Tukar Tambah

                                        @if(in_array($item->id, $checkedItems))
                                        - Item ini tercentang
                                        @else
                                        <span>Ada</span>
                                        @endif
                                    </a>


                                </li>
                                <li>   <tr>
                                    @php
                                    // Decode the JSON string into a PHP array
                                    $decodedArray = json_decode($item->name, true);
                                @endphp
                                 <input type="checkbox" name="idt[]" style="display:none;" value="{{ $item->id }}" {{ in_array($item->id, $checkedItems) ? 'checked' : '' }}checked>
                                 <input type="hidden" value="{{$item->id}}" name="tradeinsid">
                                 @if (is_array($decodedArray))
                                 @foreach ($decodedArray as $nameItem)
                                     <li class="d-flex align-items-center">
                                         <div class="d-flex align-items-center">
                                             @foreach ($productImage->take(1) as $productIMG)
                                                 <div class="me-3">
                                                     <img src="{{ asset($productIMG->image) }}" class="img-thumbnail" alt="Img" style="height: 50px; object-fit: cover;">
                                                 </div>
                                             @endforeach
                                             <span>{{ $nameItem }}</span>
                                            </div>
                                        </li>
                                        @endforeach

                                        <li>
                                            <a href="#">Harga
                                                <input type="hidden" name="tradeinsid" value=" {{$item->id}}">
                                                <span>Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            </a>
                                        </li>
                             @endif
                                </tr>
                                @endforeach</li>
                                <li>
                                    @if(in_array($item->id, $checkedItems))
                                    <a href="#">Total
                                        <span>{{ 'Rp '.number_format($total, 0, ',', '.') }} </span>
                                        {{-- <input type="hidden" name="totalprice" value="{{$total}} "> --}}
                                    </a>
                                    @else
                                    <a href="#">
                                        <del>{{ 'Rp '.number_format($total, 0, ',', '.') }} </del>
                                        {{-- <input type="hidden" name="totalprice" value="{{$total}} "> --}}
                                    </a>
                                    @endif

                                </li>
                                <li>
                                    @if(in_array($item->id, $checkedItems))
                                    @else
                                    <a href="#">Hasil
                                    <span>{{ 'Rp '.number_format($total - $item->price, 0, ',', '.') }}</span>
                                    {{-- <input type="hidden" value="{{$total - $item->price}}" name="totalprice"> --}}
                                    </a>
                                    @endif
                                </li>

                                <li>
                                    <a href="#">ONGKIR
                                        <span><input type="text" style="border: none;background-color:transparent;text-align:right;" class="form-control" id="ongkir" name="ongkir" readonly></span>
                                    </a></li>

                                    <li>
                                        @if(in_array($item->id, $checkedItems))
                                       <a href="">Harga Total <span>
                                            <input type="text" class="form-control" id="total-harga" name="" style="border: none;background-color:transparent;text-align:right;" readonly>
                                            <input type="hidden" id="hidden-total-harga" name="totalprice">
                                        </span></a>
                                        @else
                                        <div>
                                            <span id="total-tukar-tambah-text"></span>
                                            <input type="hidden" id="hidden-total-tukar-tambah" name="totalprice">
                                            {{-- <input type="text" class="form-control" id="total-tukar-tambah-input"   readonly> --}}
                                        </div>


    @endif

                                    </li>
                            </ul>

                            <ul>

                            </ul>
                            <br><br>


                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="metode" value="cod" required>
                                    <label for="f-option5">COD</label>
                                    <div class="check"></div>
                                </div>
                                <p>Bayar di tempat.</p>
                            </div>
                            @if(in_array($item->id, $checkedItems))
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="metode" value="payment" required>
                                    <label for="f-option6">Payment</label>
                                    <div class="check"></div>
                                </div>
                                <p>Bayar melalui transfer atau kartu kredit.</p>
                            </div>
                            @endif
                            <div class="creat_account">
                                {{-- <input type="checkbox" id="f-option4" name="selector" /> --}}
                                {{-- <label for="f-option4">I’ve read and accept the </label> --}}
                                {{-- <a href="#">terms & conditions*</a> --}}
                                <button type="submit" class="btn btn-success">Proses Pembayaran</button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
<script>
 $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateOngkir() {
    let selectedOption = $('#kabupaten option:selected');
    let ongkir = selectedOption.data('ongkir') || 0;
    let hargaItem = parseFloat("{{ $total }}"); // Harga item dari variabel PHP $item
    let totalHarga = hargaItem + ongkir;
    let totalTukarTambah = parseFloat("{{ $total - $item->price }}") + ongkir;

    // Tampilkan total harga dan total tukar tambah dalam format mata uang
    $('#ongkir').val(ongkir.toLocaleString('en-US', {maximumFractionDigits: 0}));
    $('#total-harga').val(totalHarga.toLocaleString('en-US', {maximumFractionDigits: 0}));
    $('#total-tukar-tambah-text').text('Total tukar tambah: Rp ' + totalTukarTambah.toLocaleString('en-US', {maximumFractionDigits: 0}));
    $('#total-tukar-tambah-input').val(totalTukarTambah.toLocaleString('en-US', {maximumFractionDigits: 0}));

    // Update nilai input yang hidden untuk disimpan di database
    $('#hidden-total-harga').val(totalHarga);
    $('#hidden-total-tukar-tambah').val(totalTukarTambah);
}



    $('#provinsi').on('change', function () {
        let id_provinsi = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('getkabupaten') }}",
            data: { id_provinsi: id_provinsi },
            cache: false,
            success: function (data) {
                $('#kabupaten').html(data);
                $('#kecamatan').html('');
                $('#desa').html('');
            },
            error: function (data) {
                console.log('error', data);
            },
        });
    });

    $('#kabupaten').on('change', function () {
        updateOngkir();

        let id_kabupaten = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('getkecamatan') }}",
            data: { id_kabupaten: id_kabupaten },
            cache: false,
            success: function (data) {
                $('#kecamatan').html(data);
                $('#desa').html('<option value="">Pilih Desa</option>');
            },
            error: function (data) {
                console.log('error', data);
            },
        });
    });

    $('#kecamatan').on('change', function () {
        let id_kecamatan = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('getdesa') }}",
            data: { id_kecamatan: id_kecamatan },
            cache: false,
            success: function (data) {
                $('#desa').html(data);
            },
            error: function (data) {
                console.log('error', data);
            },
        });
    });

    $('#desa').on('change', function () {
        let id_desa = $(this).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('getdesa') }}",
            data: { id_desa: id_desa },
            cache: false,
            error: function (data) {
                console.log('error', data);
            },
        });
    });


});

</script>

@endsection
