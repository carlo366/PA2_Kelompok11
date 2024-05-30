@extends('admin.layouts.template')
@section('title','Admin | All Tukar Tambah')
@push('css')
<link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
@endpush
@section('main-content')



<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tukar Tambah</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tukar Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">
                @if (session()->has('message'))
                <div id="alertMessage" class="alert alert-success">
                    {{ session()->get('message') }}
                </div>

                @endif

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Nama Barang</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($jual as $key => $tr)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$tr->user->name}}</td>
                            <td>{{$tr->nameproduct}}</td>
                            <td>{{$tr->kondisi}}</td>
                            <td>
                                <a href="{{route('detil-jual', $tr->id)}}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>


        </div>
    </div>
@endsection
@push('js')
<script src="{{asset('admin/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('admin/js/vendors.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  function confirmDelete(categoryId) {
        swal({
            title: "Yakin ingin menghapus?",
            text: "Data akan hilang jika dihapus!",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Hapus",
                    value: true,
                    visible: true,
                    className: "btn-danger",
                }
            },
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Jika pengguna menekan "Hapus", arahkan ke route delete dengan menyertakan ID
                window.location.href = "{{ route('deletecategori', ':id') }}".replace(':id', categoryId);
                swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    timer: 1500,
button:false,});
            } else {
                swal("Operasi dibatalkan.", {
                    icon: "info",
                    buttons: false,
                    timer: 1500,
                });
            }
        });
    }
    function berhasil() {
        swal({
            title: "Berhasil",
            text: "menambahkan Tukar Tambah",
            icon: "success",
            dangerMode: true,
            button: false,
            time: 1500,
        })
    }

    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 3000);
    </script>
@endpush
