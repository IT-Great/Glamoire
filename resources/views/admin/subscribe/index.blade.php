{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe - Glamoire</title>

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
                                    <li class="breadcrumb-item"><a href="/brand-admin">Subscribe</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Subscribe</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>List User Subscribe</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Subscribe at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribe as $item)
                                        <tr>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                <a href="/order-detail"
                                                    class="badge bg-warning mb-2 d-inline-flex align-items-center">
                                                    <i class="bi bi-envelope-fill" style="margin-right: 3px"></i>Send
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Modal -->
            <form id="categoryForm">
                @csrf
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Add Categories</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <label>Category Name <span style="color: red">*</span> </label>
                                <div class="form-group mt-2">
                                    <input type="text" placeholder="Enter Category Name" class="form-control"
                                        name="name" id="name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary ml-1">
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @include('admin.layouts.footer')

        </div>
    </div>

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();

                let name = $('#name').val();
                let _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('create-category-product') }}",
                    type: "POST",
                    data: {
                        name: name,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#inlineForm').modal('hide');

                            // Bersihkan form
                            $('#categoryForm')[0].reset();

                            // Tampilkan SweetAlert sukses
                            Swal.fire({
                                title: 'Success!',
                                text: 'Category has been successfully created.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4A69E2', // Mengatur warna tombol OK
                                customClass: {
                                    icon: 'swal-icon-success'
                                }
                            });

                            // Refresh halaman setelah 1,5 detik
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            });

            $(document).on('click', '.delete-category', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4A69E2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/category-product/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Category has been deleted.',
                                        'success'
                                    );

                                    // Refresh halaman setelah 1,5 detik
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe - Glamoire</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
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
                                    <li class="breadcrumb-item"><a href="/brand-admin">Subscribe</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Subscribe</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>List User Subscribe</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Subscribe at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribe as $item)
                                        <tr>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning d-inline-flex align-items-center btn-send-email"
                                                    data-email="{{ $item->email }}">
                                                    <i class="bi bi-envelope-fill me-2"></i>Send
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <div class="modal fade text-left" id="modalSendEmail" tabindex="-1" role="dialog" aria-labelledby="modalSendEmailLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalSendEmailLabel">Kirim Email Promo</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="formSendEmail">
                            <div class="modal-body">
                                <div class="form-group mt-2">
                                    <label class="fw-bold">Penerima</label>
                                    <input type="email" class="form-control bg-light" name="email" id="targetEmail" readonly>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="fw-bold">Subjek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="subject" placeholder="Masukkan Subjek Email" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="fw-bold">Pesan Promo <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="message" rows="5" placeholder="Tulis pesan menarik untuk pelanggan..." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" id="btnSubmitEmail">
                                    <span class="d-none d-sm-block">Kirim Email</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Datatable
            let table1 = document.querySelector('#table1');
            if(table1) {
                new simpleDatatables.DataTable(table1);
            }

            // Membuka modal dan mengisi target email
            $(document).on('click', '.btn-send-email', function() {
                let targetEmail = $(this).data('email');
                $('#targetEmail').val(targetEmail);
                $('#formSendEmail')[0].reset(); // Bersihkan sisa isian sebelumnya
                $('#targetEmail').val(targetEmail); // Isi kembali setelah di-reset
                $('#modalSendEmail').modal('show');
            });

            // Eksekusi AJAX saat form disubmit
            $('#formSendEmail').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let submitBtn = $('#btnSubmitEmail');
                let formData = form.serialize();

                // Ubah status tombol menjadi loading
                submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...').prop('disabled', true);

                $.ajax({
                    url: "/admin/subscribe/send-email", // Pastikan Route ini terdaftar di web.php
                    type: "POST",
                    data: formData + "&_token=" + $('meta[name="csrf-token"]').attr('content'),
                    success: function(response) {
                        if (response.success) {
                            $('#modalSendEmail').modal('hide');
                            Swal.fire({
                                title: 'Terkirim!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#4A69E2',
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'Terjadi kesalahan sistem.';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Gagal!',
                            text: errorMsg,
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        });
                    },
                    complete: function() {
                        // Kembalikan status tombol seperti semula
                        submitBtn.html('<span class="d-none d-sm-block">Kirim Email</span>').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>
