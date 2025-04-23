<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

    <style>
        :root {
            --primary: #435ebe;
            --primary-light: #546fd0;
            --success: #4fbe87;
            --danger: #eb5757;
            --warning: #f59e0b;
            --info: #3b82f6;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f2f7ff;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .promo-nav {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .promo-nav-item {
            padding: 12px 24px;
            border-radius: 10px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .promo-nav-item i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .promo-nav-item.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.2);
        }

        .promo-nav-item:hover:not(.active) {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow: hidden;
            background-color: white;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 25px 30px;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            font-size: 1.25rem;
        }

        .card-header h4 i {
            margin-right: 10px;
            color: var(--primary);
        }

        .card-body {
            padding: 25px 30px;
        }

        .btn {
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 3px 10px rgba(67, 94, 190, 0.2);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.3);
        }

        .btn-light-secondary {
            background-color: #e9ecef;
            color: var(--secondary);
            border: 1px solid #dee2e6;
        }

        .btn-light-secondary:hover {
            background-color: #dee2e6;
            transform: translateY(-2px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            background-color: #fff;
            outline: none;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            color: #495057;
        }

        .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            width: 100%;
            appearance: auto;
            font-size: 1rem;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            outline: none;
        }

        .position-relative {
            position: relative;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12px;
            color: var(--secondary);
        }

        .form-control-icon+.form-control {
            padding-left: 40px;
        }

        .has-icon-left .form-control {
            padding-left: 40px;
        }

        .text-danger {
            color: var(--danger);
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .text-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .page-title h2 {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin-bottom: 1rem;
            list-style: none;
            background-color: transparent;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .breadcrumb-item.active {
            color: var(--secondary);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            display: inline-block;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            color: #6c757d;
            content: "/";
        }

        .bg-light-primary {
            background-color: rgba(67, 94, 190, 0.1) !important;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        #main {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (max-width: 767.98px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .d-flex {
            display: flex;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .justify-content-start {
            justify-content: flex-start;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-3 {
            gap: 1rem;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .py-3 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* Form floating styles */
        .form-floating {
            position: relative;
        }

        .form-floating textarea.form-control {
            height: auto;
            min-height: 100px;
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }

        .form-floating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem 0.75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out;
            color: var(--secondary);
        }

        .form-floating textarea.form-control:focus~label,
        .form-floating textarea.form-control:not(:placeholder-shown)~label {
            opacity: .65;
            transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
            background-color: white;
            padding: 0 0.5rem;
            height: auto;
        }


        /* Styling container Select2 */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        /* Styling rendered text */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
            padding-right: 30px;
        }

        /* Styling arrow position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 6px;
        }

        /* Tambahkan styling untuk dropdown options */
        .select-lg-dropdown .select2-results__option {
            padding: 6px 12px;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title" style="margin-bottom: 25px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Transaction Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/transaction">Transaction</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Transaction</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('create-transaction', ['type' => 'transfer']) }}" class="promo-nav-item">
                        <i class="bi bi-arrow-left-right me-2"></i>Transfer
                    </a>
                    <a href="{{ route('create-transaction', ['type' => 'receive']) }}" class="promo-nav-item active">
                        <i class="bi bi-download me-2"></i>Receive
                    </a>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-content">
                                    <div class="card-body">

                                        <form
                                            action="{{ route('update-transaction-receive', ['id' => $transaction->id]) }}"
                                            class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="type" value="{{ $type }}">

                                            <div class="form-body">
                                                <h3 class="mb-2"><i class="bi bi-file-earmark-plus me-2"></i>Create
                                                    New
                                                    Transaction</h3>
                                                <p class="text-muted">Fill in the form below to create a new
                                                    transaction
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="no_transaction" class="form-label">No.
                                                                Transaksi
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_transaction') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Nomor Transaksi"
                                                                    id="no_transaction" name="no_transaction"
                                                                    value="{{ $transaction->no_transaction }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('no_transaction'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('no_transaction') }}</p>
                                                            @else
                                                                <small class="text-muted">Masukkan nomor transaksi unik
                                                                    (contoh: INV-2025-001)</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="kredit-account" class="form-label">Akun Kredit
                                                                <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="kredit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled>Pilih Kredit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $transaction->kredit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('kredit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('kredit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Pilih akun yang akan
                                                                    dikreditkan</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="recipient_name" class="form-label">Penerima
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('recipient_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Nama Penerima"
                                                                    id="recipient_name" name="recipient_name"
                                                                    value="{{ $transaction->recipient_name }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('recipient_name'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('recipient_name') }}</p>
                                                            @else
                                                                <small class="text-muted">Masukkan nama penerima yang
                                                                    sesuai</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="end-date" class="form-label">Tanggal <span
                                                                    class="text-danger">*</span></label>

                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                                                    id="date" name="date"
                                                                    value="{{ isset($transaction->date) ? \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') : '' }}">

                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('date'))
                                                                <p style="color: red">{{ $errors->first('date') }}</p>
                                                            @else
                                                                <small class="text-muted">Pilih tanggal
                                                                    transaksi</small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="amount" class="form-label">Jumlah <span
                                                                    class="text-danger">*</span></label>

                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Amount" id="amount"
                                                                    name="amount"
                                                                    value="{{ $transaction->amount }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('amount'))
                                                                <p style="color: red">{{ $errors->first('amount') }}
                                                                </p>
                                                            @else
                                                                <small class="text-muted">Masukkan jumlah tagihan dalam
                                                                    IDR</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="debit-account" class="form-label">Akun Debit
                                                                <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="debit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled>Pilih Debit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $transaction->debit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('debit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('debit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Pilih akun yang akan
                                                                    didebit</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="description"
                                                                class="form-label">Deskripsi</label>

                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Enter description" id="description" name="description" rows="4"
                                                                    style="height: 100px">{{ $transaction->description ?? '' }}</textarea>
                                                            </div>
                                                            <small class="text-muted">Masukkan rincian mengenai tagihan
                                                                ini</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <button type="button"
                                                            class="btn btn-sm btn-light-secondary me-2">
                                                            <i class="bi bi-arrow-left-circle me-1"></i>
                                                            Kembali
                                                        </button>
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Submit Transaction
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

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

    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                width: '100%',
                // Gunakan templateResult untuk mengontrol tampilan dropdown items
                templateResult: formatState,
                // Gunakan templateSelection untuk mengontrol selected item
                templateSelection: formatState,
                dropdownCssClass: 'select-lg-dropdown'
            });

            // Fungsi untuk format tampilan item
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                // Buat container dengan style yang mencegah overflow
                var $state = $(
                    '<span style="white-space: normal; word-break: break-word; display: block;">' + state.text +
                    '</span>'
                );

                return $state;
            }
        });
    </script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-upload-wrap').style.display = 'none';
                    document.getElementById('file-upload-content').style.display = 'block';
                    document.getElementById('file-upload-image').src = e.target.result;
                    document.getElementById('image-file-name').innerText = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeUpload(el, id) {
            const fileInput = document.querySelector('.file-upload-input');
            fileInput.value = '';
            document.getElementById('image-upload-wrap').style.display = 'flex';
            document.getElementById('file-upload-content').style.display = 'none';
        }

        // Calculate PPH based on amount and percentage
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const pphPercentageInput = document.getElementById('pph-percentage');
            const pphInput = document.getElementById('pph');

            function calculatePPH() {
                const amount = parseFloat(amountInput.value) || 0;
                const percentage = parseFloat(pphPercentageInput.value) || 0;
                const pphAmount = (amount * percentage / 100).toFixed(2);
                pphInput.value = pphAmount;
            }

            amountInput.addEventListener('input', calculatePPH);
            pphPercentageInput.addEventListener('input', calculatePPH);
        });
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
