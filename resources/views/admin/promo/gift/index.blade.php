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
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Stats Card Styling */
        .stats-card {
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .stats-card-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #ef4444);
            color: white;
        }

        .stats-icon.orange i {
            color: #f59e0b;
            /* warna oranye */
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-title {
            font-size: 0.9rem;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table> :not(:first-child) {
            border-top: none;
        }

        .table th {
            font-weight: 600;
            color: var(--text-primary);
            background-color: rgba(243, 246, 249, 0.6);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 1.25rem 1.5rem;
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-info {
            background-color: var(--info-color) !important;
            color: white;
        }

        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Quick Action Button */
        .quick-action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .product-details {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .d-flex.align-items-center.gap-3 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .action-buttons .badge {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main" class="main-content">
            @yield('content')
        </div>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendors/apexcharts/apexcharts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
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

        <script>
            // inisialisasi select2
            $(document).ready(function () {
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
            $(function () {
                $('#filter-date-range').daterangepicker({
                    opens: 'left',
                    startDate: moment().subtract(3, 'months').startOf('month'), // Set tanggal awal 3 bulan lalu
                    endDate: moment().endOf('month'), // Set tanggal akhir akhir bulan ini
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function (start, end) {
                    // Placeholder for future functionality (filtering data based on date range)
                    console.log('Date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                        'YYYY-MM-DD'));
                    // Call to load sales data can be here if needed in future
                });
            });

            // Event listener for brand filter
            document.getElementById('filter-brand').addEventListener('change', function () {
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
                        formatter: function (val) {
                            return "Rp " + val.toLocaleString(); // Format Rupiah
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#weeklyIncomeChart"), options);
            chart.render();
        </script>
</body>

</html>