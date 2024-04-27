@extends('admin.layouts.template')
@section('title','Admin | All Produk')
@push('css')
<link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/choices.js/choices.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.snow.css')}}">
@endpush
@section('main-content')


            <!--Table Produk -->

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Gambar Produk </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Semua Produk</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



    <section class="section">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>

                @endif
                <div class="col-sm-4">
                    <p class="fw-bold mb-0">Nama Produk:</p>
                    <h3 class="mb-3">{{$product->name_products}}</h3>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-width: 400px;">
                        <ol class="carousel-indicators">
                            @foreach ($productImage as $key => $productImag)
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($productImage as $key => $productImag)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($productImag->image) }}" class="d-block w-100" alt="Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <br>
                <hr>

                    <form action="{{ route('storegambar', $product->id_products) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="images">Kirim Gambar (Max:20 images only)</label>
                            <input type="file" name="images[]" multiple class="form-control" id="images">
                            @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>


                </div>
                <div class="col-md-12 mt-4">
                    @foreach ( $productImage as $productIMG)
                        <img src="{{asset($productIMG->image)}}" class="border p-2 m-3" style="width:100px;height:100px" alt="Img">
                        <a href="{{route('hapusgambar',$productIMG->images_id)}}">Hapus</a>
                    @endforeach
                </div>

            </div>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{route('adminallkategori')}}" class="btn btn-light-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
