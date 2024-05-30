{{-- View (admin/statistik/index.blade.php) --}}
@extends('admin.layouts.template')

@section('main-content')
<div class="card-body">
    <form action="{{ route('chart') }}" method="GET">
        <label for="year">Tahun:</label>
        <select name="year" id="year">
            @for ($y = date('Y'); $y >= 2010; $y--)
                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button type="submit" style="">Filter</button>

    </form>

    <canvas id="orderChart" width="800" height="400"></canvas>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('orderChart').getContext('2d');

        var ordersData = @json($ordersData);

        var labels = ordersData.map(function (order) {
            return 'Bulan ' + order.month;
        });

        var totalPrices = ordersData.map(function (order) {
            return order.total_price;
        });

        // Menentukan langkah (step size) pada sumbu Y agar sesuai dengan total harga tiap bulan
        var minPrice = Math.min(...totalPrices);
        var maxPrice = Math.max(...totalPrices);
        var stepSize = (maxPrice - minPrice) / 5; // Membagi rentang harga menjadi 5 langkah

        var orderChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Harga',
                    data: totalPrices,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        min: minPrice,
                        max: maxPrice,
                        ticks: {
                            stepSize: stepSize,
                            callback: function (value) {
                                return value.toLocaleString(); // Format angka dengan pemisah ribuan
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
