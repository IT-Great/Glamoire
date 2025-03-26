<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .category-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .action-buttons .btn {
            transition: all 0.2s ease;
            margin: 0 3px;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
        }

        .category-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .subcategory-name {
            font-size: 1rem;
            color: #666;
            padding-left: 1.5rem;
        }

        .category-meta {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">FAQ</a></li>
                                    <li class="breadcrumb-item active">All FAQ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Categories Table Section -->
                <div class="card category-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4>FAQ List</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#faqModal">
                                    <i class="fa fa-plus"></i>  Buat FAQ 
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Total FAQs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $category => $faqList)
                                    <tr>
                                        <td>
                                            <div class="category-name">{{ $category }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ count($faqList) }} FAQs</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="collapse"
                                                data-bs-target="#faq-{{ Str::slug($category) }}" aria-expanded="false">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="faq-{{ Str::slug($category) }}">
                                        <td colspan="3">
                                            <ul>
                                                @foreach ($faqList as $faq)
                                                    <li>
                                                        <strong>{{ $faq->question }}</strong>
                                                        <p>{{ $faq->answer }}</p>
                                                        <button class="btn btn-sm btn-danger mb-2"
                                                            onclick="deleteFaq({{ $faq->id }})">Delete</button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Add FAQ Modal -->
                <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-white">
                                <h5 class="modal-title">
                                    <i class="bi bi-plus-square"></i> Add New FAQ
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="faqForm">
                                @csrf
                                <div class="modal-body">
                                    <!-- Form FAQ -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label fw-medium">Category <span
                                                style="color: red">*</span></label>

                                        <select class="form-select select2 me-2" name="category">
                                            <option value="Account">Account</option>
                                            <option value="My Order">My Order</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Shipping">Shipping</option>
                                            <option value="Refund & Return Policy">Refund & Return Policy</option>
                                            <option value="Scam Alert">Scam Alert</option>
                                        </select>

                                        <small class="text-muted" style="font-size: 14px;">
                                            Silakan masukkan nama kategori yang unik dan deskriptif.
                                        </small>
                                    </div>


                                    <div class="mb-3">
                                        <label for="question" class="form-label fw-medium">Question <span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="question" name="question"
                                            required>

                                        <small class="text-muted" style="font-size: 14px;">
                                            Silakan masukkan nama kategori yang unik dan deskriptif.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="answer" class="form-label fw-medium">Answer <span
                                                style="color: red">*</span></label>
                                        <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>

                                        <small class="text-muted" style="font-size: 14px;">
                                            Silakan masukkan nama kategori yang unik dan deskriptif.
                                        </small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg"></i> Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Save FAQ
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#faqModal').on('shown.bs.modal', function() {
                $('.select2').select2({
                    dropdownParent: $('#faqModal') // Penting untuk modal
                });
            });


            // Handle FAQ form submission
            $('#faqForm').on('submit', function(e) {
                e.preventDefault();
                submitFaqForm($(this), '#faqModal');
            });

            // Function to submit the FAQ form
            function submitFaqForm(form, modalId) {
                $.ajax({
                    url: "{{ route('faqs.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Tutup modal
                            const faqModal = new bootstrap.Modal(document.getElementById('faqModal'));
                            faqModal.hide();

                            // Reset form
                            form[0].reset();

                            // Tampilkan pesan sukses
                            Swal.fire({
                                title: 'Success!',
                                text: 'FAQ has been successfully added.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4A69E2',
                            });

                            // Reload halaman setelah beberapa detik
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        // Tangani error dari server
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to add FAQ. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33',
                        });
                    }
                });
            }

            // Handle FAQ deletion
            function deleteFaq(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/faqs/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'FAQ has been deleted.',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#4A69E2',
                                    });

                                    // Reload halaman setelah beberapa detik
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1500);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to delete FAQ.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#d33',
                                });
                            }
                        });
                    }
                });
            }

            // Attach the delete function to the delete buttons
            window.deleteFaq = deleteFaq;
        });
    </script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
