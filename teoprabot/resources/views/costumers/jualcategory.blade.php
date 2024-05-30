<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasang Iklan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
          body {
            background-color: #f8f9fa;
            padding: 2rem;
            animation: fade-in 1s ease-in-out;
        }
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fade-in 1s ease-in-out;
        }
        .form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-category {
            margin-bottom: 1rem;
        }
        .form-section-title {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .btn-back {
            background: none;
            border: none;
            color: #007bff;
            font-size: 1.5rem;
        }
        .btn-primary {
            background: linear-gradient(to bottom, #402218, #2B1700);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(to bottom, #2B1700, #402218);
        }
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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
            <h2 class="form-title">Request jual</h2>
        </div>

        <form method="POST" action="{{ route('saveCategory') }}">
            @csrf
            <h4 class="form-section-title">Pilih Kategori</h4>
            <div class="mb-3">
                <label for="merek" class="form-label">Kategori</label>
                <select id="merek" class="form-select" name="merek" required>
                    @foreach ($category as $cat)
                    {{-- <option selected>Pilih Merek</option> --}}
                    <option value="{{$cat->id_categories}}">{{$cat->name_categories}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </form>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>
</html>
