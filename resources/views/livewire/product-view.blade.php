 
<main>
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        Product <small class="text-muted mode_label">View</small>
                    </h4>
                </div>
                <!--col-->
                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.product.index') }}" title="Close" class="btn btn-light btn-sm"><i
                                class="fas fa-times"></i></a>
                    </div>
                    <!--btn-toolbar-->
                </div>
                <!--col-->
            </div>
            <!--card-header-actions-->
        </section>
        <!--card-header-->
        <section class="card-body">
            <div class="form-group row">
                <label for="sku" class="col-sm-2 col-form-label text-lg-right">SKU</label>
                <div class="col">
                    <input type="text" class="form-control" id="sku" name="sku" maxlength="20"
                        placeholder="Stock Keeping Unit ID of the product" value="{{ $product->sku }}"
                        readonly="readonly" required />
                    @error('sku') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="brand" class="col-sm-2 col-form-label text-lg-right">Brand</label>
                <div class="col-sm-10">
                    <select class="form-control select2" readonly="readonly" name="brand_id" required>
                        @foreach (App\Models\Brand::get() as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label text-lg-right">Category</label>
                <div class="col-sm-10">
                    <select class="form-control select2" name='category' id="category" required>
                        @foreach (App\Models\Product::getEnum('category') as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <section class="alert alert-secondary">
                @foreach ($variationTypes as $one)
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label text-lg-right">Variation Type</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $one->title }}" id="type" disabled />
                        </div>
                        <label for="variation_ids" class="col-sm-2 col-form-label text-lg-right">Variation</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name='variation_ids[]' readonly="readonly">
                                <option value="0" selected>Select a variation</option>
                                @foreach (App\Models\VariationType::getVariations($one->id) as $variation)
                                    <option value="{{ $variation->id }}" @if (in_array($variation->id, $product_variations)) selected @endif>
                                        {{ $variation->title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </section>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-lg-right">Title</label>
                <div class="col">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title of the product"
                        maxlength="100" value="{{ $product->title }}" readonly="readonly" required />
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label text-lg-right">Price</label>
                <div class="col">
                    <input type="number" min="1" class="form-control" id="price" name="price"
                        placeholder="Price of the product" value="{{ $product->price }}" readonly="readonly"
                        required />
                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="fixing_cost" class="col-sm-2 col-form-label text-lg-right">Fixing Cost</label>
                <div class="col">
                    <input type="number" class="form-control" id="fixing_cost" min="1" name="fixing_cost"
                        placeholder="Fixing of the product" value="{{ $product->fixing_cost }}" readonly="readonly"
                        required />
                    @error('fixing_cost') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="total_area" class="col-sm-2 col-form-label text-lg-right">Total sq.ft</label>
                <div class="col">
                    <input type="number" min="1" class="form-control" id="total_area" name="total_area"
                        value="{{ $product->total_area }}" placeholder="Total sq.ft available"
                        value="{{ old('total_area') }}" required />
                    @error('total_area') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="notes" class="col-sm-2 col-form-label text-lg-right">Notes</label>
                <div class="col">
                    <textarea class="form-control" id="notes" name="notes"
                        readonly="readonly">{{ $product->notes }}</textarea>
                    @error('notes') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label text-lg-right">Link</label>
                <div class="col">
                    <input type="url" class="form-control" id="url" name="url" placeholder="Link to product page"
                        value="{{ $product->url }}" />
                    @error('url') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row ">
                <div class="custom-control custom-checkbox">
                    <div class="col">
                        <label class=" col  offset-3 " for="isDefault">
                            <input type="checkbox" id="isDefault" name="isDefault" value="{{ $product->isDefault }}"
                                {{ $product->isDefault == 1 ? 'checked' : null }}> Default product?</label>
                    </div>
                </div>
            </div>
        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class="row">
                <div class="col">
                    @can('PRODUCT_DELETE')
                        <button type="button" url="{{ route('admin.product.destroy', $product_id) }}"
                            return_url="{{ route('admin.product.index') }}"
                            class="btn btn-danger btn_delete">Delete</button>
                    @endcan
                </div>
                <div class="col text-right">
                    @can('PRODUCT_EDIT')
                        <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                        <button type="button" class="btn btn-primary btn_edit">Edit</button>
                    @endcan
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
</main>
