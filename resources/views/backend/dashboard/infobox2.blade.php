<section class="row d-flex justify-content-center mt-3">
    <aside class="card col-3 bg-info text-white border-0 mr-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="fas fa-award fa-3x"></i>
                <div class="ml-4">
                    <h4 class="font-weight-light">Category Summary</h4>
                    <h3 class="mb-3">{{ count($categories) }}</h3>
                    <p class="mb-0 font-weight-light">Active : {{ $categoryActivePercentage }}%</p>
                </div>
            </div>
        </div>
    </aside>

    <aside class="card col-3 bg-success text-white border-0 mr-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="fas fa-address-card fa-3x"></i>
                <div class="ml-4">
                    <h4 class="font-weight-light">Product Summary</h4>
                    <h3 class="mb-3">{{ count($products) }}</h3>
                     <p class="mb-0 font-weight-light">Available : {{ $productAvailablePercentage }}%</p>
                </div>
            </div>
        </div>
    </aside>

    <aside class="card col-3 bg-warning text-white border-0">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="fas fa-user fa-3x"></i>
                <div class="ml-4">
                    <h4 class="font-weight-light">Stock Summary</h4>
                    <h3 class="mb-3">{{ count($stocks) }}</h3>
                    {{-- <p class="mb-0 font-weight-light">Active : {{ $categoryActivePercentage }}%</p> --}}
                </div>
            </div>
        </div>
    </aside>

</section>