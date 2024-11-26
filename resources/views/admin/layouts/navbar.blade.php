{{-- <div id="main" class='layout-navbar'>
    <header class='mb-2'>
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false"
                            style="text-decoration: none;">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600  text-capitalize">{{ Auth::user()->role }}</h6>
                                    <!-- Displaying the user's role -->
                                    <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->name }}</p>
                                    <!-- Displaying the user's name -->
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, John!</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                    Settings</a></li>                        
                                <hr class="dropdown-divider">
                            </li>                            

                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .layout-navbar {
        background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar {
        padding: 0.75rem 1.5rem;
    }

    .navbar-light .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8);
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #ffffff;
    }

    .burger-btn {
        color: #ffffff;
        font-size: 1.5rem;
    }

    .user-menu {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .user-menu:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .user-name h6,
    .user-name p {
        color: #ffffff;
        margin: 0;
    }

    .avatar img {
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item:hover {
        background-color: #F3F4F6;
    }

    /* Badge Notification */
    .badge-notification {
        position: absolute;
        top: -8px;
        right: -10px;
        padding: 5px 7px;
        border-radius: 10px;
        background-color: #ff0720;
        /* Red color */
        color: white;
        font-size: 0.75rem;
        font-weight: bold;
        min-width: 20px;
        min-height: 20px;
        text-align: center;
        line-height: 1rem;
        box-shadow: 0 0 8px rgba(15, 15, 15, 0.5);
        transform-origin: center;
        z-index: 10;
    }

    .nav-item.dropdown.position-relative {
        margin-right: 15px;
    }
</style>

<div id="main" class="layout-navbar">
    <header class="mb-2">
        <nav class="navbar navbar-expand navbar-light">
            <div class="container-fluid">
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
                        <!-- Bell Icon with Dropdown -->
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="true" aria-expanded="false">

                                <i class="bi bi-bell-fill me-1"></i>
                                <span id="stock-alert-badge" class="badge-notification d-none">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">Stock Alerts</h6>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <span id="low-stock-alert" class="text-warning">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            1 Product Low Stock
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index-stock-product-admin') }}">
                                        View Stock
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Envelope Icon with Dropdown -->
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="true" aria-expanded="false">
                                <i class="bi bi-envelope-fill me-1"></i>
                                <span id="contact-us-notif" class="badge-notification d-none">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">Contact Us Messages</h6>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <span id="low-stock-alert" class="text-warning">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            1 Messages
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index-contactus-admin') }}">
                                        View Messages
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- User Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false"
                            style="text-decoration: none;">
                            <div class="d-flex align-items-center">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-capitalize">{{ Auth::user()->role }}</h6>
                                    <p class="mb-0 text-sm">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                    Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- info contact us --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchUnreadQuestionsCount() {
            fetch("{{ route('unread-questions-count') }}")
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('contact-us-notif');
                    if (data.unreadQuestions > 0) {
                        badge.textContent = data.unreadQuestions;
                        badge.classList.remove('d-none');
                    } else {
                        badge.textContent = '';
                        badge.classList.add('d-none');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Jalankan saat halaman dimuat
        fetchUnreadQuestionsCount();

        // Periksa setiap 10 detik
        setInterval(fetchUnreadQuestionsCount, 10000);
    });
</script>


{{-- info stock --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchStockAlerts() {
            fetch("{{ route('check-stock-alerts') }}")
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('stock-alert-badge');
                    const lowStockAlert = document.getElementById('low-stock-alert');
                    const outOfStockAlert = document.getElementById(
                    'out-of-stock-alert'); // Tambahkan elemen untuk out of stock


                    // Update badge (kombinasi low stock + out of stock)
                    const totalAlerts = data.lowStockCount + data.outOfStockCount;
                    if (totalAlerts > 0) {
                        badge.textContent = totalAlerts;
                        badge.classList.remove('d-none');
                    } else {
                        badge.textContent = '';
                        badge.classList.add('d-none');
                    }

                    // Update low stock alert
                    if (data.lowStockCount > 0) {
                        lowStockAlert.innerHTML = `
                            <i class="bi bi-exclamation-circle-fill"></i>
                            ${data.lowStockCount} Product${data.lowStockCount > 1 ? 's' : ''} Low Stock
                        `;
                    } else {
                        lowStockAlert.innerHTML = `
                            <i class="bi bi-exclamation-circle-fill"></i>
                            No Low Stock Products
                        `;
                    }

                    // Update out of stock alert
                    if (data.outOfStockCount > 0) {
                        outOfStockAlert.innerHTML = `
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            ${data.outOfStockCount} Product${data.outOfStockCount > 1 ? 's' : ''} Out of Stock
                        `;
                    } else {
                        outOfStockAlert.innerHTML = `
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            No Out of Stock Products
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching stock alerts:', error);
                });
        }

        // Check initially
        fetchStockAlerts();

        // Check every 30 seconds
        setInterval(fetchStockAlerts, 30000);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Bootstrap Dropdown
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });

        // Menghindari konflik jQuery
        $(document).on('click', '.dropdown-toggle', function() {
            $(this).dropdown('toggle');
        });
    });
</script>
