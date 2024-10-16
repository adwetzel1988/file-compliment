<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'File Complaint')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/app.css">
    <style>
        .navbar-nav {
            width: 100%;
        }
        @media (min-width: 992px) {
            .navbar-nav {
                justify-content: flex-end;
            }
        }
        @media (max-width: 991px) {
            .navbar-nav {
                justify-content: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">File Compliment</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if(auth()->check() && auth()->user()->role !== 'admin' && auth()->user()->role !== 'subadmin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('complaints.create') }}">File a Compliment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('complaints.index') }}">My Compliments</a>
                        </li>
                    @endif
                    @auth
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.complaints.index') }}">All Compliments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            </li>
                        @elseif(auth()->user()->role === 'subadmin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.complaints.index') }}">Assigned Compliments</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('complaints.search') }}">Search Compliments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
