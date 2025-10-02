<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocSecure</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand me-3" href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('home') : route('home')) : '/' }}">DocSecure</a>
            @php
                $hideBack = false;
                if (request()->routeIs('login')) $hideBack = true;
            @endphp
            @if(!$hideBack)
            <button class="btn btn-outline-secondary me-auto" onclick="window.history.back()">&larr; Kembali</button>
            @endif
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @else
                        @if(Auth::user() && Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.documents.index') }}">Dokumen</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Manajemen Kunci</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Manajemen User</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('documents.index') }}">Dokumen</a></li>
                        @endif
                        @if(Auth::user() && Auth::user()->role !== 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profil</a></li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
