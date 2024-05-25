
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
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Kode Pesanan</th>
            <th scope="col" class="text-center">Produk Nama</th>
            <th scope="col" class="text-center">Jumlah</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Aksi</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($order as  $key => $or)
        <tr>
            <td>{{$key + 1 }}</td>
            <td>{{$or->kodeorder}}</td>
            <td>{{$or->product_id}}</td>
            <td>{{$or->totalprice}}</td>
            <td>{{$or->status}}</td>
            <td><button class="btn btn-success">Detil</button>
                <button id="pay-button" class="btn btn-secondary">Bayar</button></td>
<form action="{{route('payment_post')}}" id="submit_form" method="POST">
    @csrf
    <input type="hidden" name="json" id="json_callback">
</form>
                <button id="pay-button" class="btn btn-success">Pay!</button>


        </tr>
        @endforeach

    </tbody>
</table>
@endif
@endsection
@section('js')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snap_token}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
            send_response_to_form(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
            send_response_to_form(result);

          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
            send_response_to_form(result);

          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
    });

    function send_response_to_form(result){
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
    }
  </script>
  @endsection
