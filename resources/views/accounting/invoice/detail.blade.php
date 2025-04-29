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
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">

                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Invoice Detail</h3>
                        <p class="text-subtitle text-muted">Detailed information about invoice and payment history</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('index-invoice') }}">Invoices</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <!-- Invoice Header Card -->
                        <div class="card">
                            <div class="card-content">
                                <div class="invoice-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 class="mb-3">Invoice #{{ $invoice->no_invoice }}</h4>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="me-2">Status:</span>
                                                @if ($invoice->payment_status == 'Paid')
                                                    <span class="badge status-badge status-paid">Paid</span>
                                                @else
                                                    <span class="badge status-badge status-not-yet">Not Paid</span>
                                                @endif
                                            </div>
                                            <p class="mb-0">Supplier: <strong>{{ $invoice->supplier->name }}</strong>
                                            </p>
                                        </div>
                                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                            <div class="amount-box">
                                                <p class="mb-1">Total Amount</p>
                                                <p class="amount-value">Rp
                                                    {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                                            </div>

                                            @if ($invoice->payment_status == 'Not Yet')
                                                <button class="btn btn-primary pay-invoice"
                                                    data-id="{{ $invoice->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#paymentModal"
                                                    data-invoice="{{ $invoice->no_invoice }}"
                                                    data-amount="{{ $invoice->amount }}"
                                                    data-supplier="{{ $invoice->supplier->name }}">
                                                    <i class="bi bi-credit-card"></i> Process Payment
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Invoice Details Card -->
                            <div class="col-12 col-lg-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Invoice Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Invoice Number</p>
                                                    <p class="detail-value">{{ $invoice->no_invoice }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Invoice Date</p>
                                                    <p class="detail-value">
                                                        {{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Payment Status</p>
                                                    <p class="detail-value">
                                                        @if ($invoice->payment_status == 'Paid')
                                                            <span class="badge bg-success">Paid</span>
                                                        @else
                                                            <span class="badge bg-danger">Not Paid</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Payment Method</p>
                                                    <p class="detail-value">{{ $invoice->payment_method ?? 'Not Set' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Deadline</p>
                                                    <p class="detail-value">
                                                        @php
                                                            $deadline = \Carbon\Carbon::parse(
                                                                $invoice->deadline_invoice,
                                                            );
                                                            $now = \Carbon\Carbon::now();
                                                            $diff = $now->diffInDays($deadline, false);
                                                        @endphp

                                                        {{ $deadline->format('M d, Y') }}

                                                        @if ($invoice->payment_status == 'Not Yet')
                                                            @if ($diff < 0)
                                                                <span class="deadline-danger">({{ abs($diff) }}
                                                                    days overdue)</span>
                                                            @elseif($diff <= 7)
                                                                <span class="deadline-warning">({{ $diff }}
                                                                    days left)</span>
                                                            @else
                                                                <span class="deadline-safe">({{ $diff }} days
                                                                    left)</span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Amount</p>
                                                    <p class="detail-value">Rp
                                                        {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($invoice->pph)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="detail-section">
                                                        <p class="detail-label mb-1">PPh</p>
                                                        <p class="detail-value">Rp
                                                            {{ number_format($invoice->pph, 0, ',', '.') }}
                                                            ({{ $invoice->pph_percentage }}%)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="detail-section">
                                                    <p class="detail-label mb-1">Description</p>
                                                    <p class="detail-value">
                                                        {{ $invoice->description ?? 'No description available' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($invoice->nota)
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="detail-section">
                                                        <p class="detail-label mb-1">Nota</p>
                                                        <p class="detail-value">{{ $invoice->nota }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                @if ($invoice->image_invoice)
                                                    <div class="detail-section">
                                                        <p class="detail-label mb-2">Invoice Image</p>
                                                        <a href="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                alt="Invoice Image" class="proof-image">
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if ($invoice->image_proof)
                                                    <div class="detail-section">
                                                        <p class="detail-label mb-2">Payment Proof</p>
                                                        <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                alt="Payment Proof" class="proof-image">
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($invoice->kredit_coa_id || $invoice->debit_coa_id)
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h6 class="text-muted">Accounting Information</h6>
                                                    <hr>
                                                </div>
                                                @if ($invoice->kredit_coa_id)
                                                    <div class="col-md-6">
                                                        <div class="detail-section">
                                                            <p class="detail-label mb-1">Credit Account</p>
                                                            <p class="detail-value">{{ $invoice->kreditCoa->name }}
                                                                ({{ $invoice->kreditCoa->coa_no }})</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($invoice->debit_coa_id)
                                                    <div class="col-md-6">
                                                        <div class="detail-section">
                                                            <p class="detail-label mb-1">Debit Account</p>
                                                            <p class="detail-value">{{ $invoice->debitCoa->name }}
                                                                ({{ $invoice->debitCoa->coa_no }})</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Payment History Card -->
                            <div class="col-12 col-lg-5">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Payment History</h5>
                                        <span class="badge bg-info">{{ count($invoice->payments) }} Payments</span>
                                    </div>
                                    <div class="card-body">
                                        @if (count($paymentHistories) > 0)
                                            <div class="timeline">
                                                @foreach ($paymentHistories as $payment)
                                                    <div class="timeline-item">
                                                        <div class="payment-history-item">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span
                                                                    class="payment-date">{{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}</span>
                                                                @if ($payment->payment_method == 'Cash')
                                                                    <span
                                                                        class="badge payment-method-badge payment-method-cash">Cash</span>
                                                                @else
                                                                    <span
                                                                        class="badge payment-method-badge payment-method-bank">Bank
                                                                        Transfer</span>
                                                                @endif
                                                            </div>
                                                            <p class="payment-amount mb-2">Rp
                                                                {{ number_format($payment->amount, 0, ',', '.') }}</p>

                                                            @if ($payment->reference_number)
                                                                <p class="mb-1"><small class="text-muted">Ref:
                                                                        {{ $payment->reference_number }}</small></p>
                                                            @endif

                                                            @if ($payment->notes)
                                                                <p class="mb-1"><small>{{ $payment->notes }}</small>
                                                                </p>
                                                            @endif

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-2">
                                                                {{-- <small class="text-muted">Processed by:
                                                                    {{ $payment->processedBy->name }}</small> --}}

                                                                @if (isset($payment->image_proof))
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#proofModal{{ $payment->id }}">
                                                                        <i class="bi bi-image"></i> View Proof
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-5">
                                                <img src="{{ asset('assets/images/illustrations/no-data.svg') }}"
                                                    alt="No Payment History" style="max-width: 150px;"
                                                    class="mb-3">
                                                <h6>No Payment History Found</h6>
                                                <p class="text-muted">This invoice has not been paid yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Additional Actions Card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="invoice-actions">
                                            <a href="{{ route('edit-invoice', ['id' => $invoice->id]) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil"></i> Edit Invoice
                                            </a>
                                            <a href="#" class="btn btn-primary" onclick="window.print()">
                                                <i class="bi bi-printer"></i> Print
                                            </a>
                                            <a href="{{ route('index-invoice') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-left"></i> Back to List
                                            </a>
                                        </div>
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize payment modal
            $('.pay-invoice').click(function() {
                var id = $(this).data('id');
                var invoice = $(this).data('invoice');
                var amount = $(this).data('amount');
                var supplier = $(this).data('supplier');

                $('#invoice_id').val(id);
                $('#modal_invoice_number').text(invoice);
                $('#modal_supplier_name').text(supplier);
                $('#modal_invoice_amount').text('Rp ' + new Intl.NumberFormat('id-ID').format(amount));
                $('#payment_amount').val(amount);
            });

            // Image preview for payment proof upload
            $('#payment_proof').change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#proofPreview').attr('src', event.target.result);
                        $('#proofPreview').css('display', 'block');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Update deadline color based on days remaining
            function updateDeadlineColor() {
                $('.deadline-info').each(function() {
                    const daysLeft = parseInt($(this).data('days'));
                    if (daysLeft < 0) {
                        $(this).addClass('deadline-danger');
                    } else if (daysLeft <= 7) {
                        $(this).addClass('deadline-warning');
                    } else {
                        $(this).addClass('deadline-safe');
                    }
                });
            }

            updateDeadlineColor();
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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
