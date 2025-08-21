@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Color</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Color</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#color_model"
                        onclick="saveData('0', '', '', 'Add Product Color' )">Add New
                        Color</button>

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
                                                <th>Name</th>
                                                <th>Color Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($colors as $color)
                                                <tr>
                                                    <td class="text-center fw-semibold text-dark">{{ $color->name }}</td>
                                                    <td
                                                        class="text-center fw-semibold text-dark d-flex justify-content-center">

                                                        <div class="text-center p-4"
                                                            style="background-color: {{ $color->code }}; width:100px">

                                                        </div>

                                                    </td>

                                                    <td class="text-center">
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- Edit Button -->
                                                            <button
                                                                onclick="saveData('{{ $color->id }}','{{ $color->name }}','{{ $color->code }}', 'Edit Product Color')"
                                                                class="btn btn-sm btn-outline-dark" title="Edit"
                                                                data-bs-toggle="modal" data-bs-target="#color_model">
                                                                <i class="lni lni-pencil-alt"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <button onclick="deleteData('{{ $color->id }}' , 'colors' )"
                                                                class="btn btn-sm btn-outline-dark" title="Delete">
                                                                <i class="lni lni-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="no-items text-center">
                                                    <td class="py-4 colspanchange" colspan="3">No data found</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        Showing {{ $colors->firstItem() }} to {{ $colors->lastItem() }} of
                                        {{ $colors->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end"
                                        id="example_paginate">
                                        {{ $colors->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Model Popup --}}

            <div class="modal fade" id="color_model" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body with Form -->
                        <form id="form_submit" action="{{ route('admin.manage.colors.store') }}"
                            enctype="multipart/form-data">


                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Color Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-lg" placeholder="e.g. red, green , yellow"
                                        aria-label="Product color">
                                    <div class="invalid-feedback">
                                        Please enter a color name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="color_code" class="form-label fw-semibold">Color Hex Code</label>
                                    <input type="text" id="color_code" name="color_code"
                                        class="form-control form-control-lg" placeholder="e.g.red = #FF0000"
                                        aria-label="Product Hex Code">
                                    <div class="invalid-feedback">
                                        Please enter a color Hex code.
                                    </div>
                                </div>
                                <div id="color-box" class="p-4"></div>


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
        function saveData(id, color_name, code, title) {
            $('#id').val(id);
            $('#name').val(color_name);
            $('#color_code').val(code);
            $('#color-box').css('background-color', code);
            $('#modal-title').text(title);
        }


        document.getElementById('color').addEventListener('input', function() {
            this.classList.toggle('is-invalid', !this.value.trim());
        });
    </script>
@endsection
