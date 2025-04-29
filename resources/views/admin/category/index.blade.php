<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Category Product - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .category-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .action-buttons .btn {
            transition: all 0.2s ease;
            margin: 0 3px;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
        }

        .category-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .subcategory-name {
            font-size: 1rem;
            color: #666;
            padding-left: 1.5rem;
        }

        .category-meta {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h2>Category Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Categories</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats">
                    <div class="col-12 col-md-4">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Categories</h6>
                                        <h3 class="mb-0">{{ $categories->count() }}</h3>
                                    </div>
                                    <div class="stats-icon purple">
                                        <i class="bi bi-folder fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Subcategories</h6>
                                        <h3 class="mb-0">
                                            {{ $categories->sum(function ($category) {return $category->children->count();}) }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-diagram-3 fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Products</h6>
                                        <h3 class="mb-0">
                                            {{ $categories->sum(function ($category) {return $category->products->count();}) }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon blue">
                                        <i class="bi bi-box fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Table Section -->
                <div class="card category-card">
                    <div class="card-header bg-white">

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-0">Category List</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#categoryModal">
                                    <i class="fa fa-plus"></i> Add New Category
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Category Details</th>
                                    <th>Total Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="category-name">{{ $category->name }}</div>
                                            <div class="category-meta">Main Category</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $category->products->count() }}
                                                Products</span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-info add-subcategory"
                                                    data-id="{{ $category->id }}" data-type="subcategory">
                                                    <i class="bi bi-plus-circle"></i> Add Subcategory
                                                </button>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $category->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($category->children as $subcategory)
                                        <tr>
                                            <td>
                                                <div class="subcategory-name">
                                                    <i class="bi bi-arrow-return-right"></i> {{ $subcategory->name }}
                                                </div>
                                                <div class="category-meta ps-4">Subcategory of {{ $category->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $subcategory->products->count() }}
                                                    Products</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-danger delete-category"
                                                        data-id="{{ $subcategory->id }}">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Category Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="categoryModalLabel">Add New Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="categoryForm">
                            @csrf
                            <input type="hidden" name="parent_id" id="parentId">
                            <input type="hidden" name="type" id="categoryType" value="category">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="categoryName">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryName" name="name"
                                        placeholder="Masukan Nama Kategory" required>
                                    <small class="text-muted" style="font-size: 14px;">
                                        Silakan masukkan nama kategori yang unik dan deskriptif.
                                    </small>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Form submission for category and subcategory
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();
                submitCategoryForm($(this), '#categoryModal');
            });

            // Trigger modal for adding subcategory
            $('.add-subcategory').click(function() {
                $('#parentId').val($(this).data('id')); // Set the parent category ID
                $('#categoryType').val('subcategory'); // Define the type as subcategory
                $('#categoryModalLabel').text('Add Subcategory'); // Change modal title
                $('#categoryModal').modal('show');
            });

            function submitCategoryForm(form, modalId) {
                $.ajax({
                    url: "{{ route('create-category-product') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $(modalId).modal('hide');
                            form[0].reset();
                            Swal.fire({
                                title: 'Success!',
                                text: 'Category has been successfully created.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4A69E2',
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'An error occurred while creating the category.', 'error');
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Gunakan event delegation untuk elemen yang dimuat dinamis oleh DataTable
            $(document).on('click', '.add-subcategory', function() {
                $('#parentId').val($(this).data('id'));
                $('#categoryType').val($(this).data('type'));
                $('#categoryModalLabel').text('Add ' + $(this).data('type'));
                $('#categoryModal').modal('show');
            });

            $('#saveCategory').click(function() {
                $.ajax({
                    url: '/create-category-product',
                    method: 'POST',
                    data: $('#categoryForm').serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#categoryModal').modal('hide');
                            location.reload(); // Reload the page to show new category
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        console.log(xhr.responseText);
                    }
                });
            });

            // Add edit and delete functionality here
        });
    </script>

    <script>
        $(document).ready(function() {
            // Handle delete button clicks
            $(document).on('click', '.delete-category', function() {
                const categoryId = $(this).data('id');

                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to delete
                        $.ajax({
                            url: `/delete-category-product/${categoryId}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Category has been successfully deleted.',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#4A69E2',
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire('Error!', response.message ||
                                        'Failed to delete category.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!',
                                    'An error occurred while deleting the category.',
                                    'error');
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
