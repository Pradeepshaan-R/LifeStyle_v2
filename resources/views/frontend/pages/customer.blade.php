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
    <header class="section-header top-panel">
        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <h3 class="text-white">
                            LifeStyle MarketPlace
                        </h3>
                    </div>
                </div>
            </div>
        </section>
    </header>


    <!-- ========================= SECTION MAIN ========================= -->
    <section class="section-main bg top-panel">
        <div class="container">

            <section class="vh-100 gradient-custom">
                <div class="container h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card shadow-lg shadow-2-strong card-registration" style="border-radius: 15px;">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>

                                    <div>
                                        {{-- <livewire:customer /> --}}

                                        <x-forms.post :action="route('admin.customer.store')" class="was-validated" id="myForm"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="firstName">First Name</label>
                                                        <input type="text" id="firstName"
                                                            class="form-control form-control-lg" name="first_name" />
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-4">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="lastName">Last Name</label>
                                                        <input type="text" id="lastName"
                                                            class="form-control form-control-lg" name="last_name" />
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                                    <div class="form-outline datepicker w-100">
                                                        <label for="birthdayDate" class="form-label">Birthday</label>
                                                        <input type="date" required class="form-control" id="dob"
                                                            name="dob" placeholder="Registration Date"
                                                            value="{{ old('dob') }}" />
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-4">

                                                    <label class="mb-2 pb-1">Gender: </label>

                                                    <select class="form-control" name='gender' id="gender"
                                                        readonly="readonly" name="gender">
                                                        <option value="">--Gender--</option>
                                                        @foreach (App\Models\Customer::getEnum('Gender') as $gender)
                                                            <option value="{{ $gender }}"
                                                                {{ old('gender') == $gender ? 'selected' : '' }}>
                                                                {{ $gender }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="emailAddress">Email</label>
                                                        <input type="email" id="emailAddress"
                                                            class="form-control form-control-lg" name="email" />
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-4 pb-2">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <input type="tel" id="phoneNumber"
                                                            class="form-control form-control-lg" name="phone" />
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="password">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder="Password" maxlength="100"
                                                            minlength="5" required value="{{ old('password') }}"
                                                            name="password" />
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-4 pb-2">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="confirm_password">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirm_password"
                                                            name="confirm_password" placeholder="Confirm Password"
                                                            maxlength="100" minlength="5" required
                                                            value="{{ old('confirm_password') }}"
                                                            name="confirm_password" />
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mt-4 pt-2 text-light">
                                                <div class="text-right text-white">
                                                    <a href="{{ url('/inquiry') }}"
                                                        class="btn btn-secondary">Back</a>
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                </div>
                                            </div>
                                        </x-forms.post>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

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
