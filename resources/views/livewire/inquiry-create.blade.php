<article class="container">
    <h1 class="text-center m3">Cost estimator</h1>

    <!-- Nav tabs -->
    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($tab == 'area') active @endif" id="area-tab" data-toggle="tab" href="#area"
                role="tab" aria-controls="area" aria-selected="true" wire:model="tab" value="area">1. Area</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($tab == 'calculate') active @endif" id="calculate-tab" data-toggle="tab"
                href="#calculate" role="tab" aria-controls="calculate" aria-selected="false" wire:model="tab"
                value="calculate">2.
                Calculate</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($tab == 'register') active @endif" id="register-tab" data-toggle="tab"
                href="#register" role="tab" aria-controls="register" aria-selected="false" wire:model="tab"
                value="register">3. Register</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($tab == 'estimate') active @endif" id="estimate-tab" data-toggle="tab"
                href="#estimate" role="tab" aria-controls="estimate" aria-selected="false" wire:model="tab"
                value="estimate">4. Estimate</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <main class="tab-content mt-3 text-center">

        <!-- TAB 1 -->
        <section class="tab-pane fade @if ($tab == 'area') active show @endif " id="area" role="tabpanel"
            aria-labelledby="area-tab">
            <aside class="card">
                <h3 class="card-header">Select the type</h3>
                <div class="card-body">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline" value="roofing"
                            wire:model="type" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Roof</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline" value="ceiling"
                            wire:model="type" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Ceiling</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline3" name="customRadioInline" value="both"
                            wire:model="type" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline3">Both</label>
                    </div>
                    <hr />
                    @if ($type == 'roofing' || $type == 'both')
                    <div class="form-group row">
                        <label for="roof_area" class="col-sm-2 col-form-label text-lg-right">Roof Area :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="roof_area" name="roof_area" min="1"
                                wire:model="roof_area">
                        </div>
                        <label for="roof_unit" class="col-sm-2 col-form-label text-lg-right">Unit</label>
                        <div class="col-sm-4">
                            <select class="form-control" name='roof_unit' id="roof_unit" wire:model="roof_unit">
                                <option value="sqft">Sq. foot</option>
                                <option value="sqm">Sq. Meters</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    @if ($type == 'ceiling' || $type == 'both')
                    <div class="form-group row">
                        <label for="ceiling_area" class="col-sm-2 col-form-label text-lg-right">Ceiling Area
                            :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="ceiling_area" name="ceiling_area" min="1"
                                wire:model="ceiling_area">
                        </div>
                        <label for="ceiling_unit" class="col-sm-2 col-form-label text-lg-right">Unit</label>
                        <div class="col-sm-4">
                            <select class="form-control" name='ceiling_unit' id="ceiling_unit"
                                wire:model="ceiling_unit">
                                <option value="sqft">Sq. foot</option>
                                <option value="sqm">Sq. Meters</option>
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer text-right"><a class="btn btn-dark">Next</a></div>
            </aside>
        </section>

        <!-- TAB 2 -->
        <section class="tab-pane fade @if ($tab == 'calculate') active show @endif  " id="calculate" role="tabpanel"
            aria-labelledby="calculate-tab">
            <aside class="card">
                <h3 class="card-header">Basic calculations</h3>
                <div class="card-body">
                    <div class="row m-3">
                        <div class="col">Required:
                            <button class="btn btn-secondary">Roofing: {{ $roof_area }} {{ $roof_unit }}</button>
                            <button class="btn btn-secondary">Ceiling: {{ $ceiling_area }}
                                {{ $ceiling_unit }}</button>
                        </div>
                    </div>
                    <table class="table table-striped table-hover text-left">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Product</th>
                                <th scope="col">Variations</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($defaultProducts as $product)
                            @php
                            if ($product->category == 'Roofing') {
                            $qty = ceil($roof_area / $product->total_area);
                            } else {
                            $qty = ceil($ceiling_area / $product->total_area);
                            }
                            $variationIds = App\Models\ProductVariation::getVariations($product->id);
                            $variationList = '';
                            foreach ($variationIds as $one) {
                            $variation = App\Models\Variation::where('id', $one)
                            ->select('id', 'title')
                            ->first();
                            $variationList .= $variation->title . ', ';
                            }
                            @endphp
                            <tr>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $variationList }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ $qty }}</td>
                                <td>{{ $qty * $product->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer text-right"><a class="btn btn-dark">Next</a></div>
            </aside>
        </section>

        <!-- TAB 3 -->
        <section class="tab-pane fade  @if ($tab == 'register') active show @endif" id="register" role="tabpanel"
            aria-labelledby="register-tab">
            <aside class="card">
                <h3 class="card-header">Register now</h3>

                <div class="card-body">
                    @if ($isRegistered)
                        <div class="col alert alert-success text-center">Thank you for registering</div>
                    @else
                    <div class="form-group row">
                        <label for="roof_area" class="col-sm-2 col-form-label text-lg-right">Name: </label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" placeholder=" Enter your Name"
                                wire:model.defer="name" required>
                        </div>
                        <label for="roof_unit" class="col-sm-2 col-form-label text-lg-right">Contact Number: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter your phone number" wire:model.defer="phone" required>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="card-footer text-right"><a class="btn btn-dark" wire:click="register">Next</a></div>

            </aside>

        </section>

        <!-- TAB 4 -->
        <section class="tab-pane fade @if ($tab == 'estimate') active show @endif  " id="estimate" role="tabpanel"
            aria-labelledby="estimate-tab">
            <aside class="card">
                <h3 class="card-header">Enjoy the estimate</h3>
                <div class="card-body">

                    <div class="form-row">
                        @if ($isRegistered)
                        <table class="table-responsive-sm table-bordered text-left" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Variation</th>
                                    <th scope="col">Material cost</th>
                                    <th scope="col">Fixing Cost</th>
                                    <th scope="col" width="5px">Qty</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allProducts as $oneProduct)
                                @php
                                if ($oneProduct->category == 'Roofing') {
                                $qty = ceil($roof_area / $oneProduct->total_area);
                                $fixingCost = ceil($roof_area / $oneProduct->fixing_cost);
                                } else {
                                $qty = ceil($ceiling_area / $oneProduct->total_area);
                                $fixingCost = ceil($ceiling_area / $oneProduct->fixing_cost);
                                }

                                $variationIds = App\Models\ProductVariation::getVariations($oneProduct->id);
                                $variationList = '';
                                foreach ($variationIds as $one) {
                                $variation = App\Models\Variation::where('id', $one)
                                ->select('id', 'title')
                                ->first();
                                $variationList .= $variation->title . ', ';
                                }
                                @endphp
                                <tr>
                                    <td>{{ $oneProduct->title }}</td>
                                    <td> {{ $variationList }}</td>
                                    <td>{{ number_format($oneProduct->price) }}</td>
                                    <td>{{ number_format($oneProduct->fixing_cost) }}</td>
                                    <td>
                                        <input type="number" class="form-input" name="qty[]" id="" min="1"
                                            value="{{ $qty }}">
                                    </td>
                                    <td>{{ number_format($fixingCost + $oneProduct->price * $qty) }}</td>
                                    <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#productViewModal">
                                            View
                                        </button></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <aside class="alert alert-secondary d-flex justify-content-center">
                            <h4>Total Cost: Rs. 200,000</h4>
                        </aside>
                        @else
                        <div class="col alert alert-danger text-center">Please register first</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer text-right"><a class="btn btn-dark">Next</a></div>
            </aside>
        </section>
    </main>
</article>