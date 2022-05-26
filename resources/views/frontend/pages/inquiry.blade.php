@extends('frontend.layouts.app')
@section('title', __('Shop'))

@push('after-scripts')
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/all.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>
@endpush

<style>
    .top-panel {
        background: rgb(4, 71, 156);
        background: linear-gradient(317deg, rgba(4, 71, 156, 1) 0%, rgba(9, 179, 192, 1) 94%, rgba(0, 212, 255, 1) 100%);
    }

    .menu-category-item a:hover {
        color: white;
        background: rgb(4, 71, 156);
        background: linear-gradient(17deg, rgba(4, 71, 156, 1) 0%, rgba(9, 179, 192, 1) 94%, rgba(0, 212, 255, 1) 100%);
    }

</style>


@section('content')
    {{-- <livewire:customer /> --}}
    {{-- <livewire:shop /> --}}
    {{-- @livewire('shop') --}}
    <header class="section-header top-panel">
        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <h3 class="text-white">
                            LifeStyle MarketPlace
                        </h3>
                    </div>
                    <div class="col-lg-6 col-sm-12 pl-5">
                        <form action="#" class="search">
                            <div class="input-group w-100 pt-3 text-white">
                                <input type="text" class="form-control text-light" style="background: transparent"
                                    placeholder="Search" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-info" wire:click="filter" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> <!-- search-wrap .end// -->
                    </div> <!-- col.// -->
                    <div class="col-lg-4 col-sm-6 col-12 pl-0">
                        <div class="widgets-wrap float-md-end">
                            <div class="widget-header me-3">
                                <a href="#" class="icon icon-sm rounded-circle border pt-3"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify">0</span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="#" class="icon icon-sm rounded-circle border pt-3"><i
                                        class="fa fa-user"></i></a>
                                <div class="text">
                                    <span class="text-light">Welcome!</span>
                                    <div class="text-light">
                                        <a href="#" class="text-white">Sign in</a> |
                                        <a href="{{ url('admin/customer/register') }}" class="text-white">
                                            Register</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
        </section> <!-- header-main .// -->



        <nav class="navbar navbar-main navbar-expand-lg navbar-dark border-bottom">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-light" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                </div> <!-- collapse .// -->
            </div> <!-- container .// -->
        </nav>
    </header> <!-- section-header.// -->


    <!-- ========================= SECTION MAIN ========================= -->
    <section class="section-main bg padding-y">
        <div class="container">
            <div class="row">
                <aside class="col-md-3">
                    <nav class="card">
                        <ul class="menu-category">
                            @foreach ($categoryTop as $one)
                                <li class="menu-category-item"><a href="#">{{ $one->title }}</a></li>
                            @endforeach

                            <li class="has-submenu"><a href="#">More items</a>
                                <ul class="submenu">
                                    @foreach ($categoryBottom as $two)
                                        <li class="menu-category-item"><a href="#">{{ $two->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </aside> <!-- col.// -->
                <div class="col-md-9">
                    <article class="banner-wrap">
                        <img src="assets/images/6.jpg" style="height: 400px" class="w-100 rounded">
                    </article>
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container //  -->
    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

    <!-- ========================= SECTION  ========================= -->
    <section class="section-name padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Products</h3>
            </header>


            <div class="row">
                @foreach ($product as $one)
                    <div class="col-md-3">
                        <div href="#" class="card card-product-grid">
                            <a href="#" class="img-wrap"> <img
                                    src="{{ asset('storage/uploads/') . '/' . $one->filename }}"> </a>
                            <div class="info-wrap">
                                <a href="#" class="title">{{ $one->title }}</a>
                                <div class="price mt-1">Rs. {{ number_format($one->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ========================= SECTION  END// ========================= -->

    <!-- ========================= FOOTER ========================= -->
    <footer class="section-footer border-top bg-dark text-light">
        <div class="container">
            <section class="footer-top padding-y text-center">
                <div class="row">
                    <aside class="col-md-3 col-6">
                        <h6 class="title text-info">COMPANY</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">About us</a></li>
                            <li> <a href="#">Career</a></li>
                            <li> <a href="#">Find a store</a></li>
                            <li> <a href="#">Rules and terms</a></li>
                            <li> <a href="#">Sitemap</a></li>
                        </ul>
                    </aside>
                    <aside class="col-md-3 col-6">
                        <h6 class="title text-info">HELP</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">Contact us</a></li>
                            <li> <a href="#">Money refund</a></li>
                            <li> <a href="#">Order status</a></li>
                            <li> <a href="#">Shipping info</a></li>
                            <li> <a href="#">Open dispute</a></li>
                        </ul>
                    </aside>
                    <aside class="col-md-3 col-6">
                        <h6 class="title text-info">ACCOUNT</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#"> User Login </a></li>
                            <li> <a href="#"> User register </a></li>
                            <li> <a href="#"> Account Setting </a></li>
                            <li> <a href="#"> My Orders </a></li>
                        </ul>
                    </aside>
                    <aside class="col-md-3">
                        <h6 class="title text-info">SOCIAL</h6>
                        <ul class="list-unstyled">
                            <li><a href="#"> <i class="fab fa-facebook"></i> Facebook </a></li>
                            <li><a href="#"> <i class="fab fa-twitter"></i> Twitter </a></li>
                            <li><a href="#"> <i class="fab fa-instagram"></i> Instagram </a></li>
                            <li><a href="#"> <i class="fab fa-youtube"></i> Youtube </a></li>
                        </ul>
                    </aside>
                </div> <!-- row.// -->
            </section> <!-- footer-top.// -->

            <section class="footer-bottom row">
                <div class="col-md-2">
                    <p class="text-muted"> 2022 Upland Food Products </p>
                </div>
                <div class="col-md-8 text-md-center text-info">
                    <span class="px-2">info@com</span>
                    <span class="px-2">+101-245-6894</span>
                    <span class="px-2">Street name 123, ABC</span>
                </div>
                <div class="col-md-2 text-md-end text-muted">
                    <i class="fab fa-lg fa-cc-visa"></i>
                    <i class="fab fa-lg fa-cc-paypal"></i>
                    <i class="fab fa-lg fa-cc-mastercard"></i>
                </div>
            </section>
        </div>
    </footer>
@endsection
