<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- leaflet cdn --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    {{-- CKE editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- bootstrap cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- main css --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>@yield('title')</title>
</head>

<body>

    <div class="container-fluid py-3">
        <div class="row">
            {{-- Admin Panel --}}
            <div class="d-flex justify-content-between  ">
                <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#adminPanel"
                    aria-controls="adminPanel">
                    <i class="fa-solid fa-bars fs-3"></i>
                </button>

                <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="adminPanel"
                    aria-labelledby="adminPanelLabel">
                    <div class="offcanvas-header">
                        <i class="fa-solid fa-truck fs-3"></i>
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Admin Panel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            <div class="row">
                                <a href="{{ route('item#list') }}"
                                    class="btn @if ($tabName == 'item') btn-primary @endif  mb-3">
                                    <div class=" d-flex align-items-center fs-5">
                                        <i class="fa-solid fa-boxes-stacked me-3"></i>
                                        <span>Item</span>
                                    </div>
                                </a>

                                <a href="{{ route('category#list') }}"
                                    class="btn @if ($tabName == 'category') btn-primary @endif mb-3 ">
                                    <div class=" d-flex align-items-center fs-5">
                                        <i class="fa-solid fa-list me-3"></i>
                                        <span>Category</span>
                                    </div>
                                </a>
                            </div>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn fs-3" id="logoutBtn">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="#!" class="btn d-flex align-items-center">
                    <h5>{{ Auth::user()->name }}</h5>
                    <img src='{{ asset('storage/user image.jpg') }}' alt="" class="img profileImg">
                </a>
            </div>

        </div>

        @yield('content')


    </div>

    {{-- Back To Top Button --}}
    <button class="btn p-3 z-50" id="backToTopBtn">
        <i class="fa-solid fa-angles-up fw-bold fs-1" id="upArrow"></i>
    </button>



</body>
{{-- leaflet cdn --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
{{-- Opencage geocoder cdn --}}
<script src="https://api.opencagedata.com/geocoding/v3/dccf96fbedbf49f3b7a56d8f7cc5d56a"></script>
{{-- jQuery cdn --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{-- bootstrap cdn --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
{{-- main js --}}
<script src="{{ asset('js/admin.js') }}"></script>

</html>
