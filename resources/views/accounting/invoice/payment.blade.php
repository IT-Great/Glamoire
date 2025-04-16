<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Glamoire</title>

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
            --primary-color: #435ebe;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --bg-light: #f9fafb;
            --card-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Nunito', sans-serif;
        }

        .main-content {
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 25px 0 rgba(34, 41, 47, 0.2);
        }

        .page-title h2 {
            color: #333;
            font-weight: 700;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .invoice-header {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-color);
        }

        .invoice-amount {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .invoice-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            background-color: #fff8dd;
            color: #ffc107;
        }

        .form-control,
        .form-select {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #dce7f1;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            border-color: #435ebe;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 0 1rem;
            color: #6c757d;
        }

        .form-control-icon~.form-control {
            padding-left: 3rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .text-muted {
            color: #6c757d !important;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 2px 6px 0 rgba(67, 94, 190, 0.5);
        }

        .btn-primary:hover {
            background-color: #3949ab;
            border-color: #3949ab;
        }

        .card-section {
            /* margin-bottom: 4rem; */
            border-radius: 10px;
            border: none;
        }

        .card-section .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
        }

        .card-section .card-body {
            padding: 1.5rem;
        }

        .upload-area {
            border: 2px dashed #dce7f1;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: var(--primary-color);
        }

        .upload-area i {
            font-size: 3rem;
            color: #dce7f1;
            margin-bottom: 1rem;
        }

        .file-preview {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }

        .file-preview img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .tooltip-info {
            color: var(--primary-color);
            cursor: pointer;
            margin-left: 5px;
        }

        .info-badge {
            font-size: 0.75rem;
            padding: 0.3em 0.6em;
            border-radius: 50px;
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

        <div id="main" class="main-content">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Manajemen Invoice</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/invoice">Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Proses Pembayaran</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-header mb-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <h4 class="mb-3">Detail Invoice</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Nomor Invoice :</strong>
                                                            <span>{{ $invoice->no_invoice }}</span>
                                                        </p>
                                                        <p class="mb-1"><strong>Supplier :</strong>
                                                            <span>{{ $invoice->supplier->name }}</span>
                                                        </p>
                                                        <p class="mb-1"><strong>Tanggal Invoice :</strong> <span>15
                                                                April 2025</span></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Status :</strong> <span
                                                                class="invoice-status">Belum Dibayar</span></p>
                                                        <p class="mb-1"><strong>Tanggal Jatuh Tempo :</strong>
                                                            <span>30
                                                                April 2025</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 text-md-end mt-4 mt-md-0">
                                                <p class="mb-1"><strong>Total Tagihan :</strong></p>
                                                <h2 class="invoice-amount">Rp
                                                    {{ number_format($invoice->amount, 0, ',', '.') }}</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="text-muted mb-4">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Silakan isi formulir di bawah ini untuk memproses pembayaran
                                    </h5>

                                    <form action="{{ route('process-invoice-payment', ['id' => $invoice->id]) }}"
                                        method="POST" enctype="multipart/form-data" class="needs-validation"
                                        novalidate>
                                        @csrf
                                        <input type="hidden" name="invoice_id" id="invoice_id"
                                            value="{{ $invoice->id }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-section">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">
                                                            <i class="bi bi-calendar-check me-2 text-primary"></i>
                                                            Informasi Pembayaran
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group mb-4">
                                                            <label for="payment_date" class="form-label">Tanggal
                                                                Pembayaran <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('payment_date') ? 'is-invalid' : '' }}"
                                                                    id="payment_date" name="payment_date"
                                                                    value="{{ old('payment_date') }}" required>
                                                                <div class="invalid-feedback">
                                                                    Tanggal pembayaran wajib diisi
                                                                </div>
                                                            </div>

                                                            <small class="text-muted">Tanggal ketika pembayaran
                                                                dilakukan</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="payment_method" class="form-label">Metode
                                                                Pembayaran <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <select
                                                                    class="form-select {{ $errors->has('payment_method') ? 'is-invalid' : '' }}"
                                                                    id="payment_method" name="payment_method"
                                                                    required>
                                                                    <option value="" disabled selected>Pilih
                                                                        Metode Pembayaran</option>
                                                                    <option value="Cash"
                                                                        {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                                                                        Tunai</option>
                                                                    <option value="Bank"
                                                                        {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>
                                                                        Transfer Bank</option>
                                                                    <option value="Debit"
                                                                        {{ old('payment_method') == 'Debit' ? 'selected' : '' }}>
                                                                        Kartu Debit</option>
                                                                    <option value="Credit"
                                                                        {{ old('payment_method') == 'Credit' ? 'selected' : '' }}>
                                                                        Kartu Kredit</option>
                                                                </select>

                                                                <div class="invalid-feedback">
                                                                    Metode pembayaran wajib dipilih
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">Metode yang digunakan untuk
                                                                pembayaran</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="reference_number" class="form-label">Nomor
                                                                Referensi Transaksi</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('reference_number') ? 'is-invalid' : '' }}"
                                                                    id="reference_number" name="reference_number"
                                                                    placeholder="Nomor referensi transfer, nomor cek, dll."
                                                                    value="{{ old('reference_number') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-hash"></i>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">Nomor referensi untuk pelacakan
                                                                pembayaran</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="amount" class="form-label">Jumlah Pembayaran
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="number"
                                                                    class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                    id="amount" name="amount"
                                                                    value="{{ old('amount') ?? $invoice->amount }}"
                                                                    required>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Jumlah pembayaran wajib diisi
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">Masukkan jumlah yang
                                                                dibayarkan</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card-section">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">
                                                            <i class="bi bi-journal-check me-2 text-primary"></i>
                                                            Informasi Akun
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group mb-4">
                                                            <label for="debit_coa_id" class="form-label">Akun Debit
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="debit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('debit_coa_id') ? '' : 'selected' }}>
                                                                    Pilih Akun Debit
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ old('debit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Akun debit wajib dipilih
                                                            </div>
                                                            <small class="text-muted">Pilih akun yang akan
                                                                didebit</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="kredit_coa_id" class="form-label">Akun Kredit
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="kredit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('kredit_coa_id') ? '' : 'selected' }}>
                                                                    Pilih Akun Kredit
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ old('kredit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Akun kredit wajib dipilih
                                                            </div>
                                                            <small class="text-muted">Pilih akun yang akan
                                                                dikredit</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="payment_notes"
                                                                class="form-label">Catatan</label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" id="payment_notes" name="payment_notes" rows="3"
                                                                    placeholder="Informasi tambahan tentang pembayaran" style="height: 100px">{{ old('payment_notes') }}</textarea>
                                                                <label for="payment_notes">Catatan Tambahan</label>
                                                            </div>
                                                            <small class="text-muted">Informasi tambahan tentang
                                                                pembayaran ini</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="card-section">
                                                <div class="card-header">
                                                    <h5 class="mb-0"><i
                                                            class="bi bi-file-earmark-image me-2 text-primary"></i>
                                                        Unggah
                                                        Bukti Pembayaran <span class="text-danger">*</span></h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="upload-area {{ $errors->has('image_proof') ? 'is-invalid border border-danger' : '' }}"
                                                        id="image-upload-wrap"
                                                        onclick="document.getElementById('file-input').click();">
                                                        <input type="file" name="image_proof" id="file-input"
                                                            class="d-none" onchange="previewFile(this);"
                                                            accept="image/*,application/pdf">
                                                        <div class="text-center">
                                                            <i class="bi bi-cloud-arrow-up"></i>
                                                            <h5 class="mt-3 mb-2">Seret dan lepas file atau klik untuk
                                                                mengunggah</h5>
                                                            <p class="text-muted mb-0">Format yang diterima: JPG, PNG,
                                                                PDF
                                                                (Maks 5MB)</p>
                                                        </div>
                                                    </div>

                                                    <div class="file-preview mt-3" id="file-preview"
                                                        style="display:none;">
                                                        <img src="#" id="preview-image" alt="Preview">
                                                        <div class="flex-grow-1">
                                                            <p class="mb-0 fw-bold" id="file-name"></p>
                                                            <small class="text-muted">Dokumen yang diunggah</small>
                                                        </div>
                                                        <button type="button" onclick="removeFile()"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>

                                                    <div class="alert alert-info mt-3">
                                                        <i class="bi bi-info-circle me-2"></i>
                                                        Unggah bukti pembayaran seperti screenshot transfer bank, foto
                                                        kwitansi, atau dokumen pembayaran lainnya.
                                                    </div>

                                                    @if ($errors->has('image_proof'))
                                                        <p class="text-danger mt-2">
                                                            {{ $errors->first('image_proof') }}
                                                        </p>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="alert alert-warning">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"
                                                            style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <strong>Perhatian!</strong>
                                                            <p class="mb-0">Pastikan semua informasi pembayaran sudah
                                                                benar sebelum memproses. Tindakan ini akan menyelesaikan
                                                                invoice dan mencatat pembayaran dalam sistem.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="button" class="btn btn-light-secondary me-2">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Proses Pembayaran
                                            </button>
                                        </div>
                                    </form>
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

    {{-- <script>
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
    </script> --}}

    <script>
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // File preview functionality
        function previewFile(input) {
            const preview = document.getElementById('preview-image');
            const filePreview = document.getElementById('file-preview');
            const uploadArea = document.getElementById('image-upload-wrap');
            const fileName = document.getElementById('file-name');

            const file = input.files[0];

            if (file) {
                filePreview.style.display = 'flex';
                uploadArea.style.display = 'none';
                fileName.textContent = file.name;

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '/api/placeholder/50/50'; // Placeholder for PDF
                }
            }
        }

        function removeFile() {
            const fileInput = document.getElementById('file-input');
            const filePreview = document.getElementById('file-preview');
            const uploadArea = document.getElementById('image-upload-wrap');

            fileInput.value = '';
            filePreview.style.display = 'none';
            uploadArea.style.display = 'block';
        }
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
