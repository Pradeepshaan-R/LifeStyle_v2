<main>
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">
                        Product <small class="text-muted mode_label">View</small>
                    </h4>
                </div>
                <!--col-->
                <div class="col-4">
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
                    <input type="text" class="form-control" id="sku" name="sku" readonly="readonly" required
                        value="{{ $product->sku }}" />
                    @error('sku') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="brand" class="col-sm-2 col-form-label text-lg-right">Brand</label>
                <div class="col">
                    <select class="form-control select2" wire:model="brand" readonly="readonly" required>
                        <option value="">Select Brand type</option>
                        @foreach ($brands as $one)
                        <option value="{{ $one->id }}" @if($one->id == $brand) selected @endif >
                            {{ $one->title }}</option>
                        @endforeach
                    </select>
                    @error('brand') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label text-lg-right">Category</label>
                <div class="col">
                    @if ($brand != 0)
                    <select class="form-control select2" name='category_id' id="category_id" required readonly>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : ''
                            }}>
                            {{ $category->title }}</option>
                        @endforeach
                    </select>
                    @else
                    <input type="text" class="form-control" placeholder="Please select a Brand first" readonly />
                    @endif
                    @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label text-lg-right">Variation Type</label>
                <div class="col">
                    <select class="form-control select2" wire:model="type" readonly="readonly" required>
                        <option value="">Select variation type</option>
                        @foreach ($variationTypes as $two)
                        <option value="{{ $two->id }}" @if($two->id == $variationType) selected @endif >
                            {{ $two->title }}</option>
                        @endforeach
                    </select>
                    @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="variation_id" class="col-sm-2 col-form-label text-lg-right">Variation</label>
                <div class="col">
                    @if ($type != 0)
                    <select class="form-control select2" wire:model="variation_id" name="variation_id"
                        readonly="readonly" required>
                        @foreach ($variations as $variation)
                        <option value="{{ $variation->id }}" {{$product->$variation_id == $variation->id ? 'selected' :
                            '' }}>
                            {{ $variation->title }}</option>
                        @endforeach
                    </select>
                    @else
                    <input type="text" class="form-control" placeholder="Please select a Variation Type first"
                        readonly />
                    @endif
                    @error('variation_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label text-lg-right">Title</label>
                <div class="col">
                    <input type="text" class="form-control" name="title" readonly="readonly" required @if (old('title'))
                        value="{{ old('title') }}" @else value="{{ $product->title }}" @endif />
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label text-lg-right">Price</label>
                <div class="col">
                    <input type="text" class="form-control" id="price" name="price" readonly="readonly" required
                        value="{{ $product->price }}" />
                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="fixing_cost" class="col-sm-2 col-form-label text-lg-right">Fixing Cost</label>
                <div class="col">
                    <input type="number" class="form-control" id="fixing_cost" name="fixing_cost" readonly="readonly"
                        required value="{{ $product->fixing_cost}}" value="{{ $product->fixing_cost }}" />
                    @error('fixing_cost') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="notes" class="col-sm-2 col-form-label text-lg-right">Note</label>
                <div class="col">
                    <textarea class="form-control" id="notes" name="notes"
                        readonly="readonly"> {{ $product->notes }} </textarea>
                    @error('notes') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class="row">
                <div class="col">
                    {{-- @can('PRODUCT_DELETE') --}}
                    <button type="button" url="{{ route('admin.product.destroy', $product_id) }}"
                        return_url="{{ route('admin.brand.index') }}" class="btn btn-danger btn_delete">Delete</button>
                    {{-- @endcan --}}
                </div>
                <div class="col text-right">
                    {{-- @can('PRODUCT_EDIT') --}}
                    <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                    <button type="button" class="btn btn-primary btn_edit">Edit</button>
                    {{-- @endcan --}}
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
</main>
