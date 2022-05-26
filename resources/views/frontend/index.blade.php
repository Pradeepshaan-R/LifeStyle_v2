@include('frontend.pages.header')
<div class="py-md-32 position-relative">
    <div class="container-lg max-w-screen-xl">
        <div class="row align-items-center">
            
            <div class="col-lg-6 order-md-0">
                <!-- Surtitle -->
                <h5 class="h5 mb-5 text-uppercase text-warning mb-5">
                    LifeStyle MarketPlace
                </h5>
                <!-- Heading -->
                <h1 class="ls-tight font-bolder display-3 mb-5">
                    Build a beautiful Home, faster.
                </h1>
                <!-- Text -->
                <p class="lead mb-10">
                    Accelerate your home building while remaining cost effective.
                    </h1>
                    <!-- Buttons -->
                <div class="mx-n2">
                    <a href="{{url('/inquiry')}}" class="btn btn-lg btn-primary shadow-sm mx-2 px-lg-8">
                        Get started
                    </a>
                    {{-- <a href="{{url('/pages/howto')}}" class="btn btn-lg btn-neutral mx-2 px-lg-8">
                        Learn more
                    </a> --}}
                </div>
            </div>

            <div class="col-lg-6 ms-lg-auto mt-1">
                <div class="w-xl-12/10 position-relative">
                    <!-- Decorations -->
                    <span class="d-none d-lg-block position-absolute top-0 start-0 transform translate-x-n32 translate-y-n16 w-2/3 h-2/3 bg-warning opacity-20 rounded-circle filter blur-50"></span>
                    <span class="d-none d-xl-block position-absolute bottom-0 end-0 transform translate-x-16 translate-y-16 w-32 h-32 bg-warning opacity-60 rounded-circle filter blur-50"></span>
                    <!-- Image -->
                    <img alt="..." src="https://picsum.photos/720/500?random=1" class="shadow-4 rounded-4 position-relative overlap-10" />
                </div>
            </div>
        </div>
    </div>
</div>



@include('frontend.pages.footer')