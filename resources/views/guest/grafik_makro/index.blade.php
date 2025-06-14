@extends('partials.guest.index')

@section('css')
   
@endsection

@section('content') 
<div class="container">
    <h3 class="text-center mb-4">{{ $nama_data }}</h3>

    <!-- Loading Spinner -->
    <div id="loading-spinner" class="text-center my-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat grafik...</p>
    </div>

    <canvas id="grafikMakroChart" style="display: none;"></canvas>
</div>

    

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikMakroChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($tahun) !!},
            datasets: [
                {
                    label: '{{ $nama_data }}',
                    data: {!! json_encode($data) !!},
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointRadius: 5
                },
                {
                    label: 'Nasional',
                    data: {!! json_encode($nasional) !!},
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                onComplete: () => {
                    // Sembunyikan spinner
                    document.getElementById('loading-spinner').style.display = 'none';
                    // Tampilkan grafik
                    document.getElementById('grafikMakroChart').style.display = 'block';
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Nilai'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                }
            }
        }
    });
</script>

@endsection