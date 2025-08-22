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
            <form id="#form_submit" action="{{ route('admin.product.store') }}" method="post"
                enctype="multipart/form-data">
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
                            <div class="card-header bg-light fw-bold">Product Data</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <!-- Vertical Nav Tabs -->
                                        <div class="nav flex-column nav-pills" id="productTabs" role="tablist"
                                            aria-orientation="vertical">
                                            <button class="nav-link active text-start" id="general-tab" data-bs-toggle="pill"
                                                data-bs-target="#general" type="button" role="tab">General</button>
                                            <button class="nav-link text-start" id="inventory-tab" data-bs-toggle="pill"
                                                data-bs-target="#inventory" type="button" role="tab">Inventory</button>
                                            <button class="nav-link text-start" id="shipping-tab" data-bs-toggle="pill"
                                                data-bs-target="#shipping" type="button" role="tab">Shipping</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-10">
                                        <!-- Vertical Tab Content -->
                                        <div class="tab-content bg-light p-3" id="productTabsContent">
                                            <!-- General Tab -->
                                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                                aria-labelledby="general-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">Regular Price</label>
                                                    <input type="number" id="mrp" name="mrp" class="form-control"
                                                        placeholder="0.00">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Sale Price</label>
                                                    <input type="number" id="price" name="price" class="form-control"
                                                        placeholder="0.00">
                                                </div>
                                            </div>

                                            <!-- Inventory Tab -->
                                            <div class="tab-pane fade" id="inventory" role="tabpanel"
                                                aria-labelledby="inventory-tab">
                                                <div class="mb-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" id="sku" name="sku"
                                                        class="form-control" placeholder="ABC123">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stock Quantity</label>
                                                    <input type="number" id="qty" name="qty"
                                                        class="form-control" placeholder="10">
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="manageStock">
                                                    <label class="form-check-label" for="manageStock">Manage
                                                        stock?</label>
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

                            <div class="position-relative rounded overflow-hidden shadow-sm" style="height: 200px;">
                                <label for="new_image" class="w-100 h-100 m-0" style="cursor: pointer;">
                                    <img id="img_preview" src="{{ asset('admin/assets/images/image-upload.png') }}"
                                        alt="Click to upload"
                                        class="img-fluid w-100 h-100 object-fit-contain border rounded">
                                </label>

                                <input type="file" id="new_image" name="new_image" class="form-control d-none"
                                    onchange="previewImage(event)">
                            </div>

                            <small class="text-muted d-block mt-2">
                                Click on the image to upload. Max size: 5MB. Formats: JPG, PNG, WEBP.
                            </small>
                        </div>

                        <!-- Categories -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Categories</div>
                            <div class="card-body">

                                <select name="category" id="category" class="form-control">

                                    <option value="">Selete category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="card-header fw-bold">Category related attributes</div>
                            <div class="card-body">

                                {{-- <select name="attributes" id="attributes" class="form-control multicheck" multiple>
                                </select> --}}

                                <div id="attribute-checkboxes" class="form-control"
                                    style="height:auto; min-height:50px; overflow-y:auto;">

                                </div>

                            </div>
                        </div>

                        <!-- Brands -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Brands</div>
                            <div class="card-body">
                                <select name="category" id="category" class="form-control">

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

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#category').change(function() {

                var url = "{{ route('getAttribute') }}";
                var category_id = $(this).val();
                console.log(category_id);
                var container = $('#attribute-checkboxes');
                container.empty();
                if (!category_id) return;



                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == true) {

                            // console.log(response.data);

                            if (response.data.attributes) {
                                var
                                    usedAttributes = {};
                                $.each(response.data.attributes, function(key, value) {
                                    var attribute = value.attribute;
                                    if (!attribute || !attribute.values) return;

                                    // Skip if attribute already added
                                    if (usedAttributes[attribute.name]) return;
                                    usedAttributes[attribute.name] = true;

                                    // Attribute title
                                    var section = $('<div>').css('margin-bottom',
                                        '10px');
                                    var title = $('<strong>').text(attribute.name);
                                    section.append(title);

                                    // Track used values to prevent duplicate checkboxes
                                    var usedValues = {};

                                    $.each(attribute.values, function(i, val) {
                                        if (usedValues[val.attribute_value])
                                            return;
                                        usedValues[val.attribute_value] = true;

                                        var wrapper = $('<div>').css(
                                            'margin-left',
                                            '15px');
                                        var checkbox = $('<input>', {
                                            type: 'checkbox',
                                            name: 'attributes[]',
                                            id: 'attr_' + val.id,
                                            value: val.id
                                        });
                                        var label = $('<label>', {
                                            for: 'attr_' + val.id,
                                            text: ' ' + val
                                                .attribute_value,
                                            style: 'margin-left:5px;'
                                        });
                                        wrapper.append(checkbox).append(label);
                                        section.append(wrapper);
                                    });
                                    container.append(section);
                                });
                            } else {

                                container.html('<p>No attributes found</p>');
                            }

                        } else {
                            container.html('<p>No attributes found</p>');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });

        });
    </script>
@endsection
