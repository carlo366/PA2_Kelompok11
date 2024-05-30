@extends('admin.layouts.template')
@section('main-content')

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3>Data Pembeli</h3>
                            @if ($order->status == 'proses')
                                <h5 class="card-title">Status: <span class="badge bg-warning text-dark status-badge">Proses</span></h5>
                            @elseif($order->status == 'tolak')
                                <h5 class="card-title">Status: <span class="badge bg-danger text-dark status-badge">{{$order->status}}</span></h5>
                            @elseif(in_array($order->status, ['terima', 'packaging', 'sedangperjalanan', 'selesai']))
                                <h5 class="card-title">Status: <span class="badge bg-success text-dark status-badge">{{$order->status}}</span></h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="order-info">
                                <h6>Nama: {{$order->nama}}</h6>
                                <h6>Phone Number: {{$order->phonenumber}}</h6>
                                <h6>Province: {{$order->province->name}}</h6>
                                <h6><strong>Kabupaten:</strong> {{ $order->regency->name }}</h6>
                                <h6><strong>Kecamatan:</strong> {{ $order->district->name }}</h6>
                                <h6><strong>Desa:</strong> {{ $order->village->name }}</h6>
                                <h6><strong>Alamat:</strong> {{ $order->alamat }}</h6>
                                <h6><strong>ZIP:</strong> {{ $order->zip }}</h6>
                            </div>
                            <hr>
                            <div class="request-section">
                                <h5>Request:</h5>
                                <p>{{$order->request}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h4 class="card-title">Detil Order Pemesanan</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">This is the right card with supporting text below as a natural lead-in to additional content.</p>
                            <div class="mb-3">
                                <span>Code Order:</span>
                                <span class="badge bg-primary">{{ $order->kodeorder }}</span>
                            </div>
                            <div class="mb-3">
                                <span>Metode:</span>
                                <span class="badge bg-secondary">{{ $order->metode }}</span>
                            </div>
                            @if ($order->metode == 'payment')
                                <div class="mb-3">
                                    <span>Status Pembayaran:</span>
                                    <span class="badge bg-primary">{{ $order->statuspembayaran }}</span>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Nama</th>
                                            <th>Product Img</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
            $grandTotal = 0;
        @endphp
                                        @foreach (json_decode($order->product_id) as $key => $productId)
                                            <tr>
                                                <td>{{ $productId }}</td>
                                                <td>{{ json_decode($order->product_nama)[$key] }}</td>
                                                <td><img src="{{ asset(json_decode($order->product_img)[$key]) }}" style="max-width: 100px; height: auto;" alt=""></td>
                                                <td>{{ json_decode($order->quantity)[$key] }}</td>
                                                <td>Rp {{ number_format(json_decode($order->price)[$key], 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                @php
                                            $quantity = json_decode($order->quantity)[$key];
                                            $price = json_decode($order->price)[$key];
                                            $total = $quantity * $price;
                                            $grandTotal += $total;

                                            @endphp
                                        @endforeach
                                        @if(isset($order->tradeinsid))
                                    <tr>
                                        <td>tukar tambah</td>
                                        @php
                                        $decodedArray = json_decode($order->tradein->name, true);
                                    @endphp
                                        <td></td>
                                        <td> <ul class="list-group">
                                            @if (is_array($decodedArray))
                                                @foreach ($decodedArray as $item)
                                                    <li class="d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            @foreach ($productImage->take(1) as $productIMG)
                                                                <div class="me-3">
                                                                    <img src="{{ asset($productIMG->image) }}" class="img-thumbnail" alt="Img" style="height: 100px; object-fit: cover;">
                                                                </div>
                                                            @endforeach
                                                            <span>{{ $item }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">Tidak ada data barang yang valid.</li>
                                            @endif
                                        </ul></td>
                                        <td></td>
                                        <td>Rp.{{number_format($order->tradein->price, 0, ',', '.') }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Sisa</td>
                                        <td>Rp.{{number_format($grandTotal - $order->tradein->price, 0, ',', '.') }}-</td>
                                    </tr>

                                        @endif
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Ongkir</td>
                                            @if(isset($order->tradeinsid))
                                            <td colspan="2"><span class="last">{{ 'Rp '.number_format((($order->totalprice - $grandTotal) + $order->tradein->price ), 0, ',', '.') }}</span></td>
                                            @else
                                            <td colspan="2"><span class="last">{{ 'Rp '.number_format(($order->totalprice - $grandTotal), 0, ',', '.') }}</span></td>
                                            @endif
                                            {{-- <p>{{($order->totalprice - $order->price)[$key])}}</p> --}}

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total Price :</td>
                                            <td>Rp {{ number_format($order->totalprice, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-end">Total Price: Rp {{ number_format($order->totalprice, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>




<div class="card">
<div class="card-header">
    @if ($order->metode == 'cod')
    <h4 class="card-title">Hasil</h4>
    <form action="{{ route('approvepem', $order->id_orders) }}" method="POST">
        @csrf <!-- Include CSRF token for security -->
        <button type="submit" class="btn btn-primary">Setuju pesanan</button>
    </form>

    <form action="{{route('rejectorder',$order->id_orders)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger me-2">Reject</button>
    </form>
    @endif
  </div>
  <div class="card-content">
    <div class="card-body">

        @if ($order->metode == 'payment')
        @if ($order->status == 'proses')
        @if ($order->statuspembayaran == 'Unpaid')
            @if ($order->img_bayar == null)
                <h5 class="card-title">Belum Upload Bukti Pembayaran</h5>
                <!-- Form untuk upload bukti pembayaran -->
                {{-- @elseif($order->status == 'packaging') --}}

                @else
                <h5 class="card-title">Bukti Pembayaran</h5>
                <img src="{{ asset($order->img_bayar) }}" alt="Bukti Pembayaran" style="max-width: 100%; height: auto;">
                <div class="mt-3">
                    <button class="btn btn-danger me-2">Hapus Bukti Pembayaran</button>
                    {{-- <a href="{{route('deletePaymentpem', $order->id_orders)}}" class="btn btn-danger">reject</a> --}}
                    <form action="{{ route('approvepem', $order->id_orders) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>                </div>


                    @endif
                    @endif
                    @endif
                    @if ($order->status == 'packaging')
                    <h5 class="card-title">Bukti Pembayaran</h5>
                    <img src="{{ asset($order->img_bayar) }}" alt="Bukti Pembayaran" style="max-width: 100%; height: auto;">
                    <br>
                    <a href="{{route('semua-pemesanan')}}" class="btn btn-danger">Back</a>
                    @endif
    @elseif ($order->status == 'cod')
    @endif


    </div>
  </div>
</div>
</div>

@endsection

