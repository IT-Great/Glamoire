<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-contactus-admin') }}">Contact
                                            Us</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Message Details and Response Form</h4>
                            <p class="text-muted">Review the details of the contact message and provide a clear, helpful
                                response.</p>
                        </div>
                        <div class="card-body">
                            <!-- Contact Details -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="border rounded p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Image"
                                                class="rounded-circle"
                                                style="width: 60px; height: 60px; margin-right: 15px;">
                                            <div>
                                                <h5 class="mb-1">Name: {{ $contact->fullname }}</h5>
                                                <p class="text-muted mb-1">Email: {{ $contact->email }}</p>
                                                <small>Message Sent on:
                                                    {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y H:i') }}</small>
                                            </div>
                                        </div>

                                        <!-- Message Content -->
                                        <div class="border-top pt-3">
                                            <h6>Message:</h6>
                                            <p class="text-muted"><strong>{{ $contact->question }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Response Form -->
                            <form action="{{ route('send-response', $contact->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="response"><strong>Your Response: <span class="text-danger">*</span></strong></label>
                                    <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" id="response" name="response"
                                        rows="5" placeholder="Write your detailed response here..."></textarea>

                                    @if ($errors->has('response'))
                                        <p style="color: red">{{ $errors->first('response') }}</p>
                                    @else
                                        <small class="text-muted" style="font-size: 14px;">
                                            Please provide a comprehensive response addressing the user's query. Be
                                            clear and concise.
                                        </small>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="bi bi-send"></i> Send Response
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: 'Error: {{ $errors->first() }}',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            @endif
        });
    </script>

</body>

</html>
