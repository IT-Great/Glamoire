<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .product-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        .stock-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 3px;
            transition: all 0.2s ease;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .product-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .message-preview {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .table>tbody>tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
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
                            <!-- Breadcrumb Navigation -->
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('index-contactus-admin')}}">Contact Us</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Messages</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card product-card">
                        <div class="card-header bg-white">
                            <h4 class="mb-3">Contact Us Messages</h4>
                            <p class="text-muted">Review all incoming messages and click on a message to view or
                                respond.</p>
                        </div>
                        <div class="card-body">
                            <!-- Messages Table -->
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Contact Details</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Date Received</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr id="contact-item-{{ $contact->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Image"
                                                        class="product-image lazyload"
                                                        style="width: 50px; height: 50px;">
                                                    <div class="product-details">
                                                        <span class="product-name">{{ $contact->fullname }}</span>
                                                        <span class="product-meta">{{ $contact->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($contact->question, 40, '...') }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($contact->status === 'read')
                                                    <span
                                                        class="stock-badge rounded-pill bg-success d-inline-flex align-items-center gap-1 text-white">
                                                        <i class="bi bi-check-circle-fill"></i> Read
                                                    </span>
                                                @else
                                                    <span
                                                        class="stock-badge rounded-pill bg-warning d-inline-flex align-items-center gap-1 text-dark">
                                                        <i class="bi bi-exclamation-circle-fill"></i> Unread
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('show-contactus-admin', $contact->id) }}"
                                                        class="badge bg-info mb-2">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="badge bg-danger delete-contact"
                                                        data-id="{{ $contact->id }}">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                @include('admin.layouts.footer')

            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        document.querySelectorAll('.delete-contact').forEach(item => {
            item.addEventListener('click', function() {
                const contactId = this.getAttribute('data-id');

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
                        // Send AJAX request to delete the contact
                        fetch(`/delete-contact/${contactId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove the contact from the page
                                    document.querySelector(`#contact-item-${contactId}`)
                                    .remove();
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: data.message,
                                        icon: 'success',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        showConfirmButton: true
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
                                        icon: 'error',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // HANDLE FORMAT DATE PICKER
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_expired", {
                enableTime: false,
                dateFormat: "Y-m-d",
                time_24hr: true,
                minuteIncrement: 1
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
                timer: 1800, // Mengatur waktu tampilan SweetAlert dalam milidetik
                timerProgressBar: true, // Menampilkan progress bar timer
                didClose: () => {
                    // Optional: Tambahkan aksi di sini jika diperlukan saat alert ditutup
                }
            });
        </script>
    @endif

</body>

</html>
