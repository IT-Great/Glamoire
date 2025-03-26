<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COA - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title" style="margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <nav aria-label="breadcrumb" class="breadcrumb-header me-3">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.html">COA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All COA</li>
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
                                    <h4>List COA</h4>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    <a href="/category-article" type="button"
                                        class="btn btn-sm btn-dark d-flex align-items-center"
                                        style="margin-right: 10px;">
                                        <i class="bi bi-box-arrow-in-right" style="margin-right: 3px;"></i>Category
                                    </a>

                                    <a href="/create-article-admin" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="fa fa-plus" style="margin-right: 3px;"></i>Add COA
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Account No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>Graiden</td>
                                        <td>Graiden</td>
                                        <td>Graiden</td>
                                        <td>
                                            <span class="badge bg-light-success">Success</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-chartofaccount') }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil" style="margin-right: 3px"></i>Edit </a>
                                            <button class="btn btn-sm btn-danger delete-category" data-id=""> <i
                                                    class="bi bi-trash" style="margin-right: 3px"></i>Delete</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
