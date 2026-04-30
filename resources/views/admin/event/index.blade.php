@extends('admin.layouts.sidebar')
@extends('admin.layouts.navbar')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Event</h3>
                <p class="text-subtitle text-muted">Kelola dokumentasi acara dan event Glamoire.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Alert Success/Error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Daftar Event</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    <i class="bi bi-plus-circle"></i> Tambah Event
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Event</th>
                                <th>Tanggal</th>
                                <th>Season</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $event->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                    <td>{{ $event->season ?? '-' }}</td>
                                    <td>
                                        @if($event->status == 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($event->images) && count($event->images) > 0)
                                            <img src="{{ Storage::url($event->images[0]) }}" alt="Event" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                            @if(count($event->images) > 1)
                                                <span class="badge bg-dark">+{{ count($event->images) - 1 }}</span>
                                            @endif
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEventModal-{{ $event->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- EDIT MODAL -->
                                <div class="modal fade text-left" id="editEventModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Event: {{ $event->title }}</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label>Judul Event <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="event_date" value="{{ $event->event_date }}" required>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Season / Tema (Opsional)</label>
                                                            <input type="text" class="form-control" name="season" value="{{ $event->season }}" placeholder="Contoh: Summer 2026">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Status <span class="text-danger">*</span></label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Published (Tampil)</option>
                                                            <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Deskripsi Acara</label>
                                                        <textarea name="description" class="form-control" rows="5">{{ $event->description }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Gambar Dokumentasi (Bisa lebih dari 1 file)</label>
                                                        <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar yang sudah ada.</small>

                                                        <!-- Preview Current Images -->
                                                        @if(!empty($event->images))
                                                            <div class="d-flex gap-2 mt-2 flex-wrap">
                                                                @foreach($event->images as $img)
                                                                    <img src="{{ Storage::url($img) }}" alt="Preview" style="height: 60px; border-radius: 5px; border: 1px solid #ddd;">
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- CREATE MODAL -->
<div class="modal fade text-left" id="addEventModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Event Baru</h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Judul Event <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" required placeholder="Contoh: Glamoire Beauty Exhibition">
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="event_date" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Season / Tema (Opsional)</label>
                            <input type="text" class="form-control" name="season" placeholder="Contoh: Summer Collection 2026">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="published">Published (Tampil)</option>
                            <option value="draft">Draft (Sembunyikan)</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Deskripsi Acara</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Ceritakan detail kemeriahan acara..."></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Gambar Dokumentasi <span class="text-danger">*</span> (Bisa lebih dari 1 file)</label>
                        <input type="file" class="form-control" name="images[]" multiple accept="image/*" required>
                        <small class="text-muted">Tahan tombol CTRL (Windows) atau CMD (Mac) untuk memilih banyak gambar sekaligus.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
