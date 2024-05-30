@extends('costumers.layouts.template')
@section('main-content')
<div class="container mt-4">
    <!-- Button Back -->
    <div class="d-flex justify-content-start mb-2">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <h4>Semua Request Perbaikan</h4><br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>nama product</th>
                    <th>kondisi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($reprasi as $re)

                <tr>
                    <td>1</td>
                    <td>{{$re->nama}}</td>
                    <td>{{$re->nameproduct}}</td>
                    <td>{{$re->kondisi}}</td>
                    @if ($re->status == null)
                    <td>proses</td>
                    @else
                    <td>{{$re->status}}</td>
                    @endif
                    <td><a href="{{route('reprasi.show',$re->id)}}" class="btn btn-info">Detil</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Button Request Perbaiki -->
    <div class="d-flex justify-content-start mt-2">
        <a href="{{route('perbaiki')}}" class="btn btn-success ">
            Request Perbaiki
        </a>
    </div>
</div>
<br><br><br><br><br><br><br>
@endsection

