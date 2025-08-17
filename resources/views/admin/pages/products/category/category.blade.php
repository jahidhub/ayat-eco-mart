@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Categories</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage categories</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                        data-bs-target="#category_model" onclick="saveData('0', '', '', 'Add Category' )">Add New
                        category</button>

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
                                    <table id="example" class="table table-hover table-bordered align-middle"
                                        style="width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $data)
                                                <tr>
                                                    <td class="text-center fw-semibold text-dark">{{ $data->name }}
                                                    </td>
                                                    <td class="text-center fw-semibold text-dark">
                                                        {{ $data->slug }}
                                                    </td>
                                                    <td class="text-center fw-semibold text-dark">
                                                        {{ $data->image }}
                                                    </td>
                                                    <td class="text-center fw-semibold text-dark">
                                                        {{ $data->parent_category_id }}
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- Edit Button -->
                                                            <button
                                                                onclick="saveData('{{ $data->id }}','{{ $data->name }}',
                                                                '{{ $data->slug }}', 
                                                                '{{ $data->image }}',
                                                                '{{ $data->parent_category_id }}',
                                                                'Edit Product Category')"
                                                                class="btn btn-sm btn-outline-dark" title="Edit"
                                                                data-bs-toggle="modal" data-bs-target="#category_model">
                                                                <i class="lni lni-pencil-alt"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <button
                                                                onclick="deleteData('{{ $data->id }}' , 'categories' )"
                                                                class="btn btn-sm btn-outline-dark" title="Delete">
                                                                <i class="lni lni-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                                        {{ $categories->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end"
                                        id="example_paginate">
                                        {{ $categories->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Model Popup --}}

            <div class="modal fade" id="attribute_model" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body with Form -->
                        <form id="form_submit" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Category Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-lg" placeholder="e.g. Brand"
                                        aria-label="Product Attribute">
                                    <div class="invalid-feedback">
                                        Please enter a Category name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label fw-semibold">Category Slug</label>
                                    <input type="text" id="slug" name="slug"
                                        class="form-control form-control-lg" placeholder="e.g. brand"
                                        aria-label="Attribute Slug">
                                    <div class="invalid-feedback">
                                        Please enter a Category slug.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label fw-semibold">Category image</label>
                                    <input type="file" id="image" name="image"
                                        class="form-control form-control-lg" aria-label="image">
                                    <div class="invalid-feedback">
                                        Please enter a Category image.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="parent_cat" class="form-label fw-semibold">Parent Category</label>
                                    <select name="parent_cat" id="parent_cat">

                                        <option value="1">1</option>


                                    </select>
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
        function saveData(id, name, slug, image, parent_category, title) {
            $('#id').val(id);
            $('#name').val(name);
            $('#slug').val(slug);
            $('#image').val(image);
            $('#parent_cat').val(parent_category);
            $('#modal-title').text(title);
        }

        document.getElementById('name').addEventListener('input', function() {
            this.classList.toggle('is-invalid', !this.value.trim());
        });
    </script>
@endsection
