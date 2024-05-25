@extends('admin.layouts.template')
@section('title','Admin | All Produk')
@push('css')
<link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/choices.js/choices.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.snow.css')}}">
@endpush
@section('main-content')
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
    </div>
    <form action="{{ route('updateproduk') }}" method="POST">
        @csrf
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h6>Nama Produk</h6>
                        <input class="form-control form-control-lg" type="hidden" name="id_products" value="{{$produkdetil->id_products}}" placeholder="Nama Produk">
                        <input class="form-control form-control-lg" type="text" name="name_products" value="{{$produkdetil->name_products }}" placeholder="Nama Produk">
                    </div>
                    <br>
                    <div class="basic-choices">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h6>Kategori</h6>
                                <div class="form-group">
                                    <select class="form-select" name="product_category_id">
                                        @foreach ($category as $cat)
                                        <option value="{{$cat->id_categories}}">{{$cat->name_categories}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <h6>Deskripsi Produk</h6>
                        <div class="form-group mb-3">
                            <textarea id="summernote" name="description_products">{{$produkdetil->description_products}}</textarea>
                        </div>
                    </section>
                    <br>

                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" class="form-control" id="harga" name="price" min="0" value="{{$produkdetil->price}}" placeholder="Masukkan harga">
                    </div>

                    <div class="form-group" style="display: inline-block;">
                        <label for="length">Length:</label>
                        <input type="number" class="form-control" id="length" name="length" value="{{$produkdetil->length}}" min="0" placeholder="Masukkan panjang">
                    </div>

                    <div class="form-group" style="display: inline-block; margin-left: 10px;">
                        <label for="width">Width:</label>
                        <input type="number" class="form-control" id="width" name="width" value="{{$produkdetil->width}}" min="0" placeholder="Masukkan lebar">
                    </div>

                    <div class="form-group" style="display: inline-block; margin-left: 10px;">
                        <label for="color">Color:</label>
                        <input type="text" class="form-control" id="color" name="color" value="{{$produkdetil->color}}" placeholder="Masukkan warna">
                    </div>

                    <div class="form-group">
                        <label for="quantity">quantity:</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" min="0" value="{{$produkdetil->quantity}}" placeholder="Masukkan harga">
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{route('adminallkategori')}}" class="btn btn-light-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection

@push('js')
<script src="{{asset('admin/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('admin/js/vendors.js')}}"></script>
<script src="{{asset('admin/vendors/choices.js/choices.min.js')}}"></script>
<script src="{{asset('admin/vendors/quill/quill.min.js')}}"></script>
<script src="{{asset('admin/js/pages/form-editor.js')}}"></script>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
    $('#summernote').summernote({
    placeholder: 'Isi Deskripsi',
    tabsize: 2,
    height: 300,
    callbacks: {
      onInit: function() {
        // Menghapus tag <p></p> dari konten awal saat editor diinisialisasi
        var content = $(this).summernote('code');
        // Menghapus tag <p></p> dari awal konten jika ada
        if (content.startsWith('<p>') && content.endsWith('</p>')) {
          content = content.substring(3, content.length - 4);
        }
        $(this).summernote('code', content);
      }
    }
    });
    });


          </script>
@endpush
