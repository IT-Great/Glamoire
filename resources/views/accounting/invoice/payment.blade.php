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

        /* CSS untuk Upload Zone */
        .upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            background-color: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .upload-zone:hover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .upload-zone.drag-over {
            border-color: #3b82f6;
            background-color: #dbeafe;
        }

        .upload-zone.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .upload-icon {
            color: #6b7280;
            margin-bottom: 16px;
        }

        .upload-prompt {
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .upload-hint {
            font-size: 14px;
            color: #6b7280;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 8px;
        }

        /* Preview Styles */
        .upload-preview {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            background-color: #ffffff;
            margin-top: 16px;
        }

        .preview-header {
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .preview-image-container {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-icon {
            color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-details {
            flex-grow: 1;
        }

        .preview-filename {
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }

        .preview-meta {
            font-size: 14px;
            color: #6b7280;
        }

        .remove-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .remove-button:hover {
            background-color: #fecaca;
        }

        .progress-container {
            height: 4px;
            background-color: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background-color: #3b82f6;
            width: 0%;
            transition: width 0.3s ease;
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
                            <h2 class="mb-3">Proses Pembayaran</h2>
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
                                                            id="payment_method" name="payment_method" required>
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
                                                            value="{{ old('amount') ?? $invoice->amount }}" required>
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

                                            <div class="col-md-6">
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
                                                    <label for="payment_notes" class="form-label">Catatan</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="payment_notes" name="payment_notes" rows="3"
                                                            placeholder="Informasi tambahan tentang pembayaran" style="height: 100px">{{ old('payment_notes') }}</textarea>
                                                        <label for="payment_notes">Catatan Tambahan</label>
                                                    </div>
                                                    <small class="text-muted">Informasi tambahan tentang
                                                        pembayaran ini</small>
                                                </div>

                                                <div class="mb-4">
                                                    <div class="form-group mb-4">
                                                        <!-- Upload Title -->
                                                        <label class="mb-3">Unggah Bukti Pembayaran <span
                                                                style="color: red;">*</span></label>

                                                        <!-- Current Payment Proof Document (if exists) -->
                                                        @if ($invoice->image_proof)
                                                            <div class="mb-4">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    @if (Str::endsWith($invoice->image_proof, ['.jpg', '.jpeg', '.png']))
                                                                        <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                                alt="Bukti Pembayaran"
                                                                                class="rounded shadow-sm"
                                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                            target="_blank" class="btn btn-info">Lihat
                                                                            Dokumen PDF</a>
                                                                    @endif
                                                                    <div>
                                                                        <p class="mb-1 fw-bold">
                                                                            {{ basename($invoice->image_proof) }}</p>
                                                                        <small class="text-muted">Bukti pembayaran yang
                                                                            telah diunggah saat ini</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Upload Zone -->
                                                        <div class="upload-zone" id="upload-zone-proof">
                                                            <input type="file" name="image_proof"
                                                                id="file-input-proof" class="file-input"
                                                                accept="image/*,application/pdf"
                                                                onchange="handleFileSelectProof(this)">
                                                            <div class="upload-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="48"
                                                                    height="48" fill="currentColor"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                    <path
                                                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                                                </svg>
                                                            </div>
                                                            <div class="upload-prompt">Klik untuk memilih file atau
                                                                seret file ke sini</div>
                                                            <div class="upload-hint">Format diterima: JPG, PNG, PDF
                                                                &mdash; Maks. 5MB</div>
                                                            <div class="progress-container"
                                                                id="upload-progress-container-proof">
                                                                <div class="progress-bar"
                                                                    id="upload-progress-bar-proof"></div>
                                                            </div>
                                                        </div>
                                                        <div class="error-message" id="upload-error-proof">
                                                            @if ($errors->has('image_proof'))
                                                                {{ $errors->first('image_proof') }}
                                                            @endif
                                                        </div>

                                                        <!-- Preview of New Upload -->
                                                        <div class="upload-preview" id="upload-preview-proof"
                                                            style="display: none;">
                                                            <div class="preview-header">Preview Bukti Pembayaran Baru
                                                            </div>
                                                            <div class="preview-content">
                                                                <div class="preview-image-container">
                                                                    <img class="preview-image"
                                                                        id="preview-image-proof" src=""
                                                                        alt="Preview">
                                                                    <div class="preview-icon" id="preview-icon-proof"
                                                                        style="display: none;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="32" height="32"
                                                                            fill="currentColor" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                            <path
                                                                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <div class="preview-details">
                                                                    <div class="preview-filename"
                                                                        id="preview-filename-proof">filename.jpg</div>
                                                                    <div class="preview-meta">Bukti Pembayaran yang
                                                                        akan diunggah</div>
                                                                </div>
                                                                <button type="button" class="remove-button"
                                                                    onclick="removeUploadProof()">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                        <path
                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end mt-3">
                                            <a href="{{ route('index-invoice') }}" type="button"
                                                class="btn btn-sm btn-light-secondary me-2 d-flex align-items-center">
                                                <i class="bi bi-arrow-left-circle me-1"></i>
                                                Kembali
                                            </a>
                                            <button type="submit"
                                                class="btn btn-sm btn-primary d-flex align-items-center">
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

    {{-- upload file gambar --}}
    <script>
        // Handle file selection for Payment Proof
        function handleFileSelectProof(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            // Reset error
            document.getElementById('upload-error-proof').textContent = '';
            document.getElementById('upload-zone-proof').classList.remove('error');

            // Check file type
            if (!validTypes.includes(file.type)) {
                document.getElementById('upload-error-proof').textContent = 'File harus berformat JPG, PNG, atau PDF.';
                document.getElementById('upload-zone-proof').classList.add('error');
                input.value = '';
                return;
            }

            // Check file size
            if (file.size > maxSize) {
                document.getElementById('upload-error-proof').textContent = 'Ukuran file tidak boleh melebihi 5MB.';
                document.getElementById('upload-zone-proof').classList.add('error');
                input.value = '';
                return;
            }

            // Show progress first
            simulateUploadProgressProof();

            // Show preview after progress is complete
            setTimeout(() => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('upload-preview-proof');
                    const previewImage = document.getElementById('preview-image-proof');
                    const previewIcon = document.getElementById('preview-icon-proof');
                    const previewFilename = document.getElementById('preview-filename-proof');

                    previewContainer.style.display = 'block';
                    previewFilename.textContent = file.name;

                    if (file.type === 'application/pdf') {
                        previewImage.style.display = 'none';
                        previewIcon.style.display = 'flex';
                    } else {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewIcon.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }, 1100); // Show preview after progress completes
        }

        // Remove upload for Payment Proof
        function removeUploadProof() {
            document.getElementById('file-input-proof').value = '';
            document.getElementById('upload-preview-proof').style.display = 'none';
            document.getElementById('upload-progress-container-proof').style.display = 'none';
            document.getElementById('upload-progress-bar-proof').style.width = '0%';
            document.getElementById('upload-error-proof').textContent = '';
            document.getElementById('upload-zone-proof').classList.remove('error');
        }

        // Simulate upload progress for Payment Proof
        function simulateUploadProgressProof() {
            const progressContainer = document.getElementById('upload-progress-container-proof');
            const progressBar = document.getElementById('upload-progress-bar-proof');

            progressContainer.style.display = 'block';
            progressBar.style.width = '0%';

            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15 + 5; // Random progress between 5-20%
                if (progress > 100) progress = 100;

                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.style.display = 'none';
                        progressBar.style.width = '0%';
                    }, 500);
                }
            }, 100);
        }

        // Drag and drop handling for Payment Proof
        document.addEventListener('DOMContentLoaded', function() {
            const dropZoneProof = document.getElementById('upload-zone-proof');
            const fileInputProof = document.getElementById('file-input-proof');

            if (dropZoneProof && fileInputProof) {
                dropZoneProof.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.add('drag-over');
                });

                dropZoneProof.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.remove('drag-over');
                });

                dropZoneProof.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.remove('drag-over');

                    if (e.dataTransfer.files.length) {
                        fileInputProof.files = e.dataTransfer.files;
                        handleFileSelectProof(fileInputProof);
                    }
                });

                // Click to upload
                dropZoneProof.addEventListener('click', (e) => {
                    if (e.target === fileInputProof) return;
                    fileInputProof.click();
                });
            }
        });
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
