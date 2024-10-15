<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/order-list">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
                                </ol>
                            </nav>
                        </div>                 
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="card-title mb-0 me-2">Order Id: #091080231</h4>
                                        <span class="badge bg-light-success">Active</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Transaction Date: August 28, 2024</small>
                                        <div>
                                            {{-- <button type="button" class="btn btn-primary btn-sm"
                                                style="border-radius: 8px;"><i class="bi bi-printer-fill"></i>
                                                Print</button> --}}

                                            <button type="button" class="btn btn-primary btn-sm"
                                                style="border-radius: 8px;">
                                                <i class="bi bi-printer-fill"></i> Print
                                            </button>

                                            <button type="button" class="btn btn-primary btn-sm ms-2"
                                                style="border-radius: 8px;"><i class="bi bi-cloud-download-fill"></i>
                                                Save</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
                                                <!-- Card 1 -->
                                                <div class="col-md-4 col-12">
                                                    <a href="{{ url('/detail-product-admin') }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        <div class="card"
                                                            style="border: 1px solid #ccc; border-radius: 8px;">
                                                            <div class="card-header d-flex align-items-center">
                                                                <!-- Product Name and Category -->
                                                                <div class="d-flex align-items-start">
                                                                    <div class="me-3">
                                                                        <img src="{{ asset('assets/images/faces/1.jpg') }}"
                                                                            alt="Product Image"
                                                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;">
                                                                    </div>

                                                                    <div class="d-flex flex-column me-3">
                                                                        <h4 class="card-title mb-0"
                                                                            style="margin-top: 1px; font-size: 1.25rem;">
                                                                            Customer
                                                                        </h4>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Full Name :
                                                                        </p>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Email :
                                                                        </p>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Phone :
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <form class="form form-horizontal">
                                                                        <div class="form-body">

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Card 2 -->
                                                <div class="col-md-4 col-12">
                                                    <a href="{{ url('/detail-product-admin') }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        <div class="card"
                                                            style="border: 1px solid #ccc; border-radius: 8px;">
                                                            <div class="card-header d-flex align-items-center">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="me-3">
                                                                        <img src="{{ asset('assets/images/faces/1.jpg') }}"
                                                                            alt="Product Image"
                                                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;">
                                                                    </div>

                                                                    <div class="d-flex flex-column me-3">
                                                                        <h4 class="card-title mb-0"
                                                                            style="margin-top: 1px; font-size: 1.25rem;">
                                                                            Order Info
                                                                        </h4>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Shipping :
                                                                        </p>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Payment Method :
                                                                        </p>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Status :
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <form class="form form-horizontal">
                                                                        <div class="form-body">

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Card 3 -->
                                                <div class="col-md-4 col-12">
                                                    <a href="{{ url('/detail-product-admin') }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        <div class="card"
                                                            style="border: 1px solid #ccc; border-radius: 8px;">
                                                            <div class="card-header d-flex align-items-center">
                                                                <!-- Image -->
                                                                <div class="d-flex align-items-start">
                                                                    <!-- Kolom untuk Deliver to -->
                                                                    <!-- Gambar -->
                                                                    <div class="me-3">
                                                                        <img src="{{ asset('assets/images/faces/1.jpg') }}"
                                                                            alt="Product Image"
                                                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;">
                                                                    </div>

                                                                    <div class="d-flex flex-column me-3">
                                                                        <h4 class="card-title mb-0"
                                                                            style="margin-top: 1px; font-size: 1.25rem;">
                                                                            Deliver to
                                                                        </h4>
                                                                        <p class="card-category mb-0"
                                                                            style="font-size: 0.875rem; color: #6c757d;">
                                                                            Address :
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <form class="form form-horizontal">
                                                                        <div class="form-body">

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-12">
                                                    <div class="card"
                                                        style="border: 1px solid #ccc; border-radius: 8px;">
                                                        <div class="card-header d-flex align-items-center">
                                                            <!-- Product Name and Category -->
                                                            <div class="d-flex align-items-start">
                                                                <div class="d-flex flex-column me-3">
                                                                    <h4 class="card-title mb-0"
                                                                        style="margin-top: 1px; font-size: 1.25rem;">
                                                                        Payment Info
                                                                    </h4>
                                                                    <p class="card-category mb-0"
                                                                        style="font-size: 0.875rem; color: #6c757d;">
                                                                        Nama Bank :
                                                                    </p>
                                                                    <p class="card-category mb-0"
                                                                        style="font-size: 0.875rem; color: #6c757d;">
                                                                        Payment Status :
                                                                    </p>
                                                                    <p class="card-category mb-0"
                                                                        style="font-size: 0.875rem; color: #6c757d;">
                                                                        No Invoice :
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-horizontal">
                                                                    <div class="form-body">

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Products</h4>
                                </div>
                                <div class="card-content" style="padding: 1rem;">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Order ID</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Bedak Bubuk</td>
                                                    <td>Implora</td>
                                                    <td>#12313131</td>
                                                    <td class="text-bold-500">12</td>
                                                    <td>Rp. 200.000</td>
                                                    <td><a href="#"><i
                                                                class="badge-circle badge-circle-light-secondary font-medium-1"
                                                                data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Bedak Bubuk</td>
                                                    <td>Implora</td>
                                                    <td>#19191919</td>
                                                    <td class="text-bold-500">12</td>
                                                    <td>Rp. 200.000</td>
                                                    <td><a href="#"><i
                                                                class="badge-circle badge-circle-light-secondary font-medium-1"
                                                                data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Bedak Bubuk</td>
                                                    <td>Implora</td>
                                                    <td>#1010101919</td>
                                                    <td class="text-bold-500">12</td>
                                                    <td>Rp. 200.000</td>
                                                    <td><a href="#"><i
                                                                class="badge-circle badge-circle-light-secondary font-medium-1"
                                                                data-feather="mail"></i></a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-end" style="font-weight: bold;">
                                                        Subtotal</td>
                                                    <td class="fw-bold">Rp. 600.000</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-end" style="font-weight: bold;">
                                                        Tax (10%)</td>
                                                    <td class="fw-bold">Rp. 60.000</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-end" style="font-weight: bold;">
                                                        Discount</td>
                                                    <td class="fw-bold">Rp. 0</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-end" style="font-weight: bold;">
                                                        Grand Total</td>
                                                    <td class="fw-bold">Rp. 660.000</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="text-end" style="margin-top: 1rem;">
                                        <button type="button" class="btn btn-success btn-sm"
                                            style="border-radius: 8px;"><i class="bi bi-check-circle"></i> Konfirmasi
                                            Pemesanan</button>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            style="border-radius: 8px;"><i class="bi bi-truck"></i> Pesanan
                                            Dikirim</button>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            style="border-radius: 8px;"><i class="bi bi-bag-check"></i> Selesaikan
                                            Pesanan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

    <script>
        function generateInvoiceHTML() {
            return `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .invoice-container {
                width: 838px;
                height: 869px;
                margin: 0 auto;
                padding: 20px;
                box-sizing: border-box;
                overflow: auto;
            }
            .invoice-header {
                text-align: right;
                margin-bottom: 20px;
            }
            .invoice-title {
                font-size: 24px;
                font-weight: bold;
            }
            .invoice-details {
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .total {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="invoice-container">
            <div class="invoice-header">
                <div class="invoice-title">INVOICE</div>
                <div>INV/07082024/IND/1908101011</div>
            </div>
            <div class="invoice-details">
                <strong>Diterbitkan Atas Nama:</strong>
                <p>Penjual: Glamoire</p>
                <strong>Untuk:</strong>
                <p>Pembeli: Muhammad Helmi<br>
                Tanggal Pembelian: 10 Agustus 2024<br>
                Alamat Pengiriman: Suko, Sukodono, Sidoarjo</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Info Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mirelle Beauty Glossy Day Cream</td>
                        <td>1</td>
                        <td>Rp12.000</td>
                        <td>Rp12.000</td>
                    </tr>
                </tbody>
            </table>
            <div class="total">
                <p>Total Harga (1 Barang): Rp12.000</p>
                <p>Total Ongkos Kirim: Rp6.000</p>
                <p>Diskon Voucher: -Rp5.000</p>
                <p>Biaya Asuransi Pengiriman: Rp1.000</p>
                <p><strong>Total Belanja: Rp14.000</strong></p>
                <p>Biaya Jasa Aplikasi: Rp1.000</p>
                <p><strong>Total Tagihan: Rp15.000</strong></p>
            </div>
            <div>
                <p>Metode Pembayaran: BCA Virtual Account</p>
            </div>
            <div>
                <small>Invoice ini sah dan diproses oleh komputer</small><br>
                <small>Silakan hubungi Admin Glamoire apabila kamu membutuhkan bantuan.</small><br>
                <small>Terakhir diupdate: 10 Agustus 2024 14:32 WIB</small>
            </div>
        </div>
    </body>
    </html>
  `;
        }

        // Function to open the invoice in a new window and print
        function printInvoice() {
            const invoiceWindow = window.open('', '_blank');
            invoiceWindow.document.write(generateInvoiceHTML());
            invoiceWindow.document.close();
            invoiceWindow.print();
        }

        // Add event listener to the print button
        document.querySelector('.btn-primary i.bi-printer-fill').parentElement.addEventListener('click', printInvoice);
    </script>
</body>

</html>
