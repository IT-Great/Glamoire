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
</style>

<div id="main" class='layout-navbar'>
    <header class='mb-2'>
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
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-bell-fill me-1"></i> </a>
                        </li> --}}
                    </ul>
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
