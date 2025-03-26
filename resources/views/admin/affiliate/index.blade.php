<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate - Glamoire</title>

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
                                    <li class="breadcrumb-item"><a href="/product-admin">Affiliate</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Affiliate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Affiliate Data</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Category Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partners as $item)
                                        <tr>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->company_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->category_product }}</td>
                                            <td>
                                                <a href="{{ url('detail-affiliate-admin/' . $item->id) }}"
                                                    class="badge bg-info mb-2 d-inline-flex align-items-center">
                                                    <i class="bi bi-eye"></i> View
                                                </a>

                                                <a href="javascript:void(0);"
                                                    class="badge bg-danger delete-product mb-2 d-inline-flex align-items-center"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i> Delete
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
