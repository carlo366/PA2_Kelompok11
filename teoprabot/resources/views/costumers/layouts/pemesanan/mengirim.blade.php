
@php
    $userid = Auth::id();
    $totalorder = App\Models\Order::where('user_id', $userid)->count();
@endphp
@extends('costumers.layouts.pemesanan.templatepesan')
@section('css')
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-PjNjnewKVVbauwqL"></script>
@endsection
@section('pemesanan')
@if($totalorder == 0)
<div class="content-custom">
    <img src="https://example.com/clipboard-icon.png" alt="No orders">
    <p>No orders yet</p>
</div>
@else
<div class="table-responsive">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Kode Pesanan</th>
                <th scope="col" class="text-center">Produk Nama</th>
                <th scope="col" class="text-center">Jumlah</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Metode</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $key => $or)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $or->kodeorder }}</td>
                <td>{{ $or->product_id }}</td>
                <td>{{ $or->totalprice }}</td>
                <td>{{ $or->status }}</td>
                <td>{{ $or->metode }}</td>
                <td><a href="{{route('detilpemesanan',$or->id_orders)}}" class="btn btn-success">Detil</button></a>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif
@endsection
@section('js')
  @endsection
