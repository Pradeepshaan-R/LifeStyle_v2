<main>
    <div class="wizard-v3-content">
        <div class="wizard-form">
            <div class="wizard-header">
                <h3 class="heading">Cost estimator</h3>
                <p>Fill all fields to go next step</p>
            </div>
            <form class="form-register" action="#" method="post">
                <div id="form-total">
                    <!-- SECTION 1 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-account"></i></span>
                        <span class="step-text">Type</span>
                    </h2>
                    <section>
                        <div class="inner">
                            type={{ $type }}
                            <div class="form-row ">
                                <div class="offset-3 col-2">
                                    <input type="radio" class="form-radio" name="type" id="roofCheck"
                                        wire:click="changeType('roofing')" value="roofing">
                                    <label for="radio-choice-1">Roof</label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="type" id="ceilingCheck" wire:click="changeType('ceiling')"
                                        value="ceiling" />
                                    <label for="radio-choice-2">Ceilling</label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="type" id="bothCheck" wire:model="type" value="both" />
                                    <label for="radio-choice-2">Both</label>
                                </div>
                            </div>
                            <br>
                            @if ($type == 'roofing' || $type == 'both')
                            <aside id="roof_data">
                                <div class="form-group row">
                                    <label for="roof_area" class="col-sm-3 col-form-label text-sm-right">Roof
                                        Area</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="roof_area" name="roof_area"
                                            wire:click="changeEvent($event.target.value)" />
                                    </div>
                                    <label for="roof_unit" class="col-sm-2 col-form-label text-sm-right">Unit</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name='roof_unit' id="roof_unit">
                                            <option value="sqft">Sq. foot</option>
                                            <option value="sqm">Sq. Meters</option>
                                        </select>
                                    </div>
                                </div>
                            </aside>
                            @endif
                            @if ($type == 'ceiling' || $type == 'both')
                            <aside id="ceiling_data">
                                <div class="form-group row">
                                    <label for="ceiling_area" class="col-sm-3 col-form-label text-sm-right">Ceiling
                                        Area</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="ceiling_area"
                                            name="ceiling_area" />
                                    </div>
                                    <label for="ceiling_unit" class="col-sm-2 col-form-label text-sm-right">Unit</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name='ceiling_unit' id="ceiling_unit">
                                            <option value="sqft">Sq. foot</option>
                                            <option value="sqm">Sq. Meters</option>
                                        </select>
                                    </div>
                                </div>
                            </aside>
                            @endif
                        </div>
                    </section>
                    <!-- SECTION 2 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-lock"></i></span>
                        <span class="step-text">Calculate</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <aside class="row">
                                <div class="col">
                                    <h3 class="text-danger">Required</h3>
                                </div>
                                <div class="col"><a class="btn btn-dark btn-lg">Roof: 100 sq. foot</a></div>
                                <div class="col"><a class="btn btn-dark btn-lg">Ceiling: 200 sq. foot</a>
                                </div>
                            </aside>
                            <hr />
                            <h3>Available Material:</h3>
                            <aside class="alert alert-secondary">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="all" name="brand" value="0" class="custom-control-input"
                                        checked>
                                    <label class="custom-control-label" for="all">All</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="brand1" name="brand" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="brand1">Brand 1</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="brand2" name="brand" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="brand2">Brand 2</label>
                                </div>
                            </aside>
                            <div class="form-row">
                                <table class="table-responsive-sm table-bordered" width="100%">
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
                                        <tr>
                                            <td>Roof</td>
                                            <td>Cement weather proof</td>
                                            <td>6ft Red</td>
                                            <td>1250</td>
                                            <td>12</td>
                                            <td>125,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ceiling</td>
                                            <td>Eltoro Gypsum</td>
                                            <td>6ft Red</td>
                                            <td>1250</td>
                                            <td>10</td>
                                            <td>125,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </section>
                    <!-- SECTION 3 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                        <span class="step-text">Register</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <h3>Contact Details:</h3>
                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number"
                                    required>
                            </div>
                        </div>
                    </section>
                    <!-- SECTION 4 -->
                    <h2>
                        <span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
                        <span class="step-text">Estimate</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="form-row">
                                <table class="table-responsive-sm table-bordered" width="100%">
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
                                        <tr>
                                            <td>Rhino cement sheet</td>
                                            <td>10ft Red</td>
                                            <td>6,000</td>
                                            <td>10,000</td>
                                            <td><input type="number" class="form-input" name="qty1" value="1"></td>
                                            <td>20,000</td>
                                            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#productViewModal">
                                                    View
                                                </button></td>
                                        </tr>
                                        <tr>
                                            <td>Eltoro ceiling</td>
                                            <td>10ft Red</td>
                                            <td>6,000</td>
                                            <td>10,000</td>
                                            <td><input type="number" class="form-input" name="qty1" value="1"></td>
                                            <td>20,000</td>
                                            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#productViewModal">
                                                    View
                                                </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <aside class="alert alert-secondary d-flex justify-content-center">
                                    <h4>Total Cost: Rs. 200,000</h4>
                                </aside>
                            </div>
                        </div>
                    </section>
                    <!-- <h2>
                        <span class="step-icon"><i class="zmdi zmdi-lock"></i></span>
                        <span class="step-text">Calculate</span>
                    </h2>
                    <section>
                    </section> -->
                </div>
            </form>
        </div>
    </div>
</main>
