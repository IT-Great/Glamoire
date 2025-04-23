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
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ebedf2;
            padding: 15px 25px;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
            margin-bottom: 10px;
        }

        .card-title {
            margin-bottom: 0;
            color: #5d87ff;
            font-weight: 600;
        }

        .invoice-header {
            padding: 20px;
            border-bottom: 1px solid #ebedf2;
            background-color: #f8f9fa;
        }

        .invoice-meta-data {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .invoice-meta-item {
            margin-bottom: 10px;
        }

        .amount-box {
            background-color: #f0f7ff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
        }

        .amount-value {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 50px;
        }

        .status-paid {
            background-color: #d1f3e0;
            color: #17a85e;
        }

        .status-not-yet {
            background-color: #ffece8;
            color: #ff5c4d;
        }

        .payment-history-item {
            border-left: 3px solid #5d87ff;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .payment-date {
            font-size: 12px;
            color: #6c757d;
        }

        .payment-amount {
            font-weight: 600;
            color: #2c3e50;
        }

        .payment-method-badge {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 50px;
            background-color: #e9ecef;
            color: #495057;
        }

        .payment-method-cash {
            background-color: #fff4de;
            color: #ffa800;
        }

        .payment-method-bank {
            background-color: #e8f4ff;
            color: #0d6efd;
        }

        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .invoice-detail-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .deadline-info {
            font-size: 14px;
        }

        .deadline-safe {
            color: #198754;
        }

        .deadline-warning {
            color: #ffc107;
        }

        .deadline-danger {
            color: #dc3545;
        }

        .proof-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .proof-image:hover {
            transform: scale(1.02);
        }

        .detail-section {
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: 500;
            color: #6c757d;
        }

        .detail-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 25px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #5d87ff;
            border: 3px solid #ffffff;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .payment-proof-modal .modal-body {
            padding: 0;
        }

        .payment-proof-modal .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .invoice-meta-data {
                flex-direction: column;
            }

            .invoice-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
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

                <div class="page-title mb-2">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Edit Invoice Supplier</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/invoice">Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Invoice</li>
                                </ol>
                            </nav>
                            <p class="text-subtitle text-muted mt-2">
                                Edit data invoice dan lihat riwayat pembayaran secara lengkap.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">

                {{-- bagian invoice --}}
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('update-invoice') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <div class="form-body">
                                                <h3><i class="bi bi-pencil-square"></i> Edit Invoice</h3>
                                                <p class="text-subtitle text-muted">Perbarui data invoice</p>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">No. Invoice
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_invoice') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Invoice Number"
                                                                    id="invoice-number" name="no_invoice"
                                                                    value="{{ $invoice->no_invoice }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('no_invoice'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('no_invoice') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter a unique invoice number
                                                                (e.g. INV-2025-001)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="debit-account" class="form-label">Debit Account
                                                                <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="debit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled>Pilih Debit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $invoice->debit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('debit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('debit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Select the account to be
                                                                    debited</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="amount" class="form-label">Amount <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Amount" id="amount"
                                                                    name="amount" value="{{ $invoice->amount }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('amount'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('amount') }}</p>
                                                            @else
                                                                <small class="text-muted">Enter the invoice amount in
                                                                    IDR</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph-percentage" class="form-label">PPH
                                                                Percentage </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('pph_percentage') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter PPH Percentage"
                                                                    id="pph-percentage" name="pph_percentage"
                                                                    value="{{ $invoice->pph_percentage ?? '' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-percent"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('pph_percentage'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('pph_percentage') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter the PPH percentage (e.g. 10
                                                                for 10%)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="due-date" class="form-label">Due Date</label>
                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}"
                                                                    id="due-date" name="due_date"
                                                                    value="{{ $invoice->due_date ?? '' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('due_date'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('due_date') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted">Select the invoice due
                                                                date</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="description" class="form-label">Description
                                                            </label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Enter description" id="description" name="description" rows="4"
                                                                    style="height: 100px">{{ $invoice->description ?? '' }}</textarea>
                                                                <label for="description">Description</label>
                                                            </div>
                                                            <small class="text-muted">Enter details about this
                                                                invoice</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label for="supplier-name" class="form-label">Supplier
                                                                Name <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"
                                                                name="supplier_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled>Pilih Supplier Name
                                                                </option>
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                        {{ $invoice->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                                        {{ $supplier->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('supplier_id'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('supplier_id') }}</p>
                                                            @endif
                                                            <small class="text-muted">Select the supplier for this
                                                                invoice</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="kredit-account" class="form-label">Kredit
                                                                Account <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="kredit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled>Pilih Kredit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $invoice->kredit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('kredit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('kredit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Select the account to be
                                                                    credited</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph" class="form-label">PPH </label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="PPH Amount (calculated)"
                                                                    id="pph" name="pph_amount"
                                                                    value="{{ $invoice->pph_amount ?? '' }}" readonly>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calculator"></i>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">Calculated PPH amount based on
                                                                percentage</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-date" class="form-label">Invoice Date
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}"
                                                                    id="invoice-date" name="invoice_date"
                                                                    value="{{ $invoice->invoice_date ?? '' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar-check"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('invoice_date'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('invoice_date') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted">Enter the invoice issue
                                                                date</small>
                                                        </div>

                                                        <div class="card mb-4">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">Dokumen Invoice</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                @if ($invoice->image_invoice)
                                                                    <div class="mb-4">
                                                                        <label class="form-label fw-semibold">Dokumen
                                                                            Saat Ini</label>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <a href="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                                target="_blank">
                                                                                <img src="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                                    alt="Invoice Document"
                                                                                    class="rounded shadow-sm"
                                                                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                            </a>
                                                                            <div>
                                                                                <p class="mb-1 fw-bold">
                                                                                    {{ basename($invoice->image_invoice) }}
                                                                                </p>
                                                                                <small class="text-muted">Dokumen
                                                                                    invoice yang telah diunggah</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <div class="mb-3">
                                                                    <label for="image_invoice"
                                                                        class="form-label fw-semibold">Unggah Dokumen
                                                                        Baru (Opsional)</label>
                                                                    <div class="border rounded p-4 text-center position-relative {{ $errors->has('image_invoice') ? 'border-danger' : 'border-secondary-subtle' }}"
                                                                        style="background-color: #f9f9f9;">
                                                                        <input type="file" name="image_invoice"
                                                                            id="file-input-invoice"
                                                                            class="form-control d-none file-upload-input"
                                                                            onchange="previewFile(this, 'invoice');"
                                                                            accept="image/*">
                                                                        <label for="file-input-invoice"
                                                                            class="cursor-pointer">
                                                                            <i class="bi bi-cloud-arrow-up"
                                                                                style="font-size: 2.5rem; color: #6c757d;"></i>
                                                                            <p class="mt-2 mb-1 fw-medium">Klik untuk
                                                                                memilih file</p>
                                                                            <small class="text-muted d-block">Format
                                                                                diterima: JPG, PNG, PDF &mdash; Maks.
                                                                                5MB</small>
                                                                        </label>
                                                                    </div>
                                                                    @if ($errors->has('image_invoice'))
                                                                        <div class="text-danger mt-2 small">
                                                                            {{ $errors->first('image_invoice') }}</div>
                                                                    @endif
                                                                </div>

                                                                <div class="file-upload-content mt-3 d-none"
                                                                    id="file-upload-content-invoice">
                                                                    <label class="form-label fw-semibold">Preview
                                                                        Dokumen Baru</label>
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <a href="#"
                                                                            id="file-preview-link-invoice"
                                                                            target="_blank">
                                                                            <img class="file-upload-image rounded shadow-sm d-none"
                                                                                id="file-upload-image-invoice"
                                                                                src="#" alt="Preview"
                                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                            <i id="file-upload-icon-invoice"
                                                                                class="bi bi-file-earmark-pdf d-none"
                                                                                style="font-size: 2.5rem;"></i>
                                                                        </a>
                                                                        <div class="flex-grow-1">
                                                                            <div class="fw-bold"
                                                                                id="image-file-name-invoice">Nama File
                                                                            </div>
                                                                            <small class="text-muted">Dokumen yang akan
                                                                                diunggah</small>
                                                                        </div>
                                                                        <button type="button"
                                                                            onclick="removeUpload('invoice')"
                                                                            class="btn btn-sm btn-outline-danger">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <a href="{{ route('index-invoice') }}" type="button"
                                                            class="btn btn-sm btn-light-secondary me-2">
                                                            <i class="bi bi-arrow-left-circle me-1"></i>
                                                            Kembali
                                                        </a>
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Update Invoice
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


                {{-- bagian payment --}}
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

                                    <form action="{{ route('update-invoice') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <input type="hidden" name="is_payment_update" value="1">


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
                                                                    value="{{ \Carbon\Carbon::parse($invoice->payment_date)->format('Y-m-d') }}"
                                                                    required>
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
                                                                    <option value="" disabled
                                                                        {{ old('payment_method', $invoice->payment_method) ? '' : 'selected' }}>
                                                                        Pilih Metode Pembayaran
                                                                    </option>
                                                                    <option value="Cash"
                                                                        {{ old('payment_method', $invoice->payment_method) == 'Cash' ? 'selected' : '' }}>
                                                                        Tunai
                                                                    </option>
                                                                    <option value="Bank"
                                                                        {{ old('payment_method', $invoice->payment_method) == 'Bank' ? 'selected' : '' }}>
                                                                        Transfer Bank
                                                                    </option>
                                                                    <option value="Debit"
                                                                        {{ old('payment_method', $invoice->payment_method) == 'Debit' ? 'selected' : '' }}>
                                                                        Kartu Debit
                                                                    </option>
                                                                    <option value="Credit"
                                                                        {{ old('payment_method', $invoice->payment_method) == 'Credit' ? 'selected' : '' }}>
                                                                        Kartu Kredit
                                                                    </option>
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
                                                                    value="{{ $payment->reference_number }}">
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
                                                                    value="{{ $payment->amount }}" required>
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
                                                                <option value="" disabled>Pilih Debit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $invoice->debit_coa_id == $coa->id ? 'selected' : '' }}>
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
                                                                <option value="" disabled>Pilih Kredit Account
                                                                </option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ $invoice->kredit_coa_id == $coa->id ? 'selected' : '' }}>
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
                                                                    placeholder="Informasi tambahan tentang pembayaran" style="height: 100px">{{ old('notes', $payment->notes) }}</textarea>

                                                                <label for="payment_notes">Catatan Tambahan</label>
                                                            </div>
                                                            <small class="text-muted">Informasi tambahan tentang
                                                                pembayaran ini</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bukti Pembayaran -->
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Unggah Bukti Pembayaran</h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($invoice->image_proof)
                                                    <div class="mb-4">
                                                        <label class="form-label fw-semibold">Bukti Pembayaran Saat
                                                            Ini</label>
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
                                                                    target="_blank" class="btn btn-info">Lihat Dokumen
                                                                    PDF</a>
                                                            @endif
                                                            <div>
                                                                <p class="mb-1 fw-bold">
                                                                    {{ basename($invoice->image_proof) }}</p>
                                                                <small class="text-muted">Bukti pembayaran yang telah
                                                                    diunggah</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label for="image_proof" class="form-label fw-semibold">Unggah
                                                        Bukti Pembayaran Baru</label>
                                                    <div class="border rounded p-4 text-center position-relative {{ $errors->has('image_proof') ? 'border-danger' : 'border-secondary-subtle' }}"
                                                        style="background-color: #f9f9f9;">
                                                        <input type="file" name="image_proof"
                                                            id="file-input-proof"
                                                            class="form-control d-none file-upload-input"
                                                            onchange="previewFile(this, 'proof');"
                                                            accept="image/*,application/pdf">
                                                        <label for="file-input-proof" class="cursor-pointer">
                                                            <i class="bi bi-cloud-arrow-up"
                                                                style="font-size: 2.5rem; color: #6c757d;"></i>
                                                            <p class="mt-2 mb-1 fw-medium">Klik untuk memilih file</p>
                                                            <small class="text-muted d-block">Format diterima: JPG,
                                                                PNG, PDF &mdash; Maks. 5MB</small>
                                                        </label>
                                                    </div>
                                                    @if ($errors->has('image_proof'))
                                                        <div class="text-danger mt-2 small">
                                                            {{ $errors->first('image_proof') }}</div>
                                                    @endif
                                                </div>

                                                <div class="file-upload-content mt-3 d-none"
                                                    id="file-upload-content-proof">
                                                    <label class="form-label fw-semibold">Preview Bukti Pembayaran
                                                        Baru</label>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <a href="#" id="file-preview-link-proof"
                                                            target="_blank">
                                                            <img class="file-upload-image rounded shadow-sm d-none"
                                                                id="file-upload-image-proof" src="#"
                                                                alt="Preview"
                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                            <i id="file-upload-icon-proof"
                                                                class="bi bi-file-earmark-pdf d-none"
                                                                style="font-size: 2.5rem;"></i>
                                                        </a>
                                                        <div class="flex-grow-1">
                                                            <div class="fw-bold" id="image-file-name-proof">Nama File
                                                            </div>
                                                            <small class="text-muted">Dokumen yang akan
                                                                diunggah</small>
                                                        </div>
                                                        <button type="button" onclick="removeUpload('proof')"
                                                            class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
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

    {{-- select2 --}}
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

    {{-- modal pesan error --}}
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
        function previewFile(input, type) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('file-upload-content-' + type).classList.remove('d-none');
                    document.getElementById('file-upload-image-' + type).src = e.target.result;
                    document.getElementById('file-preview-link-' + type).href = e.target.result;
                    document.getElementById('image-file-name-' + type).innerText = input.files[0].name;
                    if (input.files[0].type === 'application/pdf') {
                        document.getElementById('file-upload-icon-' + type).classList.remove('d-none');
                        document.getElementById('file-upload-image-' + type).classList.add('d-none');
                    } else {
                        document.getElementById('file-upload-icon-' + type).classList.add('d-none');
                        document.getElementById('file-upload-image-' + type).classList.remove('d-none');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeUpload(type) {
            const fileInput = document.querySelector('#file-input-' + type);
            fileInput.value = '';
            document.getElementById('file-upload-content-' + type).classList.add('d-none');
        }
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
