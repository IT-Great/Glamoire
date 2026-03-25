{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Review - Glamoire Admin</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
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
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rating & Review</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Ulasan Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th style="min-width: 250px;">Produk / Order</th>
                                        <th style="min-width: 100px;">Rating</th>
                                        <th style="min-width: 250px;">Ulasan</th>
                                        <th>Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $review->user->fullname ?? 'Unknown' }}</div>
                                                <div class="small text-muted">{{ $review->user->email ?? '' }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-primary">{{ Str::limit($review->product->product_name ?? 'Produk Dihapus', 40) }}</div>
                                                <div class="small text-muted mt-1">
                                                    Inv: <a href="/order-detail/{{ $review->order_id }}" class="text-decoration-underline text-danger">{{ $review->order->invoice->no_invoice ?? '-' }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="fas fa-star text-warning me-1"></i> @else
                                                            <i class="far fa-star text-muted me-1"></i> @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size: 0.85rem; line-height: 1.4;">
                                                    {{ $review->description }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    @if ($review->images)
                                                        @foreach(json_decode($review->images, true) as $img)
                                                            <img src="{{ Storage::url($img) }}" alt="lampiran" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 1px solid #e5e7eb;" onclick="openMediaModal('{{ Storage::url($img) }}', 'image')">
                                                        @endforeach
                                                    @endif

                                                    @if ($review->video)
                                                        <div class="position-relative" style="width: 40px; height: 40px; cursor: pointer;" onclick="openMediaModal('{{ Storage::url($review->video) }}', 'video')">
                                                            <video src="{{ Storage::url($review->video) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;"></video>
                                                            <i class="fas fa-play position-absolute top-50 start-50 translate-middle text-white" style="font-size: 0.8rem; text-shadow: 0px 0px 2px rgba(0,0,0,0.8);"></i>
                                                        </div>
                                                    @endif

                                                    @if(empty($review->images) && empty($review->video))
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3 bg-white p-2" data-bs-dismiss="modal" style="border-radius: 50%; opacity: 1;"></button>
                    <div id="mediaContent" class="shadow-lg rounded-3 overflow-hidden bg-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table1 = document.querySelector('#table1');
            new simpleDatatables.DataTable(table1);
        });

        // Hentikan video saat modal ditutup agar audio tidak terus berjalan di background
        $('#mediaModal').on('hidden.bs.modal', function () {
            document.getElementById('mediaContent').innerHTML = '';
        });

        function openMediaModal(url, type) {
            let contentDiv = document.getElementById('mediaContent');
            if (type === 'image') {
                contentDiv.innerHTML = `<img src="${url}" class="w-100 h-auto" style="max-height: 85vh; object-fit: contain;">`;
            } else {
                contentDiv.innerHTML = `<video src="${url}" class="w-100 h-auto" style="max-height: 85vh;" controls autoplay controlsList="nodownload"></video>`;
            }
            new bootstrap.Modal(document.getElementById('mediaModal')).show();
        }
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Review - Glamoire Admin</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
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
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rating & Review</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Ulasan Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th style="min-width: 250px;">Produk / Order</th>
                                        <th style="min-width: 100px;">Rating</th>
                                        <th style="min-width: 250px;">Ulasan</th>
                                        <th>Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $review->user->fullname ?? 'Unknown' }}</div>
                                                <div class="small text-muted">{{ $review->user->email ?? '' }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-primary">{{ Str::limit($review->product->product_name ?? 'Produk Dihapus', 40) }}</div>
                                                <div class="small text-muted mt-1">
                                                    Inv: <a href="/order-detail/{{ $review->order_id }}" class="text-decoration-underline text-danger">{{ $review->order->invoice->no_invoice ?? '-' }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center" style="font-size: 1rem;">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="bi bi-star-fill text-warning me-1"></i> @else
                                                            <i class="bi bi-star text-muted me-1"></i> @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size: 0.85rem; line-height: 1.4;">
                                                    {{ $review->description }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    @if ($review->images)
                                                        @foreach(json_decode($review->images, true) as $img)
                                                            <img src="{{ Storage::url($img) }}" alt="lampiran" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 1px solid #e5e7eb;" onclick="openMediaModal('{{ Storage::url($img) }}', 'image')">
                                                        @endforeach
                                                    @endif

                                                    @if ($review->video)
                                                        <div class="position-relative" style="width: 40px; height: 40px; cursor: pointer;" onclick="openMediaModal('{{ Storage::url($review->video) }}', 'video')">
                                                            <video src="{{ Storage::url($review->video) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;"></video>
                                                            <i class="bi bi-play-fill position-absolute top-50 start-50 translate-middle text-white" style="font-size: 1.5rem; text-shadow: 0px 0px 4px rgba(0,0,0,0.8);"></i>
                                                        </div>
                                                    @endif

                                                    @if(empty($review->images) && empty($review->video))
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3 bg-white p-2" data-bs-dismiss="modal" style="border-radius: 50%; opacity: 1;"></button>
                    <div id="mediaContent" class="shadow-lg rounded-3 overflow-hidden bg-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table1 = document.querySelector('#table1');
            new simpleDatatables.DataTable(table1);
        });

        // Hentikan video saat modal ditutup agar audio tidak terus berjalan di background
        $('#mediaModal').on('hidden.bs.modal', function () {
            document.getElementById('mediaContent').innerHTML = '';
        });

        function openMediaModal(url, type) {
            let contentDiv = document.getElementById('mediaContent');
            if (type === 'image') {
                contentDiv.innerHTML = `<img src="${url}" class="w-100 h-auto" style="max-height: 85vh; object-fit: contain;">`;
            } else {
                contentDiv.innerHTML = `<video src="${url}" class="w-100 h-auto" style="max-height: 85vh;" controls autoplay controlsList="nodownload"></video>`;
            }
            new bootstrap.Modal(document.getElementById('mediaModal')).show();
        }
    </script>
</body>
</html>
