<section class="signup-step-container">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Step 1</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Step 2</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Step 3</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Step 4</i></a>
                            </li>
                        </ul>
                    </div>

                    <form role="form" action="index.html" class="login-box">
                        <div class="tab-content" id="main_form">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h4 class="text-center">Type</h4>
                                <div class="row">
                                    <div class="offset-3 col-2">
                                        <input type="radio" class="form-radio" name="type" id="roofCheck" wire:click="changeType('roofing')"  value="roofing">
                                        <label for="radio-choice-1">Roof</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="type" id="ceilingCheck" wire:click="changeType('ceiling')"  value="ceiling"  />
                                        <label for="radio-choice-2">Ceilling</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="radio" name="type" id="bothCheck"  wire:click="changeType('both')" value="both"  />
                                        <label for="radio-choice-2">Both</label>
                                    </div>
                                </div>

                                @if ($type == 'roofing' || $type == 'both')
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="location1">Roof Area :</label>

                                            <input type="number" class="form-control" id="roof_area"
                                                name="roof_area" min="1" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="location1">Unit :</label>

                                            <select class="form-control" name='roof_unit' id="roof_unit">
                                                <option value="sqft">Sq. foot</option>
                                                <option value="sqm">Sq. Meters</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($type == 'ceiling' || $type == 'both')
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="location1">Ceilling Area :</label>

                                                <input type="number" class="form-control" id="ceiling_area"
                                                name="ceiling_area" min="1"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="location1">Unit :</label>

                                                <select class="form-control" name='ceiling_unit' id="ceiling_unit">
                                                    <option value="sqft">Sq. foot</option>
                                                    <option value="sqm">Sq. Meters</option>
                                                </select>
                                            </div>
                                        </div>



                                </div>
                                @endif
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="default-btn next-step">Continue to next step</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step2">
                                <h4 class="text-center">Calculate</h4>
                                <div class="row">
                                    <div class="col">
                                        <h3 class="text-danger">Required</h3>
                                    </div>
                                    <div class="col"><a class="btn-dark text-light btn-lg">Roof: 100 sq. foot</a></div>
                                    <div class="col"><a class="btn-dark text-light btn-lg">Ceiling: 200 sq. foot</a>
                                    </div>
                                </div>

                                <h3>Available Material:</h3>
                                <div class="alert alert-secondary">
                                    <div class="row">
                                        <div class="offset-3 col-2">
                                            <input type="radio" class="form-radio" name="all" id="all"    value="0">
                                            <label for= "all">All</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="brand" id="brand1"   value="1"  />
                                            <label for="radio-choice-2">Brand 1</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="radio" name="brand" id="brand2"  value="2"  />
                                            <label for="radio-choice-2">Both</label>
                                        </div>
                                    </div>
                                </div>
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
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                    <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                    <li><button type="button" class="default-btn next-step">Continue</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step3">
                                <h4 class="text-center">Register</h4>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name </label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        required>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                    <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                    <li><button type="button" class="default-btn next-step">Continue</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step4">
                                <h4 class="text-center">Estimate</h4>
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

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                    <li><button type="button" class="default-btn next-step">Finish</button></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
