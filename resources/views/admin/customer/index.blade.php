@extends('admin.layouts.app')
@section('title')
    Customers
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row no-gutters -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left">All Customers
                        </h3>
                        @can('create-customer')
                            <button type="button" data-toggle="modal" data-target="#createCustomerModal"
                                    class="btn btn-primary float-right btn-sm"><i
                                    class="fa fa-plus"></i> Add New
                            </button>
                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="customersDataTable"
                               class="table table-bordered table-striped dataTable dtr-inline text-center">
                            <thead style="width: 100% !important;">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Area</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile_number}}</td>
                                    <td>{{$user->area ? $user->area->name : ''}}</td>
                                    <td>{{$user->package ? $user->package->name .' ' . $user->package->value : ''}}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           @can('status-change-customer')
                                           onclick="statusChange('{{$user->id}}')"
                                           @endcan
                                           data-href="{{route('customers.status.update', $user->id)}}"
                                           data-toggle="tooltip"
                                           title="@lang('trans.change_status')"
                                           id="customerStatus-{{$user->id}}"
                                        >
                                            <span
                                                class="badge {{$user->status == 1 ? 'badge-success' : 'badge-danger'}}">
                                            {{$user->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        @can('show-customer')
                                            {{--                                            <a href="{{route('users.show', $user->id)}}" class="btn btn-sm btn-info"><i class="fa fa-search-plus"></i></a>--}}
                                            <button type="button" class="btn btn-sm btn-info"
                                                    onclick="openShowCustomerModal({{$user->id}})"><i
                                                    class="fa fa-search-plus"></i>
                                            </button>
                                        @endcan
                                        @can('update-customer')
                                            {{--                                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>--}}
                                            <button onclick="openEditCustomerModal({{$user->id}})" type="button"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
                                        @endcan
                                        @can('delete-customer')
                                            {{Form::open(['route'=>['customers.destroy', $user->id], 'method'=>'DELETE', 'id' => "deleteForm-$user->id", 'class' => 'd-inline'])}}
                                            <button type="button" onclick="deleteBtn('{{$user->id}}')"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            {{Form::close()}}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="showCustomerModal" tabindex="-1" aria-labelledby="showCustomerModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showCustomerModalLabel">Customer Show</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>First Name:</th>
                                <td id="showCustomerFirstName"></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td id="showCustomerLastName"></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td id="showCustomerPhone"></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="showCustomerEmail"></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td id="showCustomerAddress"></td>
                            </tr>
                            <tr>
                                <th>Area:</th>
                                <td id="showCustomerArea"></td>
                            </tr>
                            <tr>
                                <th>Package:</th>
                                <td id="showCustomerPackage"></td>
                            </tr>
                            <tr>
                                <th>Avatar:</th>
                                <td><img src="" id="showCustomerAvatar" alt="Customer image"
                                         class="profile-user-img img-fluid img-circle"></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td id="showCustomerStatus"></td>
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

        <div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="loadingDiv">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCustomerModalLabel">Create Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{Form::open(['route' => 'customers.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'customerCreateForm',])}}
                        <div class="modal-body">
                            <!-- text input -->
                            <div class="form-group row no-gutters">
                                <label for="first_name" class="col-sm-3 col-form-label mandatory">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{old('first_name')}}" id="first_name" placeholder="Enter first name">
                                    <span
                                        class="text-danger">{{$errors->has('first_name') ? $errors->first('first_name') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{old('last_name')}}" id="last_name" placeholder="Enter last name">
                                    <span
                                        class="text-danger">{{$errors->has('last_name') ? $errors->first('last_name') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{old('phone')}}" id="phone" placeholder="Enter phone number">
                                    <span
                                        class="text-danger">{{$errors->has('phone') ? $errors->first('phone') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{old('email')}}" id="email" placeholder="Enter email address">
                                    <span
                                        class="text-danger">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="address" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="address" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="area_id" class="col-sm-3 col-form-label">Area</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info"
                                        name="area_id" id="area_id" style="width: 100%;">
                                        <option value="">Select Expense Type</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="package_id" class="col-sm-3 col-form-label">Package</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info"
                                        name="package_id" id="package_id" style="width: 100%;">
                                        <option value="">Select Expense Type</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="profile-avatar" class="col-sm-3 col-form-label" id="inputGroupFileAddon05">Avatar</label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input"
                                               accept="image/jpeg, image/png" id="profile-avatar"
                                               aria-describedby="inputGroupFileAddon05">
                                        <label class="custom-file-label" for="profile-avatar">Choose avatar</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" id="status" name="status" data-bootstrap-switch
                                           data-off-color="danger" data-on-color="success">
                                </div>
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

        <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="editLoadingDiv">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{Form::open(['id' => 'customerEditForm', 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal'])}}
                        <div class="modal-body">
                            <div class="form-group row no-gutters">
                                <label for="editCustomerFirstName" class="col-sm-3 col-form-label mandatory">First
                                    Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           id="editCustomerFirstName" placeholder="Enter first name">
                                    <span
                                        class="text-danger">{{$errors->has('first_name') ? $errors->first('first_name') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="editCustomerLastName" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           id="editCustomerLastName" placeholder="Enter last name">
                                    <span
                                        class="text-danger">{{$errors->has('last_name') ? $errors->first('last_name') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="editCustomerPhone" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           id="editCustomerPhone" placeholder="Enter phone number">
                                    <span
                                        class="text-danger">{{$errors->has('phone') ? $errors->first('phone') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="editCustomerEmail" class="col-sm-3 col-form-label mandatory">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror" id="editCustomerEmail"
                                           placeholder="Enter email address">
                                    <span
                                        class="text-danger">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row no-gutters">
                                <label for="editCustomerAddress" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="editCustomerAddress" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="editPackageCustomer" class="col-sm-3 col-form-label">Package</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info"
                                        name="package_id" id="editPackageCustomer" style="width: 100%;">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="editAreaCustomer" class="col-sm-3 col-form-label">Area</label>
                                <div class="col-sm-9">
                                    <select
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info"
                                        name="area_id" id="editAreaCustomer" style="width: 100%;">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row no-gutters">
                                <label for="editCustomerAvatar" class="col-sm-3 col-form-label">Avatar</label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input"
                                               accept="image/jpeg, image/png"
                                               aria-describedby="editCustomerAvatar">
                                        <label class="custom-file-label" for="editCustomerAvatar">Choose avatar</label>
                                    </div>
                                    <img src="" id="editCustomerAvatar" class="img-fluid mt-2"
                                         style="height: 80px; width: 80px;" alt="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editCustomerStatus" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="status" checked data-bootstrap-switch
                                           data-off-color="danger" data-on-color="success" id="editCustomerStatus">
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
        </div>
    </section>
@endsection

@push('script')
    <script>
        // all users in json format
        let users = @json($users);
        let packages = @json($packages);
        let areas = @json($areas);
        let user = @json(auth()->user());
        let profileImagePath = "{{imagePath()['profile']['path']}}";

        $(document).ready(function () {
            //datatable
            $("#customersDataTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [3, 6]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            // Category create form
            $('#customerCreateForm').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter a customer first name",
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
            $('#expenseTypeEditForm').validate({
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
        function openShowCustomerModal(id) {
            let user = users.find(x => x.id == id);
            console.log(user)
            // sending value to modal
            $('#showUserId').html(user.id);
            $('#showCustomerFirstName').html(user.first_name);
            $('#showCustomerLastName').html(user.last_name);
            $('#showCustomerPhone').html(user.phone);
            $('#showCustomerEmail').html(user.email);
            $('#showCustomerAddress').html(user.address);
            $('#showCustomerArea').html(user.area.name);
            $('#showCustomerPackage').html(user.package.name);

            if (user.avatar) {
                $('#showCustomerAvatar').attr('src', app_url + '/' + profileImagePath + '/' + user.avatar);
            } else {
                $('#showCustomerAvatar').attr('src', app_url + '/' + profileImagePath + '/' + 'default-profile.png');
            }


            $('#showCustomerStatus').html("");
            if (user.status == 1) {
                $('#showCustomerStatus').append("<span class='badge badge-success'>Active</span>");
            } else {
                $('#showCustomerStatus').append("<span class='badge badge-danger'>Inactive</span>");
            }

            // $('#showUserRoles').html('');
            // $.each(user.roles, function (index, value) {
            //     $('#showUserRoles').append(
            //         // (index++ ? ', ' : '') +
            //         "<span class='badge badge-success'>" + value.name + "</span> ");
            // });
            // $('#showUserCreatedAt').html(user.created_at);

            // Open modal
            $('#showCustomerModal').modal('show');
        }

        function openEditCustomerModal(id) {
            // Find user
            let user = users.find(x => x.id == id);
            $('#customerEditForm').attr('action', app_url + '/customers/' + user.id);

            // sending value to modal
            $('#editCustomerFirstName').val(user.first_name);
            $('#editCustomerLastName').val(user.last_name);
            $('#editCustomerPhone').val(user.phone);
            $('#editCustomerEmail').val(user.email);
            $('#editCustomerAddress').html(user.address);

            // Set update row value
            $("#editPackageCustomer").empty();
            $.each(packages, function (index, package) {
                $('#editPackageCustomer').append(`<option value="` + package.id + `">` + package.name + `</option>`)
            });
            $('#editPackageCustomer option[value=' + user.package_id + ']').attr("selected", "selected");

            // Set update row value
            $("#editAreaCustomer").empty();
            $.each(areas, function (index, area) {
                $('#editAreaCustomer').append(`<option value="` + area.id + `">` + area.name + `</option>`)
            });
            $('#editAreaCustomer option[value=' + user.area_id + ']').attr("selected", "selected");



            if (user.avatar) {
                $('#editCustomerAvatar').attr('src', app_url + '/' + profileImagePath + '/' + user.avatar);
            } else {
                $('#editCustomerAvatar').attr('src', app_url + '/' + profileImagePath + '/' + 'default-profile.png');
            }

            user.status == 1 ? $('#editCustomerStatus').bootstrapSwitch('state', user.status, true) : $('#editCustomerStatus').bootstrapSwitch('state', user.status, false);


            // Open modal
            $('#editCustomerModal').modal('show');
        }


        // Delete Service
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

        function statusChange(id) {
            Swal.fire({
                title: 'Are you sure to change?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $('#customerStatus-' + id).data('href');
                }
            });
        }
    </script>
@endpush


