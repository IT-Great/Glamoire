<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Article - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">

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
                                    <li class="breadcrumb-item"><a href="{{route('index-category-article')}}">Category Article</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Category Article</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h4>List Category Article</h4>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    <a href="{{route('index-article')}}" type="button"
                                        class="btn btn-sm btn-dark d-flex align-items-center"
                                        style="margin-right: 10px;">
                                        <i class="bi bi-box-arrow-in-right" style="margin-right: 3px;"></i>All Article
                                    </a>

                                    <a href="#" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm">
                                        <i class="fa fa-plus" style="margin-right: 3px;"></i> Add Category
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Total Article</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryArticle as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-light-success">{{ $item->articles_count ?? '0' }}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $item->id }}"> <i class="bi bi-trash"
                                                        style="margin-right: 3px"></i>Delete</button>
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
                    aria-labelledby="categoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content"
                            style="border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                            <div class="modal-header text-white"
                                style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                <h4 class="modal-title" id="categoryModalLabel">
                                    <i class="bi bi-folder-plus me-2"></i>Tambah Kategori Baru
                                </h4>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="mb-3">
                                    <p class="text-muted small mb-4">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Kategori membantu mengorganisir konten Anda dan memudahkan pengguna untuk
                                        menemukan
                                        item terkait.
                                    </p>

                                    <label for="name" class="form-label fw-bold">Nama Kategori <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-tag"></i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Contoh: Berita, Tutorial, Pengumuman">
                                    </div>
                                    <div class="form-text text-muted small">Pilih nama yang jelas dan ringkas.
                                        Misalnya:
                                        "Elektronik", "Koleksi Musim Panas"</div>
                                </div>
                            </div>

                            <div class="modal-footer bg-light"
                                style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x me-1"></i>Batal
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check2 me-1"></i>Buat Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();

                let name = $('#name').val();
                let _token = $('input[name="_token"]').val();

                console.log("Mengirim formulir dengan nama: " + name); // Baris debugging

                $.ajax({
                    url: "{{ route('create-category-article') }}",
                    type: "POST",
                    data: {
                        name: name,
                        _token: _token
                    },
                    success: function(response) {
                        console.log(response); // Baris debugging
                        if (response.success) {
                            $('#inlineForm').modal('hide');

                            // Bersihkan form
                            $('#categoryForm')[0].reset();

                            // Tampilkan SweetAlert sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Kategori artikel berhasil dibuat.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: true,
                                customClass: {
                                    icon: 'swal-icon-success'
                                }
                            });

                            // Refresh halaman setelah 1,5 detik
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat membuat kategori.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Baris debugging
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat membuat kategori.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '.delete-category', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4A69E2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/category-article/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Kategori artikel berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000, // Timer 2 detik
                                        timerProgressBar: true, // Tampilkan progress bar
                                        showConfirmButton: false, // Tidak perlu tombol OK
                                        willClose: () => {
                                            location
                                                .reload(); // Reload setelah 2 detik
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus kategori.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
