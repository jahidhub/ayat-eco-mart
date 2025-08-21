@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Size</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product Size</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#size_model"
                        onclick="saveData('0', '', 'Add Product Size' )">Add New
                        Size</button>

                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            <div class="row mb-4">
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table" class="table table-hover table-bordered align-middle"
                                        style="width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Size</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sizes as $size)
                                                <tr>
                                                    <td class="text-center fw-semibold text-dark">{{ $size->size }}</td>

                                                    <td class="text-center">
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- Edit Button -->

                                                            <button
                                                                onclick="saveData('{{ $size->id }}','{{ $size->size }}', 'Edit Product Size')"
                                                                class="btn btn-sm btn-outline-dark" title="Edit"
                                                                data-bs-toggle="modal" data-bs-target="#size_model">
                                                                <i class="lni lni-pencil-alt"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <button onclick="deleteData('{{ $size->id }}' , 'sizes' )"
                                                                class="btn btn-sm btn-outline-dark" title="Delete">
                                                                <i class="lni lni-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr class="no-items text-center">
                                                        <td class="py-4 colspanchange" colspan="2">Not found.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                            Showing {{ $sizes->firstItem() }} to {{ $sizes->lastItem() }} of
                                            {{ $sizes->total() }} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end"
                                            id="example_paginate">
                                            {{ $sizes->links() }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Model Popup --}}

                <div class="modal fade" id="size_model" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal Body with Form -->
                            <form id="form_submit" action="{{ route('admin.products.size.store') }}"
                                enctype="multipart/form-data">


                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="mb-3">
                                        <label for="size" class="form-label fw-semibold">Product Size</label>
                                        <input type="text" id="size" name="size"
                                            class="form-control form-control-lg" placeholder="e.g. S, M, L, XL"
                                            aria-label="Product Size">
                                        <div class="invalid-feedback">
                                            Please enter a product size.
                                        </div>
                                    </div>

                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <div id="submitButtonWrapper">
                                        <button type="submit" id="submitButton" class="btn btn-primary px-4">Save
                                            Changes</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection

@section('customJs')
    <script>
        function saveData(id, size_name, title) {
            $('#id').val(id);
            $('#size').val(size_name);
            $('#modal-title').text(title);
        }

        document.getElementById('size').addEventListener('input', function() {
            this.classList.toggle('is-invalid', !this.value.trim());
        });
    </script>
@endsection
