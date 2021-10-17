<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin_/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin_/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin_/assets/images/favicon.svg" type="image/x-icon') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="{{ asset('admin_/assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('admin_/assets/vendors/fontawesome/all.min.css') }}">

    @yield('css')

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            {{-- <a href="index.html"><img src="{{ asset('admin_/assets/images/logo/logo.png') }}" alt="Logo"
                                    srcset="" /></a> --}}
                                    {{ auth()->user()->name }}
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                @include('admin.layouts.sidebar')

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3" style="margin-top: -30px">
                <a href="#" class="burger-btn d-block d-xl-none mb-3">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('title')</h3>
                            <p class="text-subtitle text-muted">@yield('subtitle')</p>
                        </div>
                    </div>
                </div>
                <section class="section">
                    @yield('content')
                </section>
            </div>

            @include('admin.layouts.footer')

        </div>
    </div>
    
    <script src="{{ asset('admin_/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin_/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_/assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('admin_/assets/js/mazer.js') }}"></script>

    @include('admin.layouts.toastr')

</body>

</html>
