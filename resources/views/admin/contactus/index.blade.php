<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us || Admin Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/brand-admin">Contact Us</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Us Messages</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($contacts as $contact)
                                    <li class="list-group-item"
                                        onclick="window.location='{{ route('show-contactus-admin', $contact->id) }}'">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Image"
                                                class="rounded-circle"
                                                style="width: 50px; height: 50px; margin-right: 10px;">
                                            <div>
                                                <strong>{{ $contact->name }}
                                                    ({{ $contact->email }})
                                                    :</strong>
                                                <p>{{ Str::limit($contact->question, 100, '...') }}</p>
                                                <small>{{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y H:i') }}</small>
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
