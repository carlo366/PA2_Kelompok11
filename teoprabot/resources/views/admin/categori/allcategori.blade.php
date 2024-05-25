@extends('admin.layouts.template')
@section('title','Admin | All Kategori')
@push('css')
<link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
@endpush
@section('main-content')


<!--Form Add Kategori  -->
<div class="modal fade text-left" id="tambahkategori" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel33">Tambah Kategori</h4>

                    </div>
                    <form action="{{ route('storekategori') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label>Nama Kategori</label>
                            <div class="form-group">
                                <input type="text" name="namakategori" placeholder="Nama Kategori" class="form-control" required oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);" autofocus>
                            </div>

                            <label>Gambar</label>
                            <div class="form-group">
                                <input type="file" name="image" placeholder="Nama Kategori" class="form-control" required >
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>

                </div>
                </div>
            </div>

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kategori</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="pb-3 pt-4"><button type="button" class="btn btn-success p-3"  data-bs-toggle="modal" data-bs-target="#tambahkategori"> Tambah Kategori</button></div>
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
                            <th>Nama Kategori</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$category->name_categories}}</td>
                            <td><img src="{{asset($category->image)}}" style="width: 5em;" alt=""></td>
                            <td>
                                <a href="{{route('editcategory', $category->id_categories)}}" class="btn btn-warning">Edit</a>
                                <a href="#" onclick="confirmDelete('{{ $category->id_categories }}')" data-name="" class="btn btn-danger">Hapus</a>
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

    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 3000);
    </script>
@endpush
