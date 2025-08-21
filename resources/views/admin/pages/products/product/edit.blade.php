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
            <form id="product_submit" action="{{ route('admin.product.update') }}" method="post"
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
                                        placeholder="Enter product name" value="{{ $product->name }}">
                                </div>

                                <!-- Slug -->
                                <div class="mb-0">
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('/') }}
                                        </span>
                                        <input name="slug" id="slug" type="text" class="form-control"
                                            placeholder="slug" value="{{ $product->slug }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Description -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" id="description" rows="6" class="form-control"
                                    placeholder="Enter product description">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <!-- Product Data Tabs -->
                        <div class="card">
                            <div class="card-header bg-light fw-bold">Product Data</div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general"
                                            type="button">General</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#inventory"
                                            type="button">Inventory</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping"
                                            type="button">Shipping</button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3">

                                    <!-- General Tab -->
                                    <div class="tab-pane fade show active" id="general">
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
                                    <div class="tab-pane fade" id="inventory">
                                        <div class="mb-3">
                                            <label class="form-label">SKU</label>
                                            <input type="text" id="sku" name="sku" class="form-control"
                                                placeholder="ABC123">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock Quantity</label>
                                            <input type="number" id="qty" name="qty" class="form-control"
                                                placeholder="10">
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="manageStock">
                                            <label class="form-check-label" for="manageStock">Manage stock?</label>
                                        </div>
                                    </div>

                                    <!-- Shipping Tab -->
                                    <div class="tab-pane fade" id="shipping">
                                        <div class="mb-3">
                                            <label class="form-label">Weight (kg)</label>
                                            <input type="number" id="weight" name="weight" class="form-control"
                                                step="0.01" placeholder="0.00">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Dimensions (L × W × H)</label>
                                            <div class="d-flex gap-2">
                                                <input type="number" id="length" name="length" class="form-control"
                                                    placeholder="Length">
                                                <input type="number" id="width" name="width" class="form-control"
                                                    placeholder="Width">
                                                <input type="number" id="height" name="height" class="form-control"
                                                    placeholder="Height">
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
                            <div class="card-body">
                                <button type="submit" id="savebutton" class="btn btn-primary w-100">Publish</button>
                            </div>
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cat1">
                                    <label class="form-check-label" for="cat1">Category One</label>
                                </div>

                            </div>
                        </div>

                        <!-- Brands -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Brands</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brnd1">
                                    <label class="form-check-label" for="brnd1">Brands One</label>
                                </div>

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
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            $('#product_submit').on('submit', function(e) {

                var form_data = new FormData(this);
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status === true) {
                            Toast.fire({
                                icon: "success",
                                title: response.message
                            });

                        } else {
                            Toast.fire({
                                icon: "error",
                                title: response.message
                            });
                        }

                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let message = 'An unexpected error occurred.';
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.errors) {
                                const firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                message = firstError;
                            }
                        }

                        Toast.fire({
                            icon: "error",
                            title: message
                        });
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function previewImage(e) {
            const preview = document.getElementById('img_preview');
            const file = e.target.files[0];
            if (!file) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type))
                return alert('Only JPG, PNG, WEBP formats are allowed.');

            if (file.size > 2 * 1024 * 1024)
                return alert('Max file size is 2MB.');

            preview.src = URL.createObjectURL(file);
        }
    </script>

    <script>
        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .replace(/\s+/g, '-') // spaces to dashes
                .replace(/-+/g, '-'); // collapse multiple dashes
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
