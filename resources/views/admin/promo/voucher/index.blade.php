<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Voucher || Admin Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">


    <style>
        .product-item-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            /* Allows items to wrap on smaller screens */
        }

        .product-item-container img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .product-item-container {
                flex-direction: column;
                /* Stack items vertically on smaller screens */
                align-items: flex-start;
            }

            .product-item-container img {
                margin-bottom: 10px;
                width: 80px;
                height: 80px;
                /* Reduce image size on smaller screens */
            }
        }

        .action-buttons a {
            display: block;
            /* Set to block so each link appears on a new line */
            margin-bottom: 5px;
            /* Add some space between the buttons */
        }

        .voucher-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .voucher-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .voucher-card h3 {
            margin-bottom: 10px;
        }

        .voucher-card p {
            flex-grow: 1;
        }

        .voucher-card .btn {
            align-self: flex-start;
        }

        .voucher-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>
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
                            <nav aria-label="breadcrumb" class="breadcrumb-header me-3">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Promo Voucher</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Promo Voucher</li>

                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4>List Promo Voucher</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Voucher Banner</th>
                                    <th>Voucher</th>
                                    <th>Periode</th>
                                    <th>Kode</th>
                                    <th>Diskon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promo as $item)
                                    <tr id="promo-item-{{ $item->id }}">
                                        <td>
                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->promo_name }}"
                                                class="lazyload"
                                                style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;"
                                                onclick="openImageInNewTab('{{ Storage::url($item->image) }}')">
                                        </td>
                                        <td>{{ $item->promo_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} -
                                            {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $item->promo_code }}</td>
                                        <td>{{ $item->diskon }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ url('detail-promo/' . $item->id) }}">
                                                Review
                                            </a>
                                            <a href="javascript:void(0);" class="delete-promo"
                                                data-id="{{ $item->id }}">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section> --}}

            <section class="section">
                <div class="container">
                    <h3 class="mb-2">Create Voucher</h3>
                    <p class="mb-3">
                        Create a Store Voucher or Product Voucher now to attract Buyers.
                        <a href="#" class="text-blue">Learn More</a>
                    </p>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Overall Vouchers</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="voucher-card">
                                        <div class="voucher-icon">🎫</div>
                                        <h4>Limited Voucher</h4>
                                        <p>Voucher for specific Buyers that can only be shared through a code</p>
                                        <a href="{{ route('create-promo-voucher') }}" class="btn btn-primary">Create</a>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="voucher-card">
                                        <div class="voucher-icon">🏪</div>
                                        <h4>Store Voucher</h4>
                                        <p>Voucher for all your products to increase sales</p>
                                        <a href="{{ route('create-promo-shop-voucher') }}"
                                            class="btn btn-primary">Create</a>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="voucher-card">
                                        <div class="voucher-icon">📦</div>
                                        <h4>Product Voucher</h4>
                                        <p>Voucher for selected products as part of specific promotions</p>
                                        <a href="{{ route('create-promo-product-voucher') }}"
                                            class="btn btn-primary">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Promo Voucher List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Voucher Banner</th>
                                        <th>Voucher</th>
                                        <th>Type</th>
                                        <th>Period</th>
                                        {{-- <th>Discount</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promo as $item)
                                        <tr id="promo-item-{{ $item->id }}">
                                            <td>
                                                <div class="product-item-container">
                                                    <img src="{{ Storage::url($item->image) }}" alt="Product Image"
                                                        class="lazyload"
                                                        style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;"
                                                        onclick="openImageInNewTab('{{ Storage::url($item->image) }}')">

                                                    <!-- Product Details -->
                                                    <div>
                                                        <span style="font-size: 3.6mm;">Code :
                                                            {{ $item->promo_code ? $item->promo_code : 'No Code' }}</span><br>
                                                        <span style="font-size: 3.6mm;">Discount :
                                                            {{ $item->discount ? $item->discount : 'No Discount' }}%</span><br>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                {{ Str::limit($item->promo_name, 20, '...') }}
                                            </td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} -
                                                {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ url('detail-promo/' . $item->id) }}"
                                                    class="badge bg-info">Review</a>
                                                <a href="javascript:void(0);" class="badge bg-danger delete-promo"
                                                    data-id="{{ $item->id }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>

        </div>
        @include('admin.layouts.footer')

    </div>
    </div>

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <!-- Include jQuery (if not included already) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#voucherTable').DataTable();

            // Image preview functionality
            document.querySelectorAll('.voucher-image').forEach(function(img) {
                img.addEventListener('click', function() {
                    window.open(this.src, '_blank');
                });
            });

            // Delete promo functionality
            document.querySelectorAll('.delete-promo').forEach(function(deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this promo?')) {
                        var promoId = this.getAttribute('data-id');
                        // Add your delete logic here, e.g., AJAX call to delete the promo
                        console.log('Deleting promo with ID:', promoId);
                    }
                });
            });

            // Show more functionality (placeholder)
            document.getElementById('showMore').addEventListener('click', function(e) {
                e.preventDefault();
                alert('Show more functionality to be implemented');
            });
        });
    </script>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Simple DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            // Use event delegation for delete button
            table1.addEventListener('click', function(event) {
                if (event.target.closest('.delete-promo')) {
                    let promoId = event.target.closest('.delete-promo').getAttribute('data-id');

                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request to delete promo
                            fetch(`/delete-promo/${promoId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the promo from the page
                                        let promoRow = document.querySelector(
                                            `#promo-item-${promoId}`);
                                        if (promoRow) {
                                            promoRow.remove();
                                        }
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                }
            });
        });
    </script>


    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4A69E2', // Mengatur warna tombol OK
                customClass: {
                    icon: 'swal-icon-success'
                },
                timer: 1800, // Mengatur waktu tampilan SweetAlert dalam milidetik (1000 ms = 1 detik)
                timerProgressBar: true, // Menampilkan progress bar timer
                didClose: () => {
                    // Optional: this can be used to trigger any action after the alert is closed
                }
            });
        </script>
    @endif
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
