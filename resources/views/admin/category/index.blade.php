<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                    <li class="breadcrumb-item"><a href="/category-product">Category</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h4>List Categories</h4>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    <a href="#" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal"
                                        data-bs-target="#categoryModal">
                                        <i class="fa fa-plus" style="margin-right: 3px;"></i> Add Category
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Total Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->products->count() }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary add-subcategory"
                                                    data-id="{{ $category->id }}" data-type="subcategory">Add
                                                    Subcategory</button>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $category->id }}">Delete</button>
                                            </td>
                                        </tr>

                                        <!-- Tampilkan subcategory jika ada -->
                                        @foreach ($category->children as $subcategory)
                                            <tr>
                                                <td>— {{ $subcategory->name }} (Subcategory of {{ $category->name }})
                                                </td>
                                                <td>{{ $subcategory->products->count() }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger delete-category"
                                                        data-id="{{ $subcategory->id }}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <div class="modal fade text-left" id="categoryModal" tabindex="-1" role="dialog"
                aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="categoryModalLabel">Form Add Category/Subcategory</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="categoryForm">
                            @csrf
                            <input type="hidden" name="parent_id" id="parentId">
                            <input type="hidden" name="type" id="categoryType" value="category">
                            <div class="modal-body">
                                <label>Category Name <span style="color: red">*</span> </label>
                                <div class="form-group mt-2">
                                    <input type="text" placeholder="Enter Category Name" class="form-control mb-2"
                                        name="name" id="categoryName">
                                    <small class="text-muted" style="font-size: 14px;">
                                        Please enter a unique and descriptive Category/Subcategory name to help organize your
                                        products efficiently.
                                    </small>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary ml-1">
                                    <span class="d-none d-sm-block">Submit</span>
                                </button>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
