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
            <form>
                <div class="row">
                    <div class="col-lg-8">

                        <!-- Product Title -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input name="name" type="text" class="form-control"
                                        placeholder="Enter product name">
                                </div>

                                <!-- Slug -->
                                <div class="mb-0">
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('/') }}
                                        </span>
                                        <input name="slug" type="text" class="form-control" placeholder="slug">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Description -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <label class="form-label fw-bold">Description</label>
                                <textarea rows="6" class="form-control" placeholder="Enter product description"></textarea>
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
                                            <input type="number" class="form-control" placeholder="0.00">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sale Price</label>
                                            <input type="number" class="form-control" placeholder="0.00">
                                        </div>
                                    </div>

                                    <!-- Inventory Tab -->
                                    <div class="tab-pane fade" id="inventory">
                                        <div class="mb-3">
                                            <label class="form-label">SKU</label>
                                            <input type="text" class="form-control" placeholder="ABC123">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock Quantity</label>
                                            <input type="number" class="form-control" placeholder="10">
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
                                            <input type="number" class="form-control" step="0.01" placeholder="0.00">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Dimensions (L × W × H)</label>
                                            <div class="d-flex gap-2">
                                                <input type="number" class="form-control" placeholder="Length">
                                                <input type="number" class="form-control" placeholder="Width">
                                                <input type="number" class="form-control" placeholder="Height">
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
                                <button type="button" class="btn btn-primary w-100">Publish</button>
                            </div>
                        </div>

                        <!-- Product Image -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Product Image</div>
                            <div class="card-body">
                                <input type="file" class="form-control">
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="card mb-4">
                            <div class="card-header fw-bold">Categories</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cat1">
                                    <label class="form-check-label" for="cat1">Category One</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cat2">
                                    <label class="form-check-label" for="cat2">Category Two</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cat3">
                                    <label class="form-check-label" for="cat3">Category Three</label>
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brnd2">
                                    <label class="form-check-label" for="brnd2">Brands Two</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brnd3">
                                    <label class="form-check-label" for="brnd3">Brands Three</label>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header fw-bold">Keywords</div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Enter tags, separated by commas">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('customJs')
@endsection
