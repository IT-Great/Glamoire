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
                            <h2 class="mb-3">Manajemen Invoice</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/invoice">Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Proses Pembayaran</li>
                                </ol>
                            </nav>
                            <p class="text-subtitle text-muted mt-2">Detailed information about invoice and payment
                                history</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('update-supplier') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $suppliers->id }}">

                                            <div class="form-body">
                                                <h3><i class="bi bi-pencil-square"></i> Edit Supplier</h3>
                                                <p class="text-subtitle text-muted">Update the supplier's information
                                                </p>
                                                <div class="row">
                                                    {{-- Kolom Kiri --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="name" class="form-label">Nama <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $suppliers->name) }}"
                                                                    placeholder="Masukkan Nama">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror

                                                            <small class="text-muted">Masukkan nama supplier (contoh:
                                                                Helmi, Beni)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="email" class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                    id="email" name="email"
                                                                    value="{{ old('email', $suppliers->email) }}"
                                                                    placeholder="Masukkan Email">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror

                                                            <small class="text-muted">Masukkan email supplier (contoh:
                                                                beni@example.com)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="city" class="form-label">Kota</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                                    id="city" name="city"
                                                                    value="{{ old('city', $suppliers->city) }}"
                                                                    placeholder="Masukkan Kota">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-building"></i>
                                                                </div>
                                                            </div>
                                                            @error('city')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan kota supplier (contoh:
                                                                Surabaya, Sidoarjo)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="post_code" class="form-label">Kode Pos</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}"
                                                                    id="post_code" name="post_code"
                                                                    value="{{ old('post_code', $suppliers->post_code) }}"
                                                                    placeholder="Masukkan Kode Pos">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-mailbox"></i>
                                                                </div>
                                                            </div>
                                                            @error('post_code')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror

                                                            <small class="text-muted">Masukkan kode pos supplier
                                                                (contoh: 61124)</small>

                                                        </div>
                                                    </div>

                                                    {{-- Kolom Kanan --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="no_telp" class="form-label">No. Telepon <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}"
                                                                    id="no_telp" name="no_telp"
                                                                    value="{{ old('no_telp', $suppliers->no_telp) }}"
                                                                    placeholder="Masukkan No. Telepon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-telephone"></i>
                                                                </div>
                                                            </div>
                                                            @error('no_telp')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan nomor telepon supplier
                                                                (contoh: +62898979****)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="address" class="form-label">Alamat</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                                    id="address" name="address"
                                                                    value="{{ old('address', $suppliers->address) }}"
                                                                    placeholder="Masukkan Alamat">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                </div>
                                                            </div>
                                                            @error('address')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan alamat supplier (contoh:
                                                                Jl. Raya No 112)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="province" class="form-label">Provinsi</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                                                    id="province" name="province"
                                                                    value="{{ old('province', $suppliers->province) }}"
                                                                    placeholder="Masukkan Provinsi">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                </div>
                                                            </div>
                                                            @error('province')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan provinsi supplier
                                                                (contoh: Jawa Timur, Jawa Tengah)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="description"
                                                                class="form-label">Deskripsi</label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" id="description" name="description" placeholder="Masukkan deskripsi" rows="4"
                                                                    style="height: 100px">{{ old('description', $suppliers->description) }}</textarea>
                                                                <label for="description">Deskripsi</label>
                                                            </div>

                                                            <small class="text-muted">Masukkan keterangan tambahan
                                                                mengenai supplier ini</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <a href="{{ route('index-supplier') }}" type="button"
                                                            class="btn btn-sm btn-light-secondary me-2">
                                                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                                                        </a>

                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-check-circle me-1"></i> Update Supplier
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

    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- modal detail invoice --}}
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

    {{-- upload gambar --}}
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
