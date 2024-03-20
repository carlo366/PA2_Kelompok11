@extends('admin.layouts.template')
@section('title','Admin | All Produk')
@push('css')
<link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
@endpush
@section('main-content')


            <!--Table Produk -->

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Semua Produk</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="pb-3 pt-4"><button type="button" class="btn btn-success p-3"> Tambah Produk</button></div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $produk)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$produk->name_products}}</td>
                            <td>{{ $produk->productCategory->name_categories}}</td>
                            <td>{{$produk->description_products}}</td>
                            <td>{{$produk->price}}</td>
                            <td>{{$produk->quantity}}</td>
                            <td><a href="{{route('indexgambar',$produk->id_products)}}" class="btn btn-info">Tambah Gambar</a></td>
                            <td>
                                <a href="" class="btn btn-warning">Edit</a>
                                {{-- <a href="#" onclick="confirmDelete('{{ $category->id_categories }}')" data-name="" class="btn btn-danger">Hapus</a> --}}
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
            text: "menambahkan kategori",
            icon: "success",
            dangerMode: true,
            button: false,
            time: 1500,
        })
    }
    </script>
@endpush
