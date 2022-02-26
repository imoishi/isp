@extends('admin.layouts.app')
@section('title')
    Packages
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Packages</li>
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
                        <h3 class="card-title float-left">All Packages
                        </h3>
                        @can('create-package')
                        <button type="button"
                                data-toggle="modal"
                                data-target="#createPackageModal"
                                class="btn btn-info float-right btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="PackagesTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 30%">Description</th>
                                <th style="width: 10%">Price</th>
                                <th style="width: 10%">value</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$package->name}}</td>
                                    <td>{{$package->description}}</td>
                                    <td>{{$package->price}}</td>
                                    <td>{{$package->value}}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           @can('status-change-package')
                                           onclick="packageStatusChange('{{$package->id}}')"
                                           @endcan
                                           data-href="{{route('packages.status.update', $package->id)}}"
                                           data-toggle="tooltip"
                                           title="@lang('trans.change_status')"
                                           id="packageStatus-{{$package->id}}"
                                        >
                                            <span
                                                class="badge {{$package->status == 1 ? 'badge-success' : 'badge-danger'}}">
                                            {{$package->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        @can('show-package')
                                        <button onclick="openShowPackageModal({{$package->id}})" type="button"
                                                class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="@lang('trans.view')"><i class="fa fa-search-plus"></i></button>
                                        @endcan
                                        @can('update-package')
                                        <button onclick="openEditPackageModal({{$package->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>
                                            @endcan
                                            @can('delete-package')
                                        {{Form::open(['route'=>['packages.destroy', $package->id], 'method'=>'DELETE', 'id' => "deleteForm-$package->id", 'class' => 'd-inline'])}}
                                        <button type="button"
{{--                                                @can('access-package')--}}
                                                onclick="deleteBtn('{{$package->id}}')"
{{--                                                @endcan--}}
                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="@lang('trans.delete')"><i class="fa fa-trash"></i></button>
                                        {{Form::close()}}
                                            @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="createPackageModal" tabindex="-1" aria-labelledby="createPackageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPackageModalLabel">Create Packages</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'packages.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'packageCreateForm'])}}
                    <div class="modal-body">
                        <div class="form-group row no-gutters">
                            <label for="name" class="col-sm-3 col-form-label mandatory">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}" id="name" placeholder="Enter package name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" rows="3" class="form-control"
                                          placeholder="Enter description / optional"></textarea>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="price" class="col-sm-3 col-form-label mandatory">Price</label>
                            <div class="col-sm-9">
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{old('price')}}" id="price" placeholder="Enter price">
                                @error('price')<span class="text-danger">{{$errors->first('price')}}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="value" class="col-sm-3 col-form-label mandatory">Value</label>
                            <div class="col-sm-9">
                                <input type="text" name="value" class="form-control @error('value') is-invalid @enderror"
                                       value="{{old('value')}}" id="value" placeholder="Enter package value">
                                @error('value')<span class="text-danger">{{$errors->first('value')}}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
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


        <div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="editPackageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPackageModalLabel">Edit Package</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['id' => 'packageEditForm', 'method' => 'PATCH', 'class' => 'form-horizontal'])}}
                    <div class="modal-body">

                        <div class="form-group row no-gutters">
                            <label for="editPackageName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="editPackageName" placeholder="Enter package name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editPackageDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="editPackageDescription" rows="3" class="form-control"
                                          placeholder="Enter description / optional"></textarea>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editPackagePrice" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       id="editPackagePrice">
                                @error('price')<span class="text-danger">{{$errors->first('price')}}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editPackageValue" class="col-sm-2 col-form-label">Value</label>
                            <div class="col-sm-10">
                                <input type="text" name="value" class="form-control @error('value') is-invalid @enderror"
                                       id="editPackageValue" placeholder="Enter package value">
                                @error('value')<span class="text-danger">{{$errors->first('value')}}</span>@enderror
                            </div>
                        </div>


                        <div class="form-group row no-gutters">
                            <label for="editPackageStatus" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="editPackageStatus" name="status" data-bootstrap-switch
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


        <div class="modal fade" id="showPackageModal" tabindex="-1" aria-labelledby="showPackageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showPackageModalLabel">Show Packages</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td id="showPackageName"></td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td id="showPackageDescription"></td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td id="showPackagePrice"></td>
                            </tr>
                            <tr>
                                <th>Value:</th>
                                <td id="showPackageValue"></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td id="showPackageStatus"></td>
                            </tr>
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
        let packages = @json($packages);

        $(document).ready(function () {
            //datatable
            $("#PackagesTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [4]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            // Category create form
            $('#packageCreateForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    value: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a package name",
                    },
                    price: {
                        required: "Please enter a package price",
                    },
                    value: {
                        required: "Please enter a package value",
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
        function openShowPackageModal(id) {
            let package = packages.find(x => x.id == id);
            // Set update row value
            $('#showPackageName').html(package.name);
            $('#showPackageDescription').html(package.description);
            $('#showPackagePrice').html(package.price);
            $('#showPackageValue').html(package.value);

            $('#showPackageStatus').html('');
            $('#showPackageStatus').append(package.status === 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>");
            // $('#showCategoryCreatedAt').html(category.created_at);

            // Open modal
            $('#showPackageModal').modal('show');
        }

        function openEditPackageModal(id) {
            let package = packages.find(x => x.id == id);

            // Set edit form action url
            $('#packageEditForm').attr('action', app_url + '/packages/' + package.id);

            // Set update row value
            $('#editPackageName').val(package.name);
            $('#editPackageDescription').val(package.description);
            $('#editPackagePrice').val(package.price);
            $('#editPackageValue').val(package.value);
            // category.status == 1 ? $('#editCategoryStatus').prop("checked", true) : $('#editCategoryStatus').prop("checked", false);
            package.status == 1 ? $('#editPackageStatus').bootstrapSwitch('state', package.status, true) : $('#editPackageStatus').bootstrapSwitch('state', package.status, false);
            ;

            // if(category.status == 1 ){
            //     $('#editCategoryStatus').prop("checked", true);
            //     // $('#editCategoryStatus').val(1);
            // }else{
            //     $('#editCategoryStatus').prop("checked", false);
            //     // $('#editCategoryStatus').val(0);
            // }


            // Open modal
            $('#editPackageModal').modal('show');

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
        function packageStatusChange(id) {
            Swal.fire({
                title: 'Are you sure to change?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $('#packageStatus-' + id).data('href');
                }
            })
        }
    </script>
@endpush
