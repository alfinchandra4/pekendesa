<nav class="navbar navbar-expand-lg navbar-light p-3">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('categories') }}">Categories</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/register">Sign Up</a>
                </li>
                <li class="nav-item" style="background: green; border-radius:5px">
                    <a class="nav-link text-white" href="/login">Sign In</a>
                </li>
                @endguest
                @auth
                <li class="nav-item" style="border-left: 1px solid #E4E4E4;">
                    <a href="{{ route('cart') }}" class="btn btn-sm btn-default position-relative nav-link">
                        <i class="fa fa-lg fa-shopping-cart" aria-hidden="true"></i>
                        @if (session('cart'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            {{ count(session('cart')) }}
                        </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}" class="nav-link fw-bold"> Hi,
                        {{ auth()->user()->name }}</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
