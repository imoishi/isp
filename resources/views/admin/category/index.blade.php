@extends('admin.layouts.app')
@section('title')
    Categories
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title float-left">All Categories
                        </h3>
                        <button type="button"
                                data-toggle="modal"
                                data-target="#createCategoryModal"
                                class="btn btn-info float-right btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                    <div class="card-body">
                        {{--                        <table id="categoriesTable" class="table table-bordered table-striped dataTable dtr-inline text-center">--}}
                        <table id="categoriesTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Name</th>
                                <th style="width: 45%">Description</th>
                                <th style="width: 5%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           @can('access-category')
                                           onclick="categoryStatusChange('{{$category->id}}')"
                                           @endcan
                                           data-href="{{route('categories.status.update', $category->id)}}"
                                           data-toggle="tooltip"
                                           title="@lang('trans.change_status')"
                                           id="categoryStatus-{{$category->id}}"
                                        >
                                            <span
                                                class="badge {{$category->status == 1 ? 'badge-success' : 'badge-danger'}}">
                                            {{$category->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        <button onclick="openShowCategoryModal({{$category->id}})" type="button"
                                                class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="@lang('trans.view')"><i class="fa fa-search-plus"></i></button>
                                        <button onclick="openEditCategoryModal({{$category->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>

                                        {{Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'DELETE', 'id' => "deleteForm-$category->id", 'class' => 'd-inline'])}}
                                        <button type="button"
                                                @can('access-category')
                                                onclick="deleteBtn('{{$category->id}}')"
                                                @endcan
                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="@lang('trans.delete')"><i class="fa fa-trash"></i></button>
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Name</th>
                                <th style="width: 40%">Description</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryModalLabel">Create categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'categories.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'categoryCreateForm'])}}
                    <div class="modal-body">
                        <div class="form-group row no-gutters">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}" id="name" placeholder="Enter category name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" rows="3" class="form-control"
                                          placeholder="Enter description / optional"></textarea>
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="status" checked name="status" data-bootstrap-switch
                                       data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-info">Create</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['id' => 'categoryEditForm', 'method' => 'PATCH', 'class' => 'form-horizontal'])}}
                    <div class="modal-body">
                        <div class="form-group row no-gutters">
                            <label for="editCategoryName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="editCategoryName" placeholder="Enter category name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="editCategoryDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="editCategoryDescription" rows="3" class="form-control"
                                          placeholder="Enter description / optional"></textarea>
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="editCategoryStatus" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="editCategoryStatus" name="status" data-bootstrap-switch
                                       data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info">Update</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <div class="modal fade" id="showCategoryModal" tabindex="-1" aria-labelledby="showCategoryModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showCategoryModalLabel">Show categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td id="showCategoryName"></td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td id="showCategoryDescription"></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td id="showCategoryStatus"></td>
                            </tr>
                            {{--                            <tr>--}}
                            {{--                                <th>Creation Date:</th>--}}
                            {{--                                <td id="showCategoryCreatedAt"></td>--}}
                            {{--                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // all categories in json format
        let categories = @json($categories);

        $(document).ready(function () {
            //datatable
            $("#categoriesTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [4]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            // Category create form
            $('#categoryCreateForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a category name",
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Category create form
            $('#categoryEditForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a category name",
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        // Functions
        function openShowCategoryModal(id) {
            let category = categories.find(x => x.id == id);
            // Set update row value
            $('#showCategoryName').html(category.name);
            $('#showCategoryDescription').html(category.description);
            // $('#showCategoryStatus').html(category.status === 1 ? 'Actice' : 'Inactive');
            // const status = category.status === 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge danger'>Inactive</span>"
            $('#showCategoryStatus').html('');
            $('#showCategoryStatus').append(category.status === 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>");
            // $('#showCategoryCreatedAt').html(category.created_at);

            // Open modal
            $('#showCategoryModal').modal('show');
        }

        function openEditCategoryModal(id) {
            let category = categories.find(x => x.id == id);

            // Set edit form action url
            $('#categoryEditForm').attr('action', app_url + '/categories/' + category.id);

            // Set update row value
            $('#editCategoryName').val(category.name);
            $('#editCategoryDescription').val(category.description);
            // category.status == 1 ? $('#editCategoryStatus').prop("checked", true) : $('#editCategoryStatus').prop("checked", false);
            category.status == 1 ? $('#editCategoryStatus').bootstrapSwitch('state', category.status, true) : $('#editCategoryStatus').bootstrapSwitch('state', category.status, false);
            ;

            // if(category.status == 1 ){
            //     $('#editCategoryStatus').prop("checked", true);
            //     // $('#editCategoryStatus').val(1);
            // }else{
            //     $('#editCategoryStatus').prop("checked", false);
            //     // $('#editCategoryStatus').val(0);
            // }


            // Open modal
            $('#editCategoryModal').modal('show');

        }

        // Delete Category
        function deleteBtn(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#deleteForm-' + id).submit();
                }
            })
        }

        // Category Status Change
        function categoryStatusChange(id) {
            Swal.fire({
                title: 'Are you sure to change?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $('#categoryStatus-' + id).data('href');
                }
            })
        }
    </script>
@endpush
