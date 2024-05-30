@extends('costumers.layouts.template')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('main-content')
<div class="container hidden" id="tableContainer">
    <ul>
                <h2 class="mt-5 mb-3">Form Request Perbaikan</h2>

                <form id="formTambah" method="POST" action="{{ route('repraibarangs') }}" enctype="multipart/form-data">
                    @csrf
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

                      <div class="mb-3">
                          <label for="inputNama" class="form-label">Nama</label>
                          <div id="formContainer">
                              <div class="input-group pb-2">
                                  <input type="text" class="form-control inputNama" name="nameproduct" placeholder="Masukkan nama produk" required>
                              </div>
                          </div>
                      </div>
                    <div class="mb-3">
                        <label for="inputJenis" class="form-label">Jenis</label>
                        <select class="form-control" style="width: 100%" id="id_categories" name="kategory">
                            @foreach ($kategori as $kateg)
                                <option value="{{ $kateg->id_categories }}">{{ $kateg->name_categories }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="inputKondisi" class="form-label">Kondisi</label>
                        <select class="form-control" name="kondisi" style="width: 100%" required>
                            <option value="Bekas">Bekas</option>
                            <option value="Baru">Baru</option>
                        </select>
                    </div>
                    <div class="mb-3">
                            <label for="inputGambar" class="form-label">Gambar</label>
                            <label for="images">Kirim Gambar (Max:20 images only)</label>
                            <input type="file" name="images[]" multiple class="form-control" id="images">
                            <div class="image-preview mt-5" id="imagePreview"></div>
                               </div>
                            <div class="mb-3">
                                <label for="inputDeskripsi" class="form-label">Deskripsi</label>
                                <textarea id="summernote"  name="deskripsi" ></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="inputrequest" class="form-label">Permintaan perbaikan</label>
                                <textarea id="summernotee"  name="request" ></textarea>
                            </div>




                            <button type="submit" class="btn btn-success">Simpan</button>
                  </form>
              </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script>
    $('#summernote').summernote({
        placeholder: 'deskripsi',
      tabsize: 2,
      height: 400
});
  </script>
<script>

// Ambil konten dari Summernote saat form disubmit
$('form').submit(function() {
  var content = $('#summernote').summernote('code');
  // Hilangkan tag <p></p> dari konten
  content = content.replace(/<p>/g, '').replace(/<\/p>/g, '');
  // Set kembali konten tanpa tag <p></p>
  $('#summernote').summernote('code', content);
});
</script>

<script>
    $('#summernotee').summernote({
        placeholder: 'deskripsi',
      tabsize: 2,
      height: 400
});
  </script>
<script>

// Ambil konten dari Summernote saat form disubmit
$('form').submit(function() {
  var content = $('#summernotee').summernote('code');
  // Hilangkan tag <p></p> dari konten
  content = content.replace(/<p>/g, '').replace(/<\/p>/g, '');
  // Set kembali konten tanpa tag <p></p>
  $('#summernotee').summernote('code', content);
});
</script>

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
                    url: "{{ route('getkabupatenss') }}",
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
                    url: "{{ route('getkecamatanss') }}",
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
                    url: "{{ route('getdesass') }}",
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
    });</script>

@endsection
