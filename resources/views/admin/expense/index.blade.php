@extends('admin.layouts.app')
@section('title')
    Expense
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Expenses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expenses</li>
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
                        <h3 class="card-title float-left">All Expenses
                        </h3>
                        @can('create-expense')
                        <button type="button"
                                data-toggle="modal"
                                data-target="#createExpenseModal"
                                class="btn btn-info float-right btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{--                        <table id="categoriesTable" class="table table-bordered table-striped dataTable dtr-inline text-center">--}}
                        <table id="ExpensesTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Expense Type</th>
                                <th style="width: 10%">Amount</th>
                                <th style="width: 10%">Remarks</th>
                                <th style="width: 20%">date</th>
                                <th style="width: 30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$expense->expenseType->name}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->remarks}}</td>
                                    <td>{{$expense->date}}</td>
                                    <td>
                                        @can('show-expense')
                                        <button onclick="openShowExpenseModal({{$expense->id}})" type="button"
                                                class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="@lang('trans.view')"><i class="fa fa-search-plus"></i></button>
                                        @endcan
                                        @can('update-expense')
                                        <button onclick="openEditExpenseModal({{$expense->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>
                                        @endcan
                                        @can('delete-expense')
                                        {{Form::open(['route'=>['expenses.destroy', $expense->id], 'method'=>'DELETE', 'id' => "deleteForm-$expense->id", 'class' => 'd-inline'])}}
                                        <button type="button"

                                                onclick="deleteBtn('{{$expense->id}}')"

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
        <div class="modal fade" id="createExpenseModal" tabindex="-1" aria-labelledby="createExpenseModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExpenseModalLabel">Create Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'expenses.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'expenseCreateForm'])}}
                    <div class="modal-body">

                        <div class="form-group row no-gutters">
                            <label for="expense_type_id" class="col-sm-3 col-form-label">Expense Type</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info"
                                    name="expense_type_id" id="expense_type_id" style="width: 100%;">
                                    <option value="">Select Expense Type</option>
                                    @foreach ($expenseTypes as $expenseType)
                                        <option value="{{ $expenseType->id }}">{{ $expenseType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="amount" class="col-sm-3 col-form-label mandatory">Amount</label>
                            <div class="col-sm-9">
                                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                                       value="{{old('amount')}}" id="amount" placeholder="Enter amount">
                                @error('amount')<span class="text-danger">{{$errors->first('amount')}}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <input type="number" name="remarks" class="form-control"
                                       value="{{old('remarks')}}" id="remarks" placeholder="Enter remarks">

                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="date" class="col-sm-3 col-form-label mandatory">Date</label>
                            <div class="col-sm-9">
                                <input type="text" name="date" class="form-control datepicker @error('date') is-invalid @enderror"
                                       placeholder="Enter date">
                                @error('date')<span class="text-danger">{{$errors->first('date')}}</span>@enderror

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


        <div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['id' => 'expenseEditForm', 'method' => 'PATCH', 'class' => 'form-horizontal'])}}
                    <div class="modal-body">

                        <div class="form-group row no-gutters">
                            <label for="editExpenseType" class="col-sm-3 col-form-label">Expense Type</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info"
                                    name="expense_type_id" id="editExpenseType" style="width: 100%;">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editExpenseAmount" class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                                       id="editExpenseAmount">
                                @error('amount')<span class="text-danger">{{$errors->first('amount')}}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editExpenseRemarks" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <input type="number" name="remarks" class="form-control"
                                       id="editExpenseRemarks">
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="EditExpenseDate" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="text" name="date" class="form-control datepicker @error('date') is-invalid @enderror"
                                       id="EditExpenseDate">
                                @error('date')<span class="text-danger">{{$errors->first('date')}}</span>@enderror

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


        <div class="modal fade" id="showExpenseModal" tabindex="-1" aria-labelledby="showExpenseModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showExpenseModalLabel">Show Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Expense Type:</th>
                                <td id="showExpenseType"></td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td id="showExpenseAmount"></td>
                            </tr>
                            <tr>
                                <th>Remarks:</th>
                                <td id="showExpenseRemarks"></td>
                            </tr>
                            <tr>
                                <th>Date:</th>
                                <td id="showExpenseDate"></td>
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
        let expenses = @json($expenses);
        let expenseTypes = @json($expenseTypes);

        $(document).ready(function () {
            //datatable
            $("#ExpensesTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [5]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            //Datepicker
            $('.datepicker').datepicker({
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            // Category create form
            $('#expenseCreateForm').validate({
                rules: {
                    amount: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                },
                messages: {
                    amount: {
                        required: "Please enter a expense amount",
                    },
                    date: {
                        required: "Please enter a expense date",
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
        function openShowExpenseModal(id) {
            let expense = expenses.find(x => x.id == id);
            console.log(expense)
            // let expenseType = expenseTypes.find(x => x.id == id);
            // Set update row value
            $('#showExpenseType').html(expense.expense_type.name);
            $('#showExpenseAmount').html(expense.amount);
            $('#showExpenseRemarks').html(expense.remarks);
            $('#showExpenseDate').html(expense.date);

            // Open modal
            $('#showExpenseModal').modal('show');
        }

        function openEditExpenseModal(id) {
            let expense = expenses.find(x => x.id == id);
            // let expenseType = expenseTypes.find(x => x.id == id);

            // Set edit form action url
            $('#expenseEditForm').attr('action', app_url + '/expenses/' + expense.id);

            // Set update row value
            $("#editExpenseType").empty();
            $.each(expenseTypes, function (index, expenseType) {
                $('#editExpenseType').append(`<option value="` + expenseType.id + `">` + expenseType.name + `</option>`)
            });
            $('#editExpenseType option[value=' + expense.expense_type_id + ']').attr("selected", "selected");

            $('#editExpenseAmount').val(expense.amount);
            $('#editExpenseRemarks').val(expense.remarks);
            $('#EditExpenseDate').val(expense.date);


            // Open modal
            $('#editExpenseModal').modal('show');

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


