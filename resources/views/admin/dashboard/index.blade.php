<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        .card {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-extrabold {
            font-weight: 800;
        }

        .select2-container {
            width: 100% !important;
        }

        @media (max-width: 767.98px) {
            .card-header .d-flex {
                flex-direction: column;
            }

            .card-header .d-flex>div {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard</h3>
                <nav aria-label="breadcrumb" class="breadcrumb-header me-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <!-- Stats Cards Row 1 -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon purple">
                                                    <!-- Replace with "Unpaid" icon -->
                                                    <i class="iconly-boldWallet"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Unpaid</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon orange">
                                                    <!-- Replace with "Shipment Needs Processing" icon -->
                                                    <i class="iconly-boldSend"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Shipment Needs Processing</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon green">
                                                    <!-- Replace with "Processed Shipments" icon -->
                                                    <i class="bi bi-box fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Processed Shipments</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon red">
                                                    <!-- Replace with "Canceled by Buyer" icon -->
                                                    <i class="bi bi-x-circle fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Canceled by Buyer</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Cards Row 2 -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon blue">
                                                    <!-- Replace with "New Order" icon -->
                                                    <i class="bi bi-check-circle fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">New Order</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon grey">
                                                    <!-- Replace with "Out Of Stock" icon -->
                                                    <i class="iconly-boldDanger"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Out Of Stock</h6>
                                                <h6 class="font-extrabold mb-0">183</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon teal">
                                                    <!-- Replace with "Available Stock" icon -->
                                                    <i class="iconly-boldBag"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Available Stock</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-body px-3 py-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="stats-icon blue">
                                                    <!-- Replace with "Upcoming Promotion" icon -->
                                                    <i class="iconly-boldDiscount"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h6 class="text-muted font-semibold">Upcoming Promotion</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Sales Information Card -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Sales Information</h4>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <input type="text" id="filter-date-range" class="form-control"
                                                    placeholder="Select Date Range">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select id="filter-brand" class="form-select select2">
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <button id="export-csv" class="btn btn-primary">Export to CSV</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-sales-information"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add this section after your Weekly Income Chart section -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Performa Paket Diskon</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Kriteria Utama -->
                                        <div class="row g-3 mb-2">
                                            <div class="col-12 col-sm-6 col-lg">
                                                <div class="card">
                                                    <div class="card-body px-3 py-4">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-muted font-semibold">Penjualan</h6>
                                                            <h6 class="font-extrabold mb-0">Rp 77.200</h6>
                                                            <small class="text-muted d-flex align-items-center">
                                                                vs Kemarin pada 00:00-9:00
                                                                <span class="ms-2 text-success">0.00%</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-lg">
                                                <div class="card">
                                                    <div class="card-body px-3 py-4">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-muted font-semibold">Pesanan</h6>
                                                            <h6 class="font-extrabold mb-0">3</h6>
                                                            <small class="text-muted d-flex align-items-center">
                                                                vs Kemarin pada 00:00-9:00
                                                                <span class="ms-2 text-success">0.00%</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-lg">
                                                <div class="card">
                                                    <div class="card-body px-3 py-4">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-muted font-semibold">Produk Terjual</h6>
                                                            <h6 class="font-extrabold mb-0">6</h6>
                                                            <small class="text-muted d-flex align-items-center">
                                                                vs Kemarin pada 00:00-9:00
                                                                <span class="ms-2 text-success">0.00%</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-lg">
                                                <div class="card">
                                                    <div class="card-body px-3 py-4">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-muted font-semibold">Total Pembeli</h6>
                                                            <h6 class="font-extrabold mb-0">2</h6>
                                                            <small class="text-muted d-flex align-items-center">
                                                                vs Kemarin pada 00:00-9:00
                                                                <span class="ms-2 text-success">0.00%</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-lg">
                                                <div class="card">
                                                    <div class="card-body px-3 py-4">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-muted font-semibold">Jumlah Paket Diskon
                                                                Dipesan</h6>
                                                            <h6 class="font-extrabold mb-0">3</h6>
                                                            <small class="text-muted d-flex align-items-center">
                                                                vs Kemarin pada 00:00-9:00
                                                                <span class="ms-2 text-success">0.00%</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Grafik Setiap Kriteria -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Grafik Setiap Kriteria</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="discountPerformanceChart" style="height: 300px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sales Ranking Card -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                            <div>
                                                <h4 class="mb-1">Sales Ranking</h4>
                                                <p class="mb-0">Best-selling product across all brands</p>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <input type="text" id="filter-date-range" class="form-control"
                                                    placeholder="Select Date Range">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Product</th>
                                                        <th>Quantity Sold</th>
                                                        <th>Quantity Available</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                                        loading="lazy" class="lazyload me-2"
                                                                        alt="Product Image"
                                                                        style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                                                    <span>{{ $product->product_name }}</span>
                                                                </div>
                                                            </td>
                                                            <td>{{ $product->stock_quantity }}</td>
                                                            <td>{{ $product->stock_quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weekly Income Chart -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pemasukan Mingguan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="weeklyIncomeChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @include('admin.layouts.footer')

        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dummy data for the chart
            const dates = ['01/11', '02/11', '03/11', '04/11', '05/11', '06/11', '07/11',
                '08/11', '09/11', '10/11', '11/11', '12/11', '13/11', '14/11'
            ];

            const salesData = [65000, 55000, 72000, 58000, 52000, 62000, 48000,
                58000, 63000, 60000, 55000, 65000, 70000, 52000
            ];

            const buyersData = [15, 16, 15, 17, 14, 13, 16, 18, 17, 18, 15, 14, 19, 16];

            const ctx = document.getElementById('discountPerformanceChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                            label: 'Sale',
                            data: salesData,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Buyers',
                            data: buyersData,
                            borderColor: 'rgb(54, 162, 235)',
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>


    {{-- script sales information untuk bagian 7 hari terakhir --}}
    {{-- <script>
        // inisialisasi select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select Brand', // Placeholder untuk select
                allowClear: true // Mengizinkan opsi untuk dibersihkan
            });
        });
        // Inisialisasi chart menggunakan ApexCharts
        let salesChart;

        // Function untuk memuat data berdasarkan tanggal dan tipe data
        function loadSalesData(startDate, endDate, brandId) {
            // Ganti dengan AJAX call ke controller jika diperlukan
            let allData = {
                sales: [40, 55, 60, 70, 80, 90, 100],
                returns: [10, 15, 20, 25, 30, 35, 40]
            };

            let categories = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            let filteredData = allData.sales; // Gunakan data sales secara langsung

            // Render chart
            if (salesChart) {
                salesChart.updateOptions({
                    series: [{
                        name: 'Amount',
                        data: filteredData
                    }],
                    xaxis: {
                        categories: categories
                    }
                });
            } else {
                var options = {
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    series: [{
                        name: 'Amount',
                        data: filteredData
                    }],
                    xaxis: {
                        categories: categories
                    }
                };

                salesChart = new ApexCharts(document.querySelector("#chart-sales-information"), options);
                salesChart.render();
            }
        }

        // Inisialisasi Date Range Picker
        $(function() {
            $('#filter-date-range').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                let brandId = $('#filter-brand').val(); // Ambil brandId
                loadSalesData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), brandId);
            });
        });

        // Event listener untuk filter brand
        document.getElementById('filter-brand').addEventListener('change', function() {
            let dates = $('#filter-date-range').data('daterangepicker');
            let startDate = dates.startDate.format('YYYY-MM-DD');
            let endDate = dates.endDate.format('YYYY-MM-DD');
            let brandId = this.value;

            loadSalesData(startDate, endDate, brandId);
        });

        // Load initial chart data
        let initialStart = moment().subtract(6, 'days').format('YYYY-MM-DD');
        let initialEnd = moment().format('YYYY-MM-DD');
        loadSalesData(initialStart, initialEnd, ''); // Muat data awal
    </script> --}}

    <script>
        // inisialisasi select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select Brand', // Placeholder untuk select
                allowClear: true // Mengizinkan opsi untuk dibersihkan
            });
        });

        // Inisialisasi chart menggunakan ApexCharts
        let salesChart;

        // Dummy data for the last 3 months
        // Dummy data for the last 3 months
        const dummyCategories = [
            moment().subtract(3, 'months').format('MMMM YYYY'), // Misalnya: "September 2024"
            moment().subtract(2, 'months').format('MMMM YYYY'),
            moment().subtract(1, 'months').format('MMMM YYYY'),
            moment().format('MMMM YYYY'),
        ];



        const dummySalesData = [100, 150, 200, 250]; // Dummy sales data for each month

        // Function to load dummy data
        function loadDummySalesData() {
            // Render chart
            if (salesChart) {
                salesChart.updateOptions({
                    series: [{
                        name: 'Amount',
                        data: dummySalesData
                    }],
                    xaxis: {
                        categories: dummyCategories
                    }
                });
            } else {
                var options = {
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    series: [{
                        name: 'Amount',
                        data: dummySalesData
                    }],
                    xaxis: {
                        categories: dummyCategories
                    }
                };

                salesChart = new ApexCharts(document.querySelector("#chart-sales-information"), options);
                salesChart.render();
            }
        }

        function exportToCSV() {
            let dates = $('#filter-date-range').data('daterangepicker');
            let startDate = dates.startDate.format('YYYY-MM-DD');
            let endDate = dates.endDate.format('YYYY-MM-DD');
            let brandId = $('#filter-brand').val();

            // In a real scenario, you would fetch this data from your backend
            // For this example, we'll use dummy data
            let csvContent = [
                ['No. Pesanan', 'Status Pesanan', 'Status Pembatalan/ Pengembalian', 'No. Resi', 'Opsi Pengiriman',
                    'Antar ke counter/ pick-up', 'Pesanan Harus Dikirimkan Sebelum (Menghindari keterlambatan)',
                    'Waktu Pengiriman Diatur', 'Waktu Pesanan Dibuat', 'Waktu Pembayaran Dilakukan',
                    'Metode Pembayaran', 'SKU Induk', 'Nama Produk', 'Nomor Referensi SKU', 'Nama Variasi',
                    'Harga Awal', 'Harga Setelah Diskon', 'Jumlah', 'Returned quantity', 'Total Harga Produk',
                    'Total Diskon', 'Diskon Dari Penjual', 'Diskon Dari Shopee', 'Berat Produk',
                    'Jumlah Produk di Pesan', 'Total Berat', 'Voucher Ditanggung Penjual', 'Cashback Koin',
                    'Voucher Ditanggung Shopee', 'Paket Diskon', 'Paket Diskon (Diskon dari Shopee)',
                    'Paket Diskon (Diskon dari Penjual)', 'Potongan Koin Shopee', 'Diskon Kartu Kredit',
                    'Ongkos Kirim Dibayar oleh Pembeli', 'Estimasi Potongan Biaya Pengiriman',
                    'Ongkos Kirim Pengembalian Barang', 'Total Pembayaran', 'Perkiraan Ongkos Kirim',
                    'Catatan dari Pembeli', 'Catatan', 'Username (Pembeli)', 'Nama Penerima', 'No. Telepon',
                    'Alamat Pengiriman', 'Kota/Kabupaten', 'Provinsi', 'Waktu Pesanan Selesai'
                ],
                ['1', 'Selesai', '', 'JP6969696969', 'J&T Express', 'Antar ke counter', '2023-05-15 23:59',
                    '2023-05-14 10:00', '2023-05-13 14:30', '2023-05-13 14:35', 'Transfer Bank', 'PROD001',
                    'T-Shirt Katun', 'SKU001', 'Putih-M', '100000', '90000', '1', '0', '90000', '10000',
                    '5000', '5000', '0.3', '1', '0.3', '5000', '1000', '5000', '0', '0', '0', '2000', '0',
                    '15000', '0', '0', '105000', '15000', 'Tolong bungkus rapi', '', 'john_doe',
                    'John Doe', '081234567890', 'Jl. Contoh No. 123', 'Jakarta Selatan', 'DKI Jakarta',
                    '2023-05-16 15:30'
                ],
                ['2', 'Dikirim', '', 'JP7070707070', 'J&T Express', 'Antar ke counter', '2023-05-16 23:59',
                    '2023-05-15 11:00', '2023-05-14 09:45', '2023-05-14 09:50', 'Transfer Bank', 'PROD002',
                    'Celana Jeans', 'SKU002', 'Biru-32', '250000', '225000', '1', '0', '225000', '25000',
                    '20000', '5000', '0.7', '1', '0.7', '0', '0', '0', '0', '0', '0', '0', '0',
                    '15000', '0', '0', '240000', '15000', '', '', 'jane_smith',
                    'Jane Smith', '087654321098', 'Jl. Sample No. 456', 'Surabaya', 'Jawa Timur',
                    '2023-05-17 14:45'
                ],
                // ... add more rows as needed
            ];


            // Convert array to CSV string
            let csv = csvContent.map(row => row.join(',')).join('\n');

            // Create a Blob with the CSV content
            let blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            let url = URL.createObjectURL(blob);

            // Create a link to download the CSV file
            let link = document.createElement("a");
            link.setAttribute("href", url);
            link.setAttribute("download", "sales_data.csv");
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Add event listener for export button
        document.getElementById('export-csv').addEventListener('click', exportToCSV);



        // Inisialisasi Date Range Picker
        $(function() {
            $('#filter-date-range').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(3, 'months').startOf('month'), // Set tanggal awal 3 bulan lalu
                endDate: moment().endOf('month'), // Set tanggal akhir akhir bulan ini
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                // Placeholder for future functionality (filtering data based on date range)
                console.log('Date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                    'YYYY-MM-DD'));
                // Call to load sales data can be here if needed in future
            });
        });

        // Event listener for brand filter
        document.getElementById('filter-brand').addEventListener('change', function() {
            let dates = $('#filter-date-range').data('daterangepicker');
            let startDate = dates.startDate.format('YYYY-MM-DD');
            let endDate = dates.endDate.format('YYYY-MM-DD');
            let brandId = this.value;

            loadSalesData(startDate, endDate, brandId);
        });


        // Load initial dummy data for the last 3 months
        loadDummySalesData(); // Muat data awal
    </script>

    {{-- script penjualan 1 minggu --}}

    <script>
        var options = {
            series: [{
                name: 'Pemasukan',
                data: [500000, 300000, 700000, 400000, 600000, 450000, 800000] // Data dummy pemasukan per hari
            }],
            chart: {
                height: 350,
                type: 'bar', // Kamu bisa ganti tipe chart menjadi 'line' atau yang lain
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'], // Hari dalam seminggu
            },
            yaxis: {
                title: {
                    text: 'Pemasukan (Rp)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp " + val.toLocaleString(); // Format Rupiah
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#weeklyIncomeChart"), options);
        chart.render();
    </script>

    {{-- setup backend data dinamis --}}
    {{-- <script>
        function loadSalesData(startDate, endDate, brandId) {
            $.ajax({
                url: '/your-route-to-get-sales-data', // Ubah dengan route yang sesuai
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    brand_id: brandId
                },
                success: function(response) {
                    // Render chart with dynamic data
                    if (salesChart) {
                        salesChart.updateOptions({
                            series: [{
                                name: 'Amount',
                                data: response.data // Data dari response
                            }],
                            xaxis: {
                                categories: response.categories // Kategori dari response
                            }
                        });
                    } else {
                        var options = {
                            chart: {
                                type: 'line',
                                height: 350
                            },
                            series: [{
                                name: 'Amount',
                                data: response.data // Data dari response
                            }],
                            xaxis: {
                                categories: response.categories // Kategori dari response
                            }
                        };

                        salesChart = new ApexCharts(document.querySelector("#chart-sales-information"),
                            options);
                        salesChart.render();
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    // Tambahkan penanganan error sesuai kebutuhan
                }
            });
        }


        $(document).ready(function() {
            // Initialize select2 for brand selection
            $('.select2').select2({
                placeholder: 'Select Brand',
                allowClear: true
            });

            // Load initial chart data for the last 3 months
            let initialStart = moment().subtract(3, 'months').startOf('month').format('YYYY-MM-DD');
            let initialEnd = moment().endOf('month').format('YYYY-MM-DD');
            loadSalesData(initialStart, initialEnd, ''); // Load initial data

            // Date Range Picker Initialization
            $('#filter-date-range').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(3, 'months').startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                let brandId = $('#filter-brand').val();
                loadSalesData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), brandId);
            });

            // Event listener for brand filter
            document.getElementById('filter-brand').addEventListener('change', function() {
                let dates = $('#filter-date-range').data('daterangepicker');
                let startDate = dates.startDate.format('YYYY-MM-DD');
                let endDate = dates.endDate.format('YYYY-MM-DD');
                let brandId = this.value;

                loadSalesData(startDate, endDate, brandId);
            });
        });
    </script> --}}
</body>

</html> 