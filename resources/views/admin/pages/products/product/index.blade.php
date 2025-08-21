@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-dark">Add New
                        Product</a>

                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            {{-- <div class="row mb-4">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="example_length"><label>Show <select
                                                name="example_length" aria-controls="example"
                                                class="form-select form-select-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                class="form-control form-control-sm" placeholder=""
                                                aria-controls="example"></label></div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table" class="table table-hover table-bordered align-middle"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="manage-column column-cb check-column"><input
                                                        type="checkbox">
                                                </th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Brand</th>

                                                <th scope="col">Stock</th>
                                            </tr>
                                        </thead>

                                        <tbody id="the-list">
                                            @forelse ($products as $product)
                                                <tr>
                                                    <th scope="row" class="check-column">
                                                        <input type="checkbox" name="product[]" value="{{ $product->id }}">
                                                    </th>
                                                    <td class="title column-title has-row-actions">
                                                        <strong>
                                                            <a href="">{{ $product->name }}</a>
                                                        </strong>
                                                        <div class="row-actions">
                                                            <span class="edit">
                                                                <a href="{{ route('admin.product.edit', $product->id) }}">Edit</a>
                                                                |
                                                            </span>
                                                            <span class="view">
                                                                <a href="" target="_blank">View</a> |
                                                            </span>
                                                            <span class="delete">
                                                                <a href="javascript:;"
                                                                    onclick="deleteData('{{ $product->id }}','products')">Delete</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center fw-semibold text-dark" style="width:200px;">
                                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                            class="img-fluid w-25 h-25">
                                                    </td>
                                                    {{-- <td>£price</td>
                                                    <td>category->name</td>
                                                    <td>brand->name</td>

                                                    <td>stock_qty</td> --}}
                                                </tr>
                                            @empty
                                                <tr class="no-items text-center">
                                                    <td class="py-4 colspanchange" colspan="">No data found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                        {{ $products->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end"
                                        id="example_paginate">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('customJs')
@endsection
