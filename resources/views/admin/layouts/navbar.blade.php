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
        /* Glow effect */
        animation: pulse 1.5s infinite;
        /* Add animation */
        transform-origin: center;
        z-index: 10;
    }

    /* Pulse Animation */
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }


    .nav-item.dropdown.position-relative {
        margin-right: 15px;
    }

    #low-stock-alert,
    #out-stock-alert {
        display: none;
        /* Hidden by default */
        width: 100%;
    }

    #low-stock-alert .text-warning,
    #out-stock-alert .text-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dropdown-item:hover #low-stock-alert .text-warning,
    .dropdown-item:hover #out-stock-alert .text-danger {
        opacity: 0.8;
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
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Bell Icon with Dropdown -->
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-bell-fill me-3"></i>
                                <span id="stock-alert-badge" class="badge-notification d-none">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">Stock Alerts</h6>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <span id="low-stock-alert">
                                            <i class="bi bi-exclamation-circle-fill text-warning"></i>
                                            <span class="text-warning"><span class="count">0</span> Products Low
                                                Stock</span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item">
                                        <span id="out-stock-alert">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                            <span class="text-danger"><span class="count">0</span> Products Out of
                                                Stock</span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index-stock-product-admin') }}">
                                        View All Stock
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Envelope Icon with Dropdown -->
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
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



                        <!-- Cart Icon with Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-cart-check-fill me-3"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">Cart</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">View Cart</a></li>
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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        function checkStockAlerts() {
            fetch("{{ route('check-stock-alerts') }}")
                .then(response => response.json())
                .then(data => {
                    // Update badge total
                    const badge = document.getElementById('stock-alert-badge');
                    badge.textContent = data.totalAlerts;
                    badge.classList.toggle('d-none', data.totalAlerts === 0);

                    // Update low stock count with animation
                    const lowStockSpan = document.querySelector('#low-stock-alert span');
                    if (lowStockSpan) {
                        lowStockSpan.textContent = data.lowStockCount;
                        if (data.lowStockCount > 0) {
                            lowStockSpan.closest('.dropdown-item').classList.add('text-warning');
                        } else {
                            lowStockSpan.closest('.dropdown-item').classList.remove('text-warning');
                        }
                    }

                    // Update out of stock count with animation
                    const outStockSpan = document.querySelector('#out-stock-alert span');
                    if (outStockSpan) {
                        outStockSpan.textContent = data.outOfStockCount;
                        if (data.outOfStockCount > 0) {
                            outStockSpan.closest('.dropdown-item').classList.add('text-danger');
                        } else {
                            outStockSpan.closest('.dropdown-item').classList.remove('text-danger');
                        }
                    }

                    // Add visual feedback for updates
                    const dropdown = document.querySelector('.dropdown-menu');
                    if (data.totalAlerts > 0) {
                        dropdown.style.animation = 'none';
                        dropdown.offsetHeight; // Trigger reflow
                        dropdown.style.animation = 'pulse 0.5s ease-in-out';
                    }
                })
                .catch(error => {
                    console.error('Error fetching stock alerts:', error);
                });
        }

        // Check initially
        checkStockAlerts();

        // Check every 30 seconds
        setInterval(checkStockAlerts, 30000);

        // Add CSS animation for updates
        const style = document.createElement('style');
        style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
    `;
        document.head.appendChild(style);
    });
</script> --}}


<script>
    document.addEventListener('DOMContentLoaded', function() {
        function checkStockAlerts() {
            fetch("{{ route('check-stock-alerts') }}")
                .then(response => response.json())
                .then(data => {
                    console.log('Received data:', data); // Debug line

                    // Update badge total
                    const badge = document.getElementById('stock-alert-badge');
                    badge.textContent = data.totalAlerts;
                    badge.classList.toggle('d-none', data.totalAlerts === 0);

                    // Update low stock count
                    const lowStockCount = document.querySelector('#low-stock-alert .count');
                    if (lowStockCount) {
                        lowStockCount.textContent = data.lowStockCount;
                        const lowStockAlert = document.querySelector('#low-stock-alert');
                        lowStockAlert.style.display = data.lowStockCount > 0 ? 'block' : 'none';
                    }

                    // Update out of stock count
                    const outStockCount = document.querySelector('#out-stock-alert .count');
                    if (outStockCount) {
                        outStockCount.textContent = data.outOfStockCount;
                        const outStockAlert = document.querySelector('#out-stock-alert');
                        outStockAlert.style.display = data.outOfStockCount > 0 ? 'block' : 'none';
                    }

                    // Add visual feedback for updates
                    const dropdown = document.querySelector('.dropdown-menu');
                    if (data.totalAlerts > 0) {
                        dropdown.style.animation = 'none';
                        dropdown.offsetHeight; // Trigger reflow
                        dropdown.style.animation = 'pulse 0.5s ease-in-out';
                    }
                })
                .catch(error => {
                    console.error('Error fetching stock alerts:', error);
                });
        }

        // Check initially
        checkStockAlerts();

        // Check every 30 seconds
        setInterval(checkStockAlerts, 30000);
    });
</script>
