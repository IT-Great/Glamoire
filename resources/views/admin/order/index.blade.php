<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order || Admin Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
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
                                    <li class="breadcrumb-item"><a href="/brand-admin">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order Data</li>
                                </ol>
                            </nav>
                        </div>                      
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Purchase</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Payment Method</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td>Offenburg</td>
                                        <td>
                                            <span class="badge bg-light-success">Success</span>
                                        </td>
                                        <td>Offenburg</td>
                                        <td><a href="/order-detail"> <span class="badge bg-warning">View</span>
                                            </a></td>
                                    </tr>

                                    <tr>
                                        <td>Emmanuel</td>
                                        <td>eget.lacus.org</td>
                                        <td>(016977) 8208</td>
                                        <td>Saint-Remy</td>
                                        <td>Saint-Rem</td>
                                        <td>
                                            <span class="badge bg-light-primary">Delivered</span>
                                        </td>
                                        <td>Saint-Remy</td>
                                        <td><a href="/order-detail"> <span class="badge bg-warning">View</span>
                                            </a></td>

                                    </tr>

                                    <tr>
                                        <td>Emmanuel</td>
                                        <td>eget.lacus.org</td>
                                        <td>(016977) 8208</td>
                                        <td>Saint-Remy</td>
                                        <td>Saint-Rem</td>
                                        <td>
                                            <span class="badge bg-light-danger">canceled</span>
                                        </td>
                                        <td>Saint-Remy</td>
                                        <td><a href="/order-detail"> <span class="badge bg-warning">View</span>
                                            </a></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
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
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
