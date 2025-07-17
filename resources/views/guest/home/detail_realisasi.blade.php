@extends('partials.guest.index')
@section('content') 

<div class="container mt-5">
    <h1 class="text-center display-6">Detail Realisasi <br> Bappeda Sumatera Barat {{$tahun}}</h1>

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <div class="d-flex mb-10">
            <div class="container">
                <div class="d-flex row align-items-stretch">
                    <div class="col-lg-6 mb-lg-0 mb-">
                        <div class="card h-100 rounded rounded-4 shadow-sm">
                            <div class="card-body">
                                <h3 class='fw-normal'>
                                    Total Pagu Anggaran 2025
                                </h3>
                                <h2>
                                    <span id="totalPagu"></span>
                                </h2>
                                <h3>
                                    Target sampai bulan ini
                                </h3>
                                <div class="row">
                                    <div class="col-4">
                                        <span class='text-black fs-3'>Fisik</span>
                                    </div>
                                    <div class="col-8">
                                        <span class='text-black fs-3'>: <span id="targetFisik"></span> %</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <span class='text-black fs-3'>Keuangan</span>
                                    </div>
                                    <div class="col-8">
                                        <span class='text-black fs-3'>: <span id="targetKeuangan"></span> / <span id="persenTarget"></span>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100 rounded rounded-4 shadow-sm">
                            <div class="card-body ">
                                <h3 class='fw-normal'>
                                    Realisasi Keseluruhan
                                </h3>
                                <h2>
                                    <span class="realisasiKeu"></span>
                                </h2>
                                <h3>
                                    Realisasi sampai bulan ini
                                </h3>
                                <div class="row">
                                    <div class="col-4">
                                        <span class='text-black fs-2'>Fisik</span>
                                    </div>
                                    <div class="col-8">
                                        <span class='text-black fs-2'>: <span id="realisasiFisik"></span> %</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <span class='text-black fs-3'>Keuangan</span>
                                    </div>
                                    <div class="col-8">
                                        <span class='text-black fs-3'>: <span  class="realisasiKeu"></span> / <span id="persenRKeu"></span>%</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <span class='text-black fs-3'>Deviasi Fisik / Keuangan</span>
                                    </div>
                                    <div class="col-8">
                                        <span class='text-black fs-3'>: <span id="deviasiFisik"></span>%  <span></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <canvas id="myChart" width="400" height="130"></canvas>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableMenu" class="table  table-row-bordered border border-dark border-1 rounded gy-5 gs-7">
                            <thead class='text-dark' >
                                <tr class="border-dark border-1 border">
                                    <th scope="col" rowspan="3" class='text-center border-1 border border-dark align-middle'>Program Kegiatan/Kegiatan/Subkegiatan</th>
                                    <th scope="col" rowSpan="3" class='text-center border-1 border border-dark align-middle'>PPTK Kegiatan</th>
                                    <th scope="col" rowSpan="3" class='text-center border-1 border border-dark align-middle'>Pagu</th>
                                    <th scope="col" colSpan="3" class='text-center border-1 border border-dark align-middle'>Fisik</th>
                                    <th scope="col" colSpan="5" class='text-center border-1 border border-dark align-middle'>Keuangan</th>
                                </tr>
                                <tr class="border-dark border-1 border">
                                    <th scope="col" rowSpan="2" class='text-center border-1 border border-dark align-middle'>Target</th>
                                    <th scope="col" rowSpan="2" class='text-center border-1 border border-dark align-middle'>Realisasi</th>
                                    <th scope="col" rowSpan="2" class='text-center border-1 border border-dark align-middle'>Deviasi</th>
                                    <th scope="col" colSpan="2" class='text-center border-1 border border-dark'>Target</th>
                                    <th scope="col" colSpan="2" class='text-center border-1 border border-dark'>Realisasi</th>
                                    <th scope="col">Deviasi</th>
                                </tr>
                                <tr class="border-dark border-1 border">
                                    <th scope="col" class='text-center border-1 border border-dark'>Rp</th>
                                    <th scope="col" class='text-center border-1 border border-dark'>%</th>
                                    <th scope="col" class='text-center border-1 border border-dark'>Rp</th>
                                    <th scope="col" class='text-center border-1 border border-dark'>%</th>
                                    <th scope="col" class='text-center border-1 border border-dark'>%</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body" class="text-black">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            const tahun = @json($tahun);
            console.log(tahun);
            
            const urlOld = "https://simbangda.sumbarprov.go.id/integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/72?tahun=2024";
            const url = `https://admin-dashboard.sumbarprov.go.id/api/simbangda/getrealisasikegiatanopd/72/${tahun}`;

            const grafikAkumulasiOld = "https://simbangda.sumbarprov.go.id/integrated/api/dashboard_pembangunan/grafik_akumulasi?id_instansi=72&tahun=2024";
            const grafikAkumulasi = `https://simbangda.sumbarprov.go.id/integrated/api/dashboard_pembangunan/grafik_akumulasi?id_instansi=72&tahun=${tahun}`;

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(number);
            }

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    const data = response.result;
                    console.log(data);
                    let tableRows = '';

                    data.data.forEach((opd) => {
                        // Baris untuk OPD (Program)
                        tableRows += `
                            <tr class="bg-success border-1 border border-dark">
                                <td class="border-1 border border-dark">${opd.nama_program}</td>
                                <td class="border-1 border border-dark">${opd.pptk || '-'}</td>
                                <td class="text-end border-1 border border-dark">${opd.pagu ? numberWithCommas(opd.pagu) : '-'}</td>
                                <td class="border-1 border border-dark">${opd.persen_target_fisik || '-'}</td>
                                <td class="border-1 border border-dark">${opd.persen_realisasi_fisik || '-'}</td>
                                <td class="border-1 border border-dark">${opd.deviasi_fisik || '-'}</td>
                                <td class="border-1 border border-dark">${opd.rp_target_keuangan ? numberWithCommas(opd.rp_target_keuangan) : '-'}</td>
                                <td class="border-1 border border-dark">${opd.persen_target_keuangan || '-'}</td>
                                <td class="border-1 border border-dark">${opd.rp_realisasi_keuangan ? numberWithCommas(opd.rp_realisasi_keuangan) : '-'}</td>
                                <td class="border-1 border border-dark">${opd.persen_realisasi_keuangan || '-'}</td>
                                <td class="border-1 border border-dark">${opd.deviasi_keuangan || '-'}</td>
                                
                            </tr>
                        `;

                        // Baris untuk Kegiatan
                        if (opd.data_kegiatan) {
                            opd.data_kegiatan.forEach((kegiatan) => {
                                tableRows += `
                                    <tr class="bg-warning border-1 border border-dark">
                                        <td class="border-1 border border-dark">${kegiatan.nama_kegiatan}</td>
                                        <td class="border-1 border border-dark">${kegiatan.pptk || '-'}</td>
                                        <td class="text-end border-1 border border-dark">${kegiatan.pagu ? numberWithCommas(kegiatan.pagu) : '-'}</td>
                                        <td class="border-1 border border-dark">${kegiatan.persen_target_fisik || '-'}</td>
                                        <td class="border-1 border border-dark">${kegiatan.persen_realisasi_fisik || '-'}</td>
                                        <td class="border-1 border border-dark">${kegiatan.deviasi_fisik || '-'}</td>
                                        <td class="border-1 border border-dark">${kegiatan.rp_target_keuangan ? numberWithCommas(kegiatan.rp_target_keuangan) : '-'}</td>
                                        <td class="border-1 border border-dark">${opd.persen_target_keuangan || '-'}</td>
                                        <td class="border-1 border border-dark">${opd.rp_realisasi_keuangan ? numberWithCommas(opd.rp_realisasi_keuangan) : '-'}</td>
                                        <td class="border-1 border border-dark">${opd.persen_realisasi_keuangan || '-'}</td>

                                        <td class="border-1 border border-dark">${kegiatan.deviasi_keuangan || '-'}</td>
                                    </tr>
                                `;

                                // Baris untuk Sub Kegiatan
                                if (kegiatan.data_sub_kegiatan) {
                                    kegiatan.data_sub_kegiatan.forEach((sub) => {
                                        tableRows += `
                                            <tr>
                                                <td class="border-1 border border-dark">
                                                    <ul>
                                                        <li>${sub.nama_sub_kegiatan}</li>
                                                    </ul>
                                                </td>
                                                <td class="border-1 border border-dark">${sub.pptk || '-'}</td>
                                                <td class="text-end border-1 border border-dark">${sub.pagu ? numberWithCommas(sub.pagu) : '-'}</td>
                                                <td class="border-1 border border-dark">${sub.persen_target_fisik || '-'}</td>
                                                <td class="border-1 border border-dark">${sub.persen_realisasi_fisik || '-'}</td>
                                                <td class="border-1 border border-dark">${sub.deviasi_fisik || '-'}</td>
                                                <td class="border-1 border border-dark">${sub.rp_target_keuangan ? numberWithCommas(sub.rp_target_keuangan) : '-'}</td>
                                                <td class="border-1 border border-dark">${opd.persen_target_keuangan || '-'}</td>
                                                <td class="border-1 border border-dark">${opd.rp_realisasi_keuangan ? numberWithCommas(opd.rp_realisasi_keuangan) : '-'}</td>
                                                <td class="border-1 border border-dark">${opd.persen_realisasi_keuangan || '-'}</td>
                                                <td class="border-1 border border-dark">${sub.deviasi_keuangan || '-'}</td>
                                            </tr>
                                        `;
                                    });
                                }
                            });
                        }
                    });

                    // Tambahkan ke <tbody>
                    $('#data-table-body').html(tableRows);

                    const totalPagu = data.pencapaian_opd.pagu || 0;
                    const targetFisik = data.pencapaian_opd.target_fisik_akumulasi || '0%';
                    const targetKeuangan = data.pencapaian_opd.rp_target_keuangan || 0;
                    const persenTarget = data.pencapaian_opd.persen_target_keuangan || 0;
                    

                    const realisasiKeu = data.pencapaian_opd.rp_realisasi_keuangan || 0;
                    const realisasiFisik = data.pencapaian_opd.realisasi_fisik_akumulasi || '0%';
                    const devFisikKeu = data.pencapaian_opd.deviasi_fisik_akumulasi || 0;
                    const persenRKeu = data.pencapaian_opd.persen_realisasi_keuangan || '0%';

                    document.getElementById('totalPagu').textContent = formatRupiah(totalPagu);
                    document.getElementById('targetFisik').textContent = targetFisik;
                    document.getElementById('persenTarget').textContent = persenTarget;
                    document.getElementById('targetKeuangan').textContent = formatRupiah(targetKeuangan);

                    let elements = document.getElementsByClassName('realisasiKeu');
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].textContent = formatRupiah(realisasiKeu);
                    }
                    document.getElementById('realisasiFisik').textContent = realisasiFisik;
                    document.getElementById('deviasiFisik').textContent = devFisikKeu;
                    document.getElementById('persenRKeu').textContent = persenRKeu;
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    // alert("Gagal mengambil data.");  
                    Swal.fire({
                            icon: 'error',
                            title: 'DATA API BAPPEDA',
                            text: 'Gagal mengambil data',
                            confirmButtonText: 'Oke',
                        });
                }
            });

            $.ajax({
                url: grafikAkumulasi,
                method: "GET",
                dataType: "json",
                success: function (responsegrafik) {
                    const data = responsegrafik.data;
                    // console.log(data);
                    // Persiapkan data untuk grafik
                    const bulan = data.map(item => `Bulan ${item.bulan}`);
                    const targetFisik = data.map(item => item.target_fisik);
                    const realisasiFisik = data.map(item => item.realisasi_fisik);
                    const targetKeuangan = data.map(item => item.target_keuangan);
                    const realisasiKeuangan = data.map(item => item.realisasi_keuangan);
                    
                    const dataGrafik = {
                        labels: bulan,
                        datasets: [
                            {
                                label: 'Target Fisik',
                                data: targetFisik,
                                backgroundColor: '#F29F58',
                                // borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                type: 'bar'
                            },
                            {
                                label: 'Realisasi Fisik',
                                data: realisasiFisik,
                                backgroundColor: '#F29F58',
                                // borderColor: 'rgba(255, 99, 132, 1)',
                                tension: 0.4,
                                type: 'line', // Ubah menjadi garis
                                fill: false, // Jangan mengisi di bawah garis
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBackgroundColor: 'rgba(255, 165, 0, 1)' // Warna titik data
                            },
                            {
                                label: 'Target Keuangan',
                                data: targetKeuangan,
                                backgroundColor: '#AB4459',
                                // borderColor: 'rgb(75, 192, 192)',
                                borderWidth: 1,
                                type: 'bar'

                            },
                            {
                                label: 'Realisasi Keuangan',
                                data: realisasiKeuangan,
                                backgroundColor: '#AB4459',
                                // borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4,
                                type: 'line',
                                fill: false,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBackgroundColor: '#000' // War
                            },
                        ]
                    };
                    const config = {
                        type: 'bar',
                        data: dataGrafik,
                        options: {
                            animations: {
                                tension: {
                                    duration: 1000,
                                    easing: 'linear',
                                    from: 1,
                                    to: 0,
                                    loop: true
                                }
                            },
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 30,
                                        callback: function(value) {
                                            return value + '%';
                                        }
                                    }
                                }
                            }
                        }
                    };

                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, config);
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    // alert("Gagal mengambil data.");  
                    Swal.fire({
                            icon: 'error',
                            title: 'DATA API BAPPEDA',
                            text: 'Gagal mengambil data',
                            confirmButtonText: 'Oke',
                        });
                }
            });

            // Fungsi untuk memformat angka ke format dengan koma
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        });

    </script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection