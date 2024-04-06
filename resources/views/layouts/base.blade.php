<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/806d1628a2.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: cairo;
            color: white;
        }
    </style>
    <title>Admin Panel</title>
</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#">Brand</a>

                <!-- Icons -->
                <ul class="navbar-nav d-flex flex-row me-1">
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="#"><i class="fas fa-envelope mx-1"></i> Contact</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="#"><i class="fas fa-cog mx-1"></i> Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user mx-1"></i> Welcome {{ Auth::user()->name }}!
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">My account</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <main>

        <div class="row">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="{{route('dashboard')}}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('hotel')}}" class="nav-link px-0 align-middle">
                                <i class="fas fa-hotel"></i> <span class="ms-1 d-none d-sm-inline">Hotel</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('rating')}}" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-star"></i> <span class="ms-1 d-none d-sm-inline">Rating</span></a>
                        </li>
                        <li>
                            <a href="{{ route('reservation') }}" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-book"></i> <span class="ms-1 d-none d-sm-inline">Reservation</span>
                            </a>
                        </li>

                        <a href="{{route('rooms')}}" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-bed"></i> <span class="ms-1 d-none d-sm-inline">Room</span>
                        </a>
                        </li>
                        <a href="{{route('invoice')}}" class="nav-link px-0 align-middle">
                            <i class="bi bi-receipt"></i> <span class="ms-1 d-none d-sm-inline">Invoice</span>
                        </a>
                        </li>
                        <li>
                            <a href="{{route('user')}}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">User</span>
                            </a>
                        </li>
                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col-sm-8">
                @yield('content')
            </div>
        </div>

    </main>
    <footer>

    </footer>
</body>

</html>