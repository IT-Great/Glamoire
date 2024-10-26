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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        .list-group-item {
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
            /* Menunjukkan bahwa item dapat diklik */
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            /* Ganti warna latar belakang saat hover */
            transform: scale(1.02);
            /* Sedikit memperbesar item saat hover */
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
                                    <li class="breadcrumb-item"><a href="/brand-admin">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/brand-admin/contact">Contact Us</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Messages</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
        
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Us Messages</h4>
                            <p class="text-muted">Review all incoming messages and click on a message to view or respond.</p>
                        </div>
                        <div class="card-body">
                            {{-- <!-- Search Bar (Optional) -->
                            <form action="" method="GET" class="mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search messages by name or email..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form> --}}

                            <div class="row align-items-center mb-4">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search messages by name or email...">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Search By Date</span>
                                        <input type="date" class="form-control" style="max-width: 150px;">
                                        {{-- <span class="mx-2">-</span>
                                        <input type="date" class="form-control" style="max-width: 150px;"> --}}
                                    </div>
                                </div>
                                
                            </div>
        
                            <!-- Contact Messages List -->
                            <ul class="list-group">
                                @foreach ($contacts as $contact)
                                    <li class="list-group-item list-group-item-action" style="cursor: pointer;"
                                        onclick="window.location='{{ route('show-contactus-admin', $contact->id) }}'">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Image"
                                                class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <div>
                                                <strong>{{ $contact->name }} ({{ $contact->email }}):</strong>
                                                <p class="mb-1">{{ Str::limit($contact->question, 100, '...') }}</p>
                                                <small class="text-muted">Received on: {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
        
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-between mt-4 px-3" id="pagination-container">
                                <div class="mb-3">
                                    Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }}
                                    of
                                    {{ $contacts->total() }} results
                                </div>
                                <div class="pagination-container">
                                    {{ $contacts->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>        
            </div>
        </div>        
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    @if (session('toast_success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('toast_success') }}',
                showConfirmButton: false,
                timer: 3000, // Toast will disappear after 3 seconds
                timerProgressBar: true
            });
        </script>
    @endif
</body>

</html>
