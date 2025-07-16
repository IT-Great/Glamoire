<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .layout-navbar {
        background: #183018;
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

    .badge-notification {
        position: absolute;
        top: -6px;
        right: -8px;
        background: linear-gradient(135deg, #ff3a6b 0%, #ff6b6b 100%);
        color: white;
        border-radius: 50%;
        padding: 0.15rem 0.45rem;
        font-size: 0.7rem;
        line-height: 1;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        animation: pulse 1.5s infinite;
    }

    .nav-item.dropdown.position-relative {
        margin-right: 15px;
    }

    .nav-notifications .nav-link {
        position: relative;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .nav-notifications .nav-link:hover {
        color: #ffffff;
        transform: scale(1.1);
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .dropdown-notifications .dropdown-menu {
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        max-height: 350px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .dropdown-notifications .dropdown-header {
        /* background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); */
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-secondary) 100%);

        color: white;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
    }

    .notification-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.3s ease;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-icon {
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-icon.warning {
        color: #ffc107;
    }

    .notification-icon.info {
        color: #17a2b8;
    }

    .notification-content {
        flex-grow: 1;
    }

    .notification-content small {
        color: #6c757d;
    }

    .view-all-btn {
        width: 100%;
        text-align: center;
        padding: 0.5rem;
        background-color: #f8f9fa;
        color: #6c757d;
        border: none;
        transition: background-color 0.3s ease;
    }

    .view-all-btn:hover {
        background-color: #e9ecef;
    }

    .clickable-notification {
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.1s ease;
    }

    .clickable-notification:hover {
        background-color: #f0f0f0;
        transform: scale(1.02);
    }

    .clickable-notification:active {
        transform: scale(0.98);
        background-color: #e0e0e0;
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
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4 nav-notifications">
                        <!-- Stock Notifications -->
                        {{-- <li class="nav-item dropdown position-relative dropdown-notifications">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-box-seam"></i>
                                <span id="stock-alert-badge" class="badge-notification d-none">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-header">
                                    <span>Inventory Alerts</span>
                                    <small id="stock-update-time"></small>
                                </li>
                                <li id="low-stock-notification" class="notification-item clickable-notification"
                                    onclick="window.location.href='{{ route('index-stock-product-admin') }}'">
                                    <div class="notification-icon warning">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                    </div>
                                    <div class="notification-content">
                                        <strong>Low Stock Alert</strong>
                                        <br>
                                        <small id="low-stock-alert">No low stock items</small>
                                    </div>
                                </li>
                                <li id="out-of-stock-notification" class="notification-item clickable-notification"
                                    onclick="window.location.href='{{ route('index-stock-product-admin') }}'">
                                    <div class="notification-icon warning">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </div>
                                    <div class="notification-content">
                                        <strong>Out of Stock Alert</strong>
                                        <br>
                                        <small id="out-of-stock-alert">No out of stock items</small>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Contact Us Notifications -->
                        {{-- <li class="nav-item dropdown position-relative dropdown-notifications">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-envelope"></i>
                                <span id="contact-us-notif" class="badge-notification d-none">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-header">
                                    <span>Contact Messages</span>
                                    <small id="message-update-time"></small>
                                </li>
                                <li id="contact-notification" class="notification-item clickable-notification"
                                    onclick="window.location.href='{{ route('index-contactus-admin') }}'">
                                    <div class="notification-icon info">
                                        <i class="bi bi-chat-left-text-fill"></i>
                                    </div>
                                    <div class="notification-content">
                                        <strong>Unread Messages</strong>
                                        <br>
                                        <small id="unread-messages-count">No new messages</small>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateStockAlerts() {
            fetch("{{ route('check-stock-alerts') }}")
                .then(response => response.json())
                .then(data => {
                    const stockBadge = document.getElementById('stock-alert-badge');
                    const lowStockAlert = document.getElementById('low-stock-alert');
                    const outOfStockAlert = document.getElementById('out-of-stock-alert');
                    const stockUpdateTime = document.getElementById('stock-update-time');

                    // Total alerts
                    const totalAlerts = data.lowStockCount + data.outOfStockCount;
                    stockBadge.textContent = totalAlerts;
                    stockBadge.classList.toggle('d-none', totalAlerts === 0);

                    // Low Stock Alert
                    lowStockAlert.textContent = data.lowStockCount > 0 ?
                        `${data.lowStockCount} Product${data.lowStockCount > 1 ? 's' : ''} Low Stock` :
                        'No low stock items';

                    // Out of Stock Alert
                    outOfStockAlert.textContent = data.outOfStockCount > 0 ?
                        `${data.outOfStockCount} Product${data.outOfStockCount > 1 ? 's' : ''} Out of Stock` :
                        'No out of stock items';

                    // Update time
                    stockUpdateTime.textContent = new Date().toLocaleTimeString();
                })
                .catch(error => console.error('Stock Alerts Error:', error));
        }

        function updateContactUsNotifications() {
            fetch("{{ route('unread-questions-count') }}")
                .then(response => response.json())
                .then(data => {
                    const contactBadge = document.getElementById('contact-us-notif');
                    const unreadMessagesCount = document.getElementById('unread-messages-count');
                    const messageUpdateTime = document.getElementById('message-update-time');

                    // Unread messages
                    contactBadge.textContent = data.unreadQuestions;
                    contactBadge.classList.toggle('d-none', data.unreadQuestions === 0);

                    unreadMessagesCount.textContent = data.unreadQuestions > 0 ?
                        `${data.unreadQuestions} Unread Message${data.unreadQuestions > 1 ? 's' : ''}` :
                        'No new messages';

                    // Update time
                    messageUpdateTime.textContent = new Date().toLocaleTimeString();
                })
                .catch(error => console.error('Contact Us Notifications Error:', error));
        }

        // Initial checks
        updateStockAlerts();
        updateContactUsNotifications();

        // Periodic updates
        setInterval(updateStockAlerts, 30000);
        setInterval(updateContactUsNotifications, 30000);
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
