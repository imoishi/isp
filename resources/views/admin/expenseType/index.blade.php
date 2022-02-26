@extends('admin.layouts.app')
@section('title')
    ExpenseType
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Expense Types</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expense Types</li>
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
                        <h3 class="card-title float-left">All Expense Types
                        </h3>
                        <button type="button"
                                data-toggle="modal"
                                data-target="#createExpenseTypeModal"
                                class="btn btn-info float-right btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                    <div class="card-body">
                        {{--                        <table id="categoriesTable" class="table table-bordered table-striped dataTable dtr-inline text-center">--}}
                        <table id="ExpenseTypesTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 40%">Name</th>
                                <th style="width: 30%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($expenseTypes as $expenseType)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$expenseType->name}}</td>
                                    <td>
                                        <a href="javascript:void(0)"
{{--                                                                                      @can('access-package')--}}
                                           onclick="expenseTypeStatusChange('{{$expenseType->id}}')"
{{--                                                                                      @endcan--}}
                                           data-href="{{route('expenseTypes.status.update', $expenseType->id)}}"
                                           data-toggle="tooltip"
                                           title="@lang('trans.change_status')"
                                           id="expenseTypeStatus-{{$expenseType->id}}"
                                        >
                                            <span
                                                class="badge {{$expenseType->status == 1 ? 'badge-success' : 'badge-danger'}}">
                                            {{$expenseType->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        <button onclick="openShowExpenseTypeModal({{$expenseType->id}})" type="button"
                                                class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="@lang('trans.view')"><i class="fa fa-search-plus"></i></button>
                                        <button onclick="openEditExpenseTypeModal({{$expenseType->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>

                                        {{Form::open(['route'=>['expenseTypes.destroy', $expenseType->id], 'method'=>'DELETE', 'id' => "deleteForm-$expenseType->id", 'class' => 'd-inline'])}}
                                        <button type="button"
{{--                                                                                                @can('access-package')--}}
                                                onclick="deleteBtn('{{$expenseType->id}}')"
{{--                                                                                                @endcan--}}
                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="@lang('trans.delete')"><i class="fa fa-trash"></i></button>
                                        {{Form::close()}}
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
        <div class="modal fade" id="createExpenseTypeModal" tabindex="-1" aria-labelledby="createExpenseTypeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExpenseTypeModalLabel">Create Expense Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'expenseTypes.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'expenseTypeCreateForm'])}}
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


        <div class="modal fade" id="editExpenseTypeModal" tabindex="-1" aria-labelledby="editExpenseTypeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExpenseTypeModalLabel">Edit Expense Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['id' => 'expenseTypeEditForm', 'method' => 'PATCH', 'class' => 'form-horizontal'])}}
                    <div class="modal-body">

                        <div class="form-group row no-gutters">
                            <label for="editExpenseTypeName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="editExpenseTypeName" placeholder="Enter expense type name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror
                            </div>
                        </div>


                        <div class="form-group row no-gutters">
                            <label for="editExpenseTypeStatus" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="editExpenseTypeStatus" name="status" data-bootstrap-switch
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


        <div class="modal fade" id="showExpenseTypeModal" tabindex="-1" aria-labelledby="showExpenseTypeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showExpenseTypeModalLabel">Show Expense Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td id="showExpenseTypeName"></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td id="showExpenseTypeStatus"></td>
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
        let expenseTypes = @json($expenseTypes);

        $(document).ready(function () {
            //datatable
            $("#ExpenseTypesTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [3]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            // Category create form
            $('#expenseTypeCreateForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a expenseType name",
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
        function openShowExpenseTypeModal(id) {
            let expenseType = expenseTypes.find(x => x.id == id);
            // Set update row value
            $('#showExpenseTypeName').html(expenseType.name);

            $('#showExpenseTypeStatus').html('');
            $('#showExpenseTypeStatus').append(expenseType.status === 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>");

            // Open modal
            $('#showExpenseTypeModal').modal('show');
        }

        function openEditExpenseTypeModal(id) {
            let expenseType = expenseTypes.find(x => x.id == id);

            // Set edit form action url
            $('#expenseTypeEditForm').attr('action', app_url + '/expenseTypes/' + expenseType.id);

            // Set update row value
            $('#editExpenseTypeName').val(expenseType.name);

            expenseType.status == 1 ? $('#editExpenseTypeStatus').bootstrapSwitch('state', expenseType.status, true) : $('#editExpenseTypeStatus').bootstrapSwitch('state', expenseType.status, false);

            // Open modal
            $('#editExpenseTypeModal').modal('show');

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
        function expenseTypeStatusChange(id) {
            Swal.fire({
                title: 'Are you sure to change?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $('#expenseTypeStatus-' + id).data('href');
                }
            })
        }
    </script>
@endpush

