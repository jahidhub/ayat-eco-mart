@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">

            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-dark">All
                        Products</a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('admin.product.create') }}">New Product</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-dark">Preview</a>
                </div>
            </div>
            <hr>

            <!-- Add Product Form -->
            <form id="form_submit" action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">

                        <!-- Product Title -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input name="name" id="name" type="text" class="form-control"
                                        placeholder="Enter product name">
                                </div>

                                <!-- Slug -->
                                <div class="mb-0">
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('/') }}
                                        </span>
                                        <input name="slug" id="slug" type="text" class="form-control"
                                            placeholder="slug">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Description -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" id="description" rows="6" class="form-control"
                                    placeholder="Enter product description"></textarea>
                            </div>
                        </div>

                        <!-- Product Data Tabs -->
                        <div class="card">
                            <div class="card-header bg-light fw-bold">Product Type</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select name="product_type" id="product_type" class="form-select">
                                            <option value="simple">Simple Product</option>
                                            <option value="variable">Variable Product</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <!-- Vertical Nav Tabs -->
                                        <div class="nav flex-column nav-pills" id="productTabs" role="tablist"
                                            aria-orientation="vertical">

                                            <button class="nav-link text-start" id="general-tab" data-bs-toggle="pill"
                                                data-bs-target="#general" type="button" role="tab">General</button>
                                            <button class="nav-link text-start" id="inventory-tab" data-bs-toggle="pill"
                                                data-bs-target="#inventory" type="button" role="tab">Inventory</button>
                                            <button class="nav-link text-start" id="shipping-tab" data-bs-toggle="pill"
                                                data-bs-target="#shipping" type="button" role="tab">Shipping</button>

                                            <button class="nav-link text-start" id="valiation-tab" data-bs-toggle="pill"
                                                data-bs-target="#valiation" type="button"
                                                role="tab">Valiations</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="tab-content bg-light p-3" id="productTabsContent">
                                            <!-- General Tab -->

                                            <div class="tab-pane fade" id="general" role="tabpanel"
                                                aria-labelledby="general-tab">
                                                <div class="mb-3">
                                                    <label id="regular_price" class="form-label">Regular Price</label>
                                                    <input type="number" id="regular_price" name="regular_price"
                                                        class="form-control" placeholder="0.00">
                                                </div>
                                                <div class="mb-3">
                                                    <label id="sale_price" class="form-label">Sale Price</label>
                                                    <input type="number" id="sale_price" name="sale_price"
                                                        class="form-control" placeholder="0.00">
                                                </div>
                                            </div>

                                            <!-- Inventory Tab -->
                                            <div class="tab-pane fade" id="inventory" role="tabpanel"
                                                aria-labelledby="inventory-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">SKU</label>
                                                    <div class="input-group">
                                                        <input type="text" id="sku" name="sku"
                                                            class="form-control" placeholder="PROD123">
                                                        <button type="button"
                                                            class="generate-sku-btn btn btn-sm btn-outline-secondary">Generate
                                                            SKU</button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label id="stock_status_label" for="stock_status"
                                                        class="form-label">Stock Status</label>
                                                    <select name="stock_status" id="stock_status" class="form-select">
                                                        <option value="in_stock">In_stock</option>
                                                        <option value="out_of_stock">Out_of_stock</option>
                                                    </select>
                                                </div>
                                                <div class="form-check" id="manageStock-container">
                                                    <input class="form-check-input" type="checkbox" id="manageStock">
                                                    <label class="form-check-label" for="manageStock">Manage
                                                        stock?</label>
                                                </div>

                                                <div class="mb-3" id="quantity-container" style="display: none;">
                                                    <label for="quantity" class="form-label">Stock Quantity</label>
                                                    <input type="number" id="quantity" name="quantity"
                                                        class="form-control" placeholder="10">
                                                </div>

                                            </div>

                                            <!-- Shipping Tab -->
                                            <div class="tab-pane fade" id="shipping" role="tabpanel"
                                                aria-labelledby="shipping-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">Weight (kg)</label>
                                                    <input type="number" id="weight" name="weight"
                                                        class="form-control" step="0.01" placeholder="0.00">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Dimensions (L × W × H)</label>
                                                    <div class="d-flex gap-2">
                                                        <input type="number" id="length" name="length"
                                                            class="form-control" placeholder="Length">
                                                        <input type="number" id="width" name="width"
                                                            class="form-control" placeholder="Width">
                                                        <input type="number" id="height" name="height"
                                                            class="form-control" placeholder="Height">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  valiations -->
                                            <div class="tab-pane fade" id="valiation" role="tabpanel"
                                                aria-labelledby="valiation-tab">
                                                <div class="valiation-section">
                                                    <h5 class="mb-3">Product Variations</h5>
                                                    <div id="var-container">
                                                        <div class="card" id="var-content">
                                                            <div
                                                                class="card-header  d-flex justify-content-between align-items-center">
                                                                <h6 class="mb-0">Variations</h6>
                                                                <div id="action-var">
                                                                    <a class="btn btn-sm btn-outline-danger me-2"
                                                                        id="remove-variation">Remove</a>
                                                                    <a id="add-new-variation"
                                                                        class="btn btn-sm btn-success">Add New</a>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow-sm border-0 mb-3">

                                                                <div class="card-body bg-light p-3">
                                                                    <div id="attribute-box">
                                                                        <div class="row g-3 align-items-end">

                                                                            <!-- Image -->
                                                                            <div class="col-md-2 col-lg-3">
                                                                                <label for="var_image"
                                                                                    class="form-label">Image</label>
                                                                                <div class="position-relative overflow-hidden border rounded p-1 bg-white text-center"
                                                                                    style="height: 80px;">
                                                                                    <label for="var_image"
                                                                                        class="h-100 d-flex justify-content-center align-items-center"
                                                                                        style="cursor: pointer;">
                                                                                        <img id="img_preview"
                                                                                            src="{{ asset('admin/assets/images/image-upload.png') }}"
                                                                                            alt="Click to upload"
                                                                                            class="image-preview img-fluid h-100 object-fit-contain">
                                                                                    </label>
                                                                                    <input type="file" id="var_image"
                                                                                        name="var_image[]"
                                                                                        class="form-control d-none"
                                                                                        onchange="previewImageMult(event)" multiple>
                                                                                </div>
                                                                            </div>

                                                                            <!-- SKU -->
                                                                            <div class="col-11 col-md-9 col-lg-8">
                                                                                <label for="var_sku"
                                                                                    class="form-label">SKU</label>
                                                                                <div class="input-group">
                                                                                    <input id="var_sku" type="text"
                                                                                        name="var_sku"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="VAR123">
                                                                                    <button type="button"
                                                                                        class="generate-sku-btn btn btn-sm btn-outline-secondary">
                                                                                        Generate
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Color -->
                                                                            <div class="col-1 col-md-1 col-lg-1">
                                                                                <label for="color"
                                                                                    class="form-label">Color</label>
                                                                                <input type="text"
                                                                                    class="form-control d-none"
                                                                                    id="color" name="color">
                                                                                <div class="pickr"></div>
                                                                            </div>
                                                                            <!-- Regular Price -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_regular_Price"
                                                                                    class="form-label">Regular Price
                                                                                    (£)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_regular_Price"
                                                                                    name="var_regular_Price"
                                                                                    placeholder="0.00">
                                                                            </div>

                                                                            <!-- Sale Price -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_sale_Price"
                                                                                    class="form-label">Sale Price
                                                                                    (£)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_sale_Price"
                                                                                    name="var_sale_Price"
                                                                                    placeholder="0.00">
                                                                            </div>
                                                                            <!-- Quantity -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_quantity"
                                                                                    class="form-label">Qty</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_quantity" name="var_quantity"
                                                                                    placeholder="0">
                                                                            </div>



                                                                            <!-- Size -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_size_id"
                                                                                    class="form-label">Size</label>
                                                                                <select id="var_size_id"
                                                                                    name="var_size_id"
                                                                                    class="form-select form-select-sm">
                                                                                    <option value="">Select Size
                                                                                    </option>
                                                                                    @foreach ($sizes as $size)
                                                                                        <option
                                                                                            value="{{ $size->id }}">
                                                                                            {{ $size->size }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <!-- Weight -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_weight"
                                                                                    class="form-label">Weight (kg)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_weight" name="var_weight"
                                                                                    placeholder="0">
                                                                            </div>

                                                                            <!-- Length -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_length"
                                                                                    class="form-label">Length (cm)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_length" name="var_length"
                                                                                    placeholder="0">
                                                                            </div>

                                                                            <!-- Width -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_width"
                                                                                    class="form-label">Width (cm)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_width" name="var_width"
                                                                                    placeholder="0">
                                                                            </div>

                                                                            <!-- Height -->
                                                                            <div class="col-md-4 col-xxl-3">
                                                                                <label for="var_height"
                                                                                    class="form-label">Height (cm)</label>
                                                                                <input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    id="var_height" name="var_height"
                                                                                    placeholder="0">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-start">
                                            <button type="submit" id="submitButton" class="btn btn-primary me-2">Save
                                                Changes</button>
                                            <button onclick="" type="reset"
                                                class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <!-- Publish -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Publish</div>

                            <button type="submit" id="submitButton"
                                class="w-100 text-center btn btn-primary px-4">Publish</button>

                        </div>

                        <!-- Product Image -->
                        <div class="mb-4">
                            <label class="card-header fw-bold">Product Image</label>

                            <div class="position-relative rounded overflow-hidden text-center">

                                <input type="file" id="feature_image" name="feature_image" class="form-control"
                                    onchange="previewImage(event)">

                                <img id="img_preview" src=""
                                    class="img-fluid w-50 h-50 object-fit-contain text-center">

                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Categories</div>
                            <div class="card-body">

                                <select name="category_id" id="category_id" class="form-control">

                                    <option value="">Selete category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="card-header fw-bold">Category related attributes</div>
                            <div class="card-body">

                                <div id="attribute-checkboxes" class="form-control"
                                    style="height:auto; min-height:50px; overflow-y:auto;">

                                </div>

                            </div>
                        </div>

                        <!-- Brands -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Brands</div>
                            <div class="card-body">
                                <select name="brand_id" id="brand_id" class="form-control">

                                    <option value="">Selete Option</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header fw-bold">Keywords</div>
                            <div class="card-body">
                                <input type="text" name="keywords" id="keywords" class="form-control"
                                    placeholder="Enter keywords, separated by commas">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header fw-bold">Status</div>
                            <div class="card-body d-flex ">
                                <div class="form-check me-3">
                                    <input checked type="radio" name="status" id="status_enabled" value="enabled"
                                        class="form-check-input">
                                    <label for="status_enabled" class="form-check-label">Enabled</label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" name="status" id="status_disabled" value="disabled"
                                        class="form-check-input">
                                    <label for="status_disabled" class="form-check-label">Disabled</label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            const categoryId = $('#category_id');
            const attributeContainer = $('#attribute-checkboxes');


            // Handle category change event

            categoryId.on('change', function() {
                const category_id = $(this).val();
                attributeContainer.empty().html('<p class="text-muted">Loading attributes...</p>');

                if (!category_id) {
                    // attributeContainer.empty();
                    attributeContainer.empty().html('<p class="text-muted">No attributes found...</p>');
                    return;
                }

                $.ajax({
                    url: "{{ route('getAttribute') }}",
                    type: "POST",
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status && response.data?.attributes) {
                            renderAttributes(response.data.attributes);
                        } else {
                            attributeContainer.html(
                                '<p class="text-muted">No attributes found</p>');
                        }
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message || 'An error occurred.';
                        attributeContainer.html(`<p class="text-muted">${message}</p>`);
                    }
                });
            });

            // Trigger the change event on page load if a category is pre-selected
            if (categoryId.val()) {
                categoryId.trigger('change');
            }
            if (categoryId.val() == '') {
                attributeContainer.empty().html('<p class="text-muted">No attributes found...</p>');
                return;
            }


            // Function to render attributes from the AJAX response

            function renderAttributes(attributes) {
                attributeContainer.empty();

                if (!attributes || attributes.length === 0) {
                    attributeContainer.html('<p class="text-muted">No attributes found</p>');
                    return;
                }





                const usedAttributes = new Set();

                attributes.forEach(attrData => {
                    const attribute = attrData.attribute;

                    // Check if the attribute has values and hasn't been used yet
                    if (!attribute || !attribute.values || attribute.values.length === 0 || usedAttributes
                        .has(attribute.name)) {
                        return;
                    }

                    usedAttributes.add(attribute.name);

                    // Create a section for the attribute
                    const section = $('<div>', {
                        class: 'mb-3'
                    });

                    section.append($('<strong>').text(attribute.name));

                    const usedValues = new Set();

                    attribute.values.forEach(valData => {
                        const attributeValue = valData.attribute_value;

                        if (!attributeValue || usedValues.has(attributeValue)) {
                            attributeContainer.html(
                                '<p class="text-muted">No attribute value found</p>');
                            return;
                        }
                        usedValues.add(attributeValue);

                        // Create the checkbox and label
                        const wrapper = $('<div>', {
                            class: 'form-check ms-3'
                        });
                        const checkbox = $('<input>', {
                            type: 'checkbox',
                            class: 'form-check-input',
                            name: 'attribute_value_id[]',
                            id: `attr_${valData.id}`,
                            value: valData.id
                        });
                        const label = $('<label>', {
                            class: 'form-check-label',
                            for: `attr_${valData.id}`,
                            text: attributeValue
                        });

                        wrapper.append(checkbox, label);
                        section.append(wrapper);
                    });

                    attributeContainer.append(section);
                });
            }


        });
    </script>

    <script>
        $(document).ready(function() {
            const productType = $('#product_type');



            function toggleTabs(value) {
                $('#productTabs .nav-link').removeClass('active');
                $('#productTabsContent .tab-pane').removeClass('show active');

                if (value === 'simple') {

                    $('#general-tab').addClass('active');
                    $('#general').addClass('show active');

                    $('#general-tab').show();
                    $('#inventory-tab').show();
                    $('#shipping-tab').show();

                    // valiation tab hide;
                    $('#valiation-tab').hide();
                } else {
                    $('#valiation-tab').addClass('active');
                    $('#valiation').addClass('show active');

                    $('#general-tab').hide();
                    $('#inventory-tab').hide();
                    $('#shipping-tab').hide();

                    // valiation tab show;
                    $('#valiation-tab').show();
                }
            }
            if (productType.length) {
                // Check initial value on page load

                toggleTabs(productType.val());


                productType.on('change', function() {
                    toggleTabs($(this).val());
                });
            }
        });
    </script>

    <script>
        $(document).on('click', '.generate-sku-btn', function() {
            const input = $(this).siblings('input[type="text"]');
            let prefix = 'SKU-';
            let random = Math.random().toString(36).substring(2, 2 + 6).toUpperCase();
            let sku = `${prefix}${random}`;
            input.val(sku);
        });
    </script>

    <script>
        // manageStock
        $(document).ready(function() {
            const manageStock = $('#manageStock');
            const quantityContainer = $('#quantity-container');
            const manageStockContainer = $('#manageStock-container');
            const stockStatus = $('#stock_status');

            function toggleManageStockVisibility() {
                if (stockStatus.val() === 'out_of_stock') {
                    manageStockContainer.hide();
                    quantityContainer.hide();
                } else {
                    manageStockContainer.show();

                    toggleQuantityVisibility();
                }
            }

            function toggleQuantityVisibility() {
                if (manageStock.is(':checked')) {
                    quantityContainer.show();
                } else {
                    quantityContainer.hide();
                }
            }

            toggleManageStockVisibility();

            stockStatus.on('change', function() {
                toggleManageStockVisibility();
            });

            manageStock.on('change', function() {
                toggleQuantityVisibility();
            });
        });
    </script>



    <script>
        const colorInput = document.getElementById('color');

        const pickr = Pickr.create({
            el: '.pickr',
            theme: 'classic',
            default: colorInput.value || '#000000',
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        // When user saves a color
        pickr.on('save', (color, instance) => {
            if (color) {
                colorInput.value = color.toHEXA().toString(0);
            }
            instance.hide();
        });
    </script>




    {{-- ----------------- --}}


    <script>
        function previewImageMult(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = $('.image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // This function clones the whole card and resets the inputs.
        function cloneAndAppendVariation() {
            const variationsContainer = $('#var-container');
            const variationTemplate = variationsContainer.find('#var-content').first();
            const newVariation = variationTemplate.clone(true, true);

            // Clear input values in the new variation
            newVariation.find('input, select').val('');
            newVariation.find('#img-preview').attr('src', 'https://placehold.co/100x100/E5E7EB/4B5563?text=Upload');

            // Append the new variation to the container
            variationsContainer.append(newVariation);

            // Ensure only the last card has the "Add New" button visible
            $('#add-new-variation').hide();
            newVariation.find('#add-new-variation').show();
        }

        // This function removes the parent card of the clicked element.

        function removeVariation(button) {
            const card = $(button).closest('.card');
            if ($('#var-container .card').length > 1) {
                card.remove();
                // After removal, ensure the "Add New" button is visible on the new last card
                $('#var-container .card').last().find('#add-new-variation').show();
            } else {
                showMessage('You must have at least one variation.');
            }
        }

        // Document ready function

        $(document).ready(function() {
            // Event listener for adding a new variation
            $(document).on('click', '#add-new-variation', function() {
                cloneAndAppendVariation();
            });

            // Event listener for removing a variation using event delegation
            $(document).on('click', '#remove-variation', function() {
                removeVariation(this);
            });

            // Ensure only the last card has the "Add New" button visible on load

            $('#add-new-variation').hide();
            $('#var-container').last().find('#add-new-variation').show();
        });
    </script>
@endsection
