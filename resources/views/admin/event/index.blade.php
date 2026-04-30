<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Event - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- PERBAIKAN: Menggunakan helper asset() agar link CSS tidak error 404 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <!-- PERBAIKAN: Menggunakan CDN untuk FontAwesome agar file .woff tidak error 404 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

        .action-buttons .btn {
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

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .btn-info {
            background-color: var(--info-color) !important;
            border-color: var(--info-color) !important;
            color: white;
        }

        .btn-danger {
            background-color: var(--danger-color) !important;
            border-color: var(--danger-color) !important;
            color: white;
        }

        .event-image-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .action-buttons {
                flex-direction: column;
            }
            .table td {
                padding: 1rem;
            }
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
                            <h2>Manajemen Event</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard" class="d-flex align-items-center"><i class="bi bi-grid-fill me-1"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Event</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <p class="text-subtitle text-muted">Kelola dokumentasi acara dan event Glamoire.</p>
            </div>

            <!-- Alert Success/Error -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <section class="section">
                <div class="card event-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-0 d-flex align-items-center"><i class="bi bi-calendar-event-fill me-2"></i> Daftar Event</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center mt-3 mt-md-0">
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
                                    <i class="fa fa-plus"></i> Tambah Event Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Event</th>
                                        <th>Tanggal</th>
                                        <th>Season</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bold">{{ $event->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                            <td>{{ $event->season ?? '-' }}</td>
                                            <td>
                                                @if($event->status == 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($event->images) && count($event->images) > 0)
                                                    <img src="{{ Storage::url($event->images[0]) }}" alt="Event" class="event-image-thumbnail">
                                                    @if(count($event->images) > 1)
                                                        <span class="badge bg-dark ms-1">+{{ count($event->images) - 1 }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted" style="font-size: 0.8rem;">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editEventModal-{{ $event->id }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" id="delete-form-{{ $event->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger d-inline-flex align-items-center delete-event" data-id="{{ $event->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editEventModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel-{{ $event->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="editEventModalLabel-{{ $event->id }}">Ubah Event</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label text-dark fw-bold">Judul Event <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 form-group mb-3">
                                                                    <label class="form-label text-dark fw-bold">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control" name="event_date" value="{{ $event->event_date }}" required>
                                                                </div>
                                                                <div class="col-md-6 form-group mb-3">
                                                                    <label class="form-label text-dark fw-bold">Season / Tema (Opsional)</label>
                                                                    <input type="text" class="form-control" name="season" value="{{ $event->season }}" placeholder="Contoh: Summer 2026">
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label text-dark fw-bold">Status <span class="text-danger">*</span></label>
                                                                <select name="status" class="form-select" required>
                                                                    <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Published (Tampil)</option>
                                                                    <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label text-dark fw-bold">Deskripsi Acara</label>
                                                                <textarea name="description" class="form-control" rows="5">{{ $event->description }}</textarea>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label text-dark fw-bold">Gambar Dokumentasi</label>
                                                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah gambar yang sudah ada.</small>

                                                                <!-- Preview Current Images -->
                                                                @if(!empty($event->images))
                                                                    <div class="d-flex gap-2 mt-3 flex-wrap">
                                                                        @foreach($event->images as $img)
                                                                            <img src="{{ Storage::url($img) }}" alt="Preview" style="height: 70px; border-radius: 8px; border: 1px solid #ddd; object-fit: cover;">
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CREATE MODAL -->
            <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark fw-bold">Judul Event <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required placeholder="Contoh: Glamoire Beauty Exhibition">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="form-label text-dark fw-bold">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="event_date" required>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="form-label text-dark fw-bold">Season / Tema (Opsional)</label>
                                        <input type="text" class="form-control" name="season" placeholder="Contoh: Summer Collection 2026">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark fw-bold">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="published">Published (Tampil)</option>
                                        <option value="draft">Draft (Sembunyikan)</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark fw-bold">Deskripsi Acara</label>
                                    <textarea name="description" class="form-control" rows="5" placeholder="Ceritakan detail kemeriahan acara..."></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark fw-bold">Gambar Dokumentasi <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="images[]" multiple accept="image/*" required>
                                    <small class="text-muted d-block mt-1">Tahan tombol CTRL (Windows) atau CMD (Mac) untuk memilih banyak gambar sekaligus.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- PERBAIKAN: Menggunakan helper asset() untuk semua script agar tidak error 404 -->
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        // --- SAFETY FIX UNTUK ERROR CONSOLE BAWAAN LAYOUT/TEMPLATE MAZER ---
        window.addEventListener('DOMContentLoaded', () => {
            // 1. Mencegah error 'updateContactUsNotifications is not defined'
            if (typeof window.updateContactUsNotifications !== 'function') {
                window.updateContactUsNotifications = function() { return false; };
            }
            // 2. Mencegah error 'Cannot set properties of null (setting textContent)'
            if (!document.getElementById('notif-badge-stock')) {
                let dummyBadge = document.createElement('div');
                dummyBadge.id = 'notif-badge-stock';
                dummyBadge.style.display = 'none';
                document.body.appendChild(dummyBadge);
            }
        });

        // Simple Datatable Initialization
        let table1 = document.querySelector('#table1');
        if(table1) {
            let dataTable = new simpleDatatables.DataTable(table1);
        }

        // SweetAlert2 for Delete Confirmation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-event').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const form = document.getElementById('delete-form-' + id);

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Event beserta gambarnya akan dihapus permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
