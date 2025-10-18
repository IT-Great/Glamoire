<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
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
                                    <li class="breadcrumb-item"><a href="/order-admin">Order</a></li>
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
                                        <h4 class="card-title mb-0 me-2">Order Id: {{ $order->invoice->no_invoice }}
                                        </h4>
                                        <span
                                            class="badge 
                                            {{ $order->status === 'pending' ? 'bg-warning text-dark' : '' }}
                                            {{ $order->status === 'processing' ? 'bg-primary' : '' }}
                                            {{ $order->status === 'delivery' ? 'bg-info' : '' }}
                                            {{ $order->status === 'completed' ? 'bg-success' : '' }}
                                        ">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Transaction Date:
                                            {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}
                                        </small>
                                        <div>
                                            <button type="button"
                                                class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1"
                                                style="border-radius: 8px;" id="printButton">
                                                <i class="bi bi-printer-fill"></i> Print
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
                                                <!-- Card 1 -->
                                                <div class="row">
                                                    <!-- Customer Information -->
                                                    <div class="col-md-4">
                                                        <div class="border rounded p-3 h-100">
                                                            <h5 class="mb-3">
                                                                <i
                                                                    class="bi bi-person-circle me-2 text-primary"></i>Customer
                                                                Details
                                                            </h5>
                                                            <div class="text-muted">
                                                                <p class="mb-2"><strong>Name :</strong>
                                                                    {{ $order->user->fullname }}</p>
                                                                <p class="mb-2"><strong>Email :</strong>
                                                                    {{ $order->user->email }}</p>
                                                                <p class="mb-0"><strong>Phone :</strong>
                                                                    {{ $order->user->handphone }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Shipping Information -->
                                                    <div class="col-md-4">
                                                        <div class="border rounded p-3 h-100">
                                                            <h5 class="mb-3">
                                                                <i class="bi bi-truck me-2 text-primary"></i>Shipping
                                                                Information
                                                            </h5>
                                                            <div class="text-muted">
                                                                <p class="mb-2"><strong>Province :</strong>
                                                                    {{ $order->shippingAddress->province }}</p>
                                                                <p class="mb-2"><strong>City :</strong>
                                                                    {{ $order->shippingAddress->regency }}</p>
                                                                <p class="mb-0"><strong>Address :</strong>
                                                                    {{ $order->shippingAddress->address }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Payment Information -->
                                                    <div class="col-md-4">
                                                        <div class="border rounded p-3 h-100">
                                                            <h5 class="mb-3">
                                                                <i
                                                                    class="bi bi-credit-card me-2 text-primary"></i>Payment
                                                                Details
                                                            </h5>
                                                            <div class="text-muted">
                                                                <p class="mb-2"><strong>Method :</strong>
                                                                    {{ $order->payment->payment_method }}</p>
                                                                <p class="mb-2"><strong>Status :</strong>
                                                                    <span
                                                                        class="badge bg-{{ $order->payment->status == 'completed' ? 'success' : 'warning' }}">
                                                                        {{ $order->payment->status }}
                                                                    </span>
                                                                </p>
                                                                <p class="mb-0"><strong>Invoice :</strong>
                                                                    {{ $order->invoice->no_invoice }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="table-head">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <h4 class="card-title mt-4">Order Details</h4>
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
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($order->orderItems as $item)
                                                                                <tr>
                                                                                    <td class="text-bold-500">
                                                                                        {{ Str::limit($item->product->product_name, 40, '...') }}
                                                                                    </td>
                                                                                    <td>{{ $item->product->brand ? $item->product->brand->name : 'No Brand' }}
                                                                                    </td>
                                                                                    <td>{{ $order->id }}</td>
                                                                                    <td class="text-bold-500">
                                                                                        {{ $item->quantity }}
                                                                                    </td>
                                                                                    <td>Rp.
                                                                                        {{ number_format($item->subtotal, 0, ',', '.') }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td colspan="4" class="text-end"
                                                                                    style="font-weight: bold;">
                                                                                    Ongkir</td>
                                                                                <td class="fw-bold">Rp.
                                                                                    {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="4" class="text-end"
                                                                                    style="font-weight: bold;">
                                                                                    Subtotal</td>
                                                                                <td class="fw-bold">Rp.
                                                                                    {{ number_format($order->total_amount, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="4" class="text-end"
                                                                                    style="font-weight: bold;">
                                                                                    Grand Total</td>
                                                                                <td class="fw-bold">Rp.
                                                                                    {{ number_format($order->total_amount, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                                <div class="text-end" style="margin-top: 1rem;">
                                                                    <a href="{{ route('index-admin-order') }}"
                                                                        class="btn btn-secondary btn-sm me-2"
                                                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                                                        <i class="bi bi-box-arrow-in-left me-1"></i>
                                                                        Kembali
                                                                    </a>

                                                                    @if ($order->status == "pending")
                                                                        <button type="button"
                                                                            class="btn btn-success btn-sm d-inline-flex align-items-center gap-1 me-2"><i
                                                                                class="bi bi-check-circle"></i>
                                                                            Konfirmasi Pemesanan</button>
                                                                    @endif

                                                                    @if($order->status == "processing")
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm d-inline-flex align-items-center gap-1 me-2"><i
                                                                                class="bi bi-truck"></i>
                                                                            Pick Up Biteship</button>
                                                                    @endif
                                                                        
                                                                    {{-- <button type="button"
                                                                        class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 me-2"><i
                                                                            class="bi bi-bag-check"></i>
                                                                        Selesaikan
                                                                        Pesanan</button> --}}
                                                                </div>
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
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const status = "{{ $order['status'] }}";

            // Konfirmasi Pemesanan
            if(status == "pending"){
                const confirmOrderBtn = document.querySelector('.btn-success');
                confirmOrderBtn.addEventListener('click', function(e) {
                    e.preventDefault();
    
                    // Dapatkan ID pesanan dari tampilan
                    const orderId = "{{ $order->id }}";
    
                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Pesanan',
                        text: 'Apakah Anda yakin ingin mengubah status pesanan menjadi Processing?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Konfirmasi',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim permintaan AJAX untuk mengubah status pesanan
                            fetch(`/admin/order/${orderId}/change-status`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Tampilkan pesan berhasil dalam bahasa Indonesia
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Status pesanan berhasil diubah menjadi Processing.',
                                            icon: 'success',
                                            timer: 3000, // Auto-close alert after 1.8 seconds
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        }).then(() => {
                                            // Reload halaman atau perbarui UI jika diperlukan
                                            location.reload();
                                        });
                                    } else {
                                        // Tampilkan pesan gagal dalam bahasa Indonesia
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 3000,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    }
                                })
                                .catch(error => {
                                    // Tampilkan pesan error dalam bahasa Indonesia
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan dalam mengubah status pesanan.',
                                        icon: 'error',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        showConfirmButton: true
                                    });
                                    console.error('Error:', error);
                                });
                        }
                    });
                });
            }
            
            // Pick Up Biteship

            if(status == "processing"){
                const pickUpBtn = document.querySelector('.btn-warning');
                pickUpBtn.addEventListener('click', function(e) {
                    e.preventDefault();
    
                    // Dapatkan ID pesanan dari tampilan
                    const orderId = "{{ $order->id }}";
    
                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Pick Up Biteship',
                        text: 'Pastikan pesanan sudah siap untuk di-pick up oleh Biteship. Lanjutkan?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Konfirmasi',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim permintaan AJAX untuk mengubah status pesanan
                            fetch(`/admin/order/${orderId}/pick-up`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Tampilkan pesan berhasil dalam bahasa Indonesia
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Berhasil mengirim pick up pesanan ke biteship. <br> check dashboard biteshipmu sekarang',
                                            icon: 'success',
                                            timer: 3000, // Auto-close alert after 1.8 seconds
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        }).then(() => {
                                            // Reload halaman atau perbarui UI jika diperlukan
                                            location.reload();
                                        });
                                    } else {
                                        // Tampilkan pesan gagal dalam bahasa Indonesia
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 3000,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    }
                                })
                                .catch(error => {
                                    // Tampilkan pesan error dalam bahasa Indonesia
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan dalam mengubah status pesanan.',
                                        icon: 'error',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        showConfirmButton: true
                                    });
                                    console.error('Error:', error);
                                });
                        }
                    });
                });
            }
        });
    </script>


    <script>
        function generateInvoiceHTML() {
            // Ambil data dinamis dari halaman
            const orderNo = '{{ $order->invoice->no_invoice }}';
            const orderDate = '{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}';
            const customerName = '{{ $order->user->fullname }}';
            const customerEmail = '{{ $order->user->email }}';
            const customerPhone = '{{ $order->user->handphone }}';
            const paymentMethod = '{{ $order->payment_method }}';
            const paymentStatus = '{{ $order->payment_status }}';
            const orderItems = @json($order->orderItems); // Mengambil semua data item pesanan

            let orderItemsHTML = '';
            let subtotal = 0;

            // Loop untuk menampilkan item pesanan
            orderItems.forEach(item => {
                subtotal += item.subtotal;
                orderItemsHTML += `
                    <tr>
                        <td>${item.product.product_name}</td>
                        <td>${item.product.brand ? item.product.brand.name : 'No Brand'}</td>
                        <td>${orderNo}</td>
                        <td>${item.quantity}</td>
                        <td>Rp. ${item.subtotal.toLocaleString()}</td>
                    </tr>
                `;
            });

            // Format total
            const grandTotal = subtotal;

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
                        <p>Pembeli: ${customerName}<br>
                        Tanggal Pembelian: ${orderDate}<br>
                        Alamat Pengiriman: Suko, Sukodono, Sidoarjo</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Info Produk</th>
                                <th>Brand</th>
                                <th>Order ID</th>
                                <th>Quantity</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${orderItemsHTML}
                        </tbody>
                    </table>
                    <div class="total">
                        <p>Total Harga (1 Barang): Rp${grandTotal.toLocaleString()}</p>
                        <p><strong>Total Belanja: Rp${grandTotal.toLocaleString()}</strong></p>
                    </div>
                    <div>
                        <p>Metode Pembayaran: ${paymentMethod}</p>
                    </div>
                    <div>
                        <small>Invoice ini sah dan diproses oleh komputer</small><br>
                        <small>Silakan hubungi Admin Glamoire apabila kamu membutuhkan bantuan.</small><br>
                        <small>Terakhir diupdate: ${orderDate}</small>
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
        document.getElementById('printButton').addEventListener('click', printInvoice);
    </script>
</body>

</html>
