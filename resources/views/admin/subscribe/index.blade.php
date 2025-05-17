<!DOCTYPE html>
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
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }
    </style>
</head>

<body>
    <div id="app">

        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <!-- Judul Halaman -->
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3 class="mb-2">Subscribe Management</h3>
                            <p>Kelola pelanggan subscribe dan kirimkan email secara langsung dari sistem.</p>
                        </div>
                    </div>
                </div>

                <!-- Navigasi Breadcrumb -->
                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index-subscribe-admin') }}">Subscribe</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">All Subscribe</li>
                            </ol>
                        </nav>
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
                                                <a href="#"
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

</html>
