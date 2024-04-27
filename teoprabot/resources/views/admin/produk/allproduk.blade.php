    @extends('admin.layouts.template')
    @section('title','Admin | All Produk')
    @push('css')
    <link rel="stylesheet" href="{{asset('admin/vendors/choices.js/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/quill/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/simple-datatables/style.css')}}">
    @endpush
    @section('main-content')

    <!--Form Add Kategori  -->
    <div class="modal fade text-left" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Produk</h4>
                </div>
                <section class="section">
                    <!-- Hilangkan kelas card -->
                    <div class="card-body">
                        <div class="col">
                            <h6>Nama Produk</h6>
                            <form action="{{route('storeproduk')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <input class="form-control form-control-lg" id="name_products" name="name_products" type="text" placeholder="Nama Produk">
                        </div>
                        <br>
                        <div class="basic-choices">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6>Kategori</h6>
                                    <div class="form-group">
                                        <select class="" id="id_categories" name="id_categories">
                                            @foreach ($categories as $categori)
                                            <option value="{{$categori->id_categories}}">{{$categori->name_categories}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="section">
                            <h6>Deskripsi Produk</h6>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                <textarea class="form-control" name="description_products" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </section>
                        <br>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" class="form-control" id="harga" name="harga" min="0" placeholder="Masukkan harga">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" placeholder="Masukkan jumlah">
                        </div>
                    </div>
                </section>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="Submit" onclick="" class="btn btn-primary">Tambah</button>
                </form>
                </div>
            </div>

        </div>
    </div>


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
            <div class="pb-3 pt-4"><button type="button" class="btn btn-success p-3"  data-bs-toggle="modal" data-bs-target="#tambahkategori">Tambah Produk</button></div>
        </div>
        <section class="section">
            <div class="card">

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                    <a href="{{route('editproduk')}}" class="btn btn-warning">Edit</a>
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
    @endpush
