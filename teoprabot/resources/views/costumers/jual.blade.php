<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pasang Iklan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-title {
            margin: 0;
        }
        .btn-back {
            background-color: transparent;
            border: none;
            font-size: 24px;
        }
        .custom-select-wrapper select {
            width: 100%;
        }
        .image-preview img {
            max-width: 100px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .form-section-title {
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .btn-submit {
            background: linear-gradient(to bottom, #402218, #2B1700);
            border: none;
            color: #fff;
        }
        .btn-submit:hover {
            background: linear-gradient(to bottom, #2B1700, #402218);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <button class="btn-back" onclick="history.back()">
                <i class="bi bi-arrow-left-circle"></i>
            </button>
            <h2 class="form-title">Request Jual Barang</h2>
        </div>
<form action="{{ route('jualbarangs') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-category">
            <span><strong>Kategori Terpilih:</strong></span>
            @if ($selectedCategory)
            <input type="text" style="border: none;max-width:100%;width:3em;" value="{{ $selectedCategory->name_categories }}" name="kategory" readonly>
            @else
            <span>Belum ada kategori yang dipilih</span>
            @endif
            <a href="{{ route('jualcategory') }}" class="text-primary">Ubah</a>
        </div>
        <br>

              <div class="row mb-3">
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" id="fullname" name="nama" placeholder="Nama Lengkap" />
                </div>
                <div class="col-md-6 form-group" style="display: flex; align-items: center;">
                    <span style="margin-right: 10px;">+62</span>
                    <input type="tel" class="form-control" id="phonenumber" name="phonenumber" placeholder="Format: xxx-xxx-xxxx" required
                           oninput="this.value = this.value.replace(/\D/g, '').substring(0, 13);">
                </div>
            </div>

            <div class="mb-3">
                <select name="provinsi" id="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <option value="{{ $provinces->id }}" class="custom-select">{{ $provinces->name }}</option>
                </select>
            </div>

            <div class="mb-3">
                <select name="Kabupaten" id="kabupaten" class="form-control">
                    <option value="">Pilih Kabupaten</option>
                </select>
            </div>

            <div class="mb-3">
                <select name="kecamatan" id="kecamatan" class="form-control">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <div class="mb-3">
                <select name="desa" id="desa" class="form-control">
                    <option value="">Pilih Desa</option>
                </select>
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="alamat" id="address" rows="2" placeholder="Detail Alamat"></textarea>
            </div>

            <h4 class="form-section-title">Sertakan Beberapa Detail</h4>

            <div class="mb-3">
                <label for="merek" class="form-label">Nama Produk *</label>
                <input type="text" class="form-control" name="nameproduct" id="merek">
            </div>

            <div class="mb-3">
                <label for="merek" class="form-label">Kondisi *</label>
                <select name="kondisi" id="" class="form-control">
                <option value="Bekas">Bekas</option>
                <option value="Baru">Baru</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="inputDeskripsi" class="form-label">Deskripsi</label>
                <textarea id="summernote" name="deskripsi"></textarea>
            </div>

            <div class="mb-3">
                <label for="inputGambar" class="form-label">Gambar</label>
                <input type="file" name="images[]" multiple class="form-control" id="images">
                <div class="image-preview mt-3" id="imagePreview"></div>
            </div>

            <div class="mb-3">
                <label for="inputHargaAwal" class="form-label">Harga Dasar</label>
                <input type="number" class="form-control" placeholder="Harga" name="hargadasar" id="inputHargaAwal">
            </div>

            <button type="submit" class="btn btn-submit">Jual</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // Clear any existing previews

        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(file);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Deskripsi',
            tabsize: 2,
            height: 400
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#provinsi').change(function() {
            let id_provinsi = $(this).val();
            if(id_provinsi) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkabupatens') }}",
                    data: { id_provinsi: id_provinsi },
                    success: function(data) {
                        $('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#kabupaten').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
            }
        });

        $('#kabupaten').change(function() {
            let id_kabupaten = $(this).val();
            if(id_kabupaten) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkecamatans') }}",
                    data: { id_kabupaten: id_kabupaten },
                    success: function(data) {
                        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#kecamatan').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
            }
        });

        $('#kecamatan').change(function() {
            let id_kecamatan = $(this).val();
            if(id_kecamatan) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getdesas') }}",
                    data: { id_kecamatan: id_kecamatan },
                    success: function(data) {
                        $('#desa').html('<option value="">Pilih Desa</option>');
                        $.each(data, function(key, value) {
                            $('#desa').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#desa').html('<option value="">Pilih Desa</option>');
            }
        });
    });
</script>
</body>
</html>
