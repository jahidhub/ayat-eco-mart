@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Banner</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Home Banner</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                        data-bs-target="#home_banner_model" onclick="saveData('0', '', '','', 'Add New Banner' )">Add New
                        Banner</button>
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-sm btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div> --}}

                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            {{-- <div class="row">
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
                                    <table id="example" class="table table-hover table-bordered align-middle"
                                        style="width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Image</th>
                                                <th>Contant</th>
                                                <th>Link</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $list)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($list->image) }}" alt="{{ $list->content }}"
                                                            width="50" height="50">
                                                    </td>
                                                    <td class="fw-semibold text-dark">{{ $list->content }}</td>
                                                    <td>
                                                        <a href="{{ $list->link }}" target="_blank"
                                                            class="text-decoration-none text-primary">
                                                            {{ $list->link }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- View Button -->
                                                            <button class="btn btn-sm btn-outline-dark" title="View">
                                                                <i class="lni lni-eye"></i>
                                                            </button>

                                                            <!-- Edit Button -->
                                                            <button
                                                                onclick="saveData('{{ $list->id }}', '{{ $list->content }}', '{{ $list->link }}','{{ $list->image }}', 'Edit Banner' )"
                                                                class="btn btn-sm btn-outline-dark" title="Edit"
                                                                data-bs-toggle="modal" data-bs-target="#home_banner_model">
                                                                <i class="lni lni-pencil-alt"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <button
                                                                onclick="deleteData('{{ $list->id }}' , 'home_banners' )"
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
                            {{-- <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="example_previous">
                                                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0"
                                                    class="page-link">Prev</a>
                                            </li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="example" data-dt-idx="1" tabindex="0"
                                                    class="page-link">1</a></li>
                                            
                                            <li class="paginate_button page-item next" id="example_next"><a
                                                    href="#" aria-controls="example" data-dt-idx="7"
                                                    tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Model Popup --}}

            <div class="modal fade" id="home_banner_model" tabindex="-1" aria-labelledby="homeBannerLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="homeBannerLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body with Form -->
                        <form id="form_submit" action="{{ route('admin.home_banner.store') }}"
                            enctype="multipart/form-data">


                            @csrf
                            <div class="modal-body">


                                <input type="hidden" name="id" id="id">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <input type="text" id="content" name="content" class="form-control"
                                        placeholder="Enter your content">
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="text" id="link" name="link" class="form-control"
                                        placeholder="Enter your link">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">Banner Image</label>

                                    <div class="position-relative rounded overflow-hidden shadow-sm" style="height: 200px;">
                                        <label for="new_image" class="w-100 h-100 m-0" style="cursor: pointer;">
                                            <img id="img_preview" src="{{ asset('admin/assets/images/image-upload.png') }}"
                                                alt="Click to upload"
                                                class="img-fluid w-100 h-100 object-fit-contain border rounded">
                                        </label>

                                        <input type="file" id="new_image" name="new_image"
                                            class="form-control d-none" onchange="previewImage(event)">
                                    </div>

                                    <small class="text-muted d-block mt-2">
                                        Click on the image to upload. Max size: 2MB. Formats: JPG, PNG, WEBP.
                                    </small>
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
        function saveData(id, content, link, image, title) {
            $('#id').val(id);
            $('#content').val(content);
            $('#link').val(link);
            $('#homeBannerLabel').text(title);

            const defaultImage = "{{ asset('admin/assets/images/image-upload.png') }}";
            const imagePath = image ? "{{ asset('') }}/" + image : defaultImage;

            document.getElementById('img_preview').src = imagePath;
        }
    </script>
@endsection
