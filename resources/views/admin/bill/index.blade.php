@extends('admin.layouts.app')
@section('title')
    Bills
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Bills</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bills</li>
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
                        <h3 class="card-title float-left">All Bills
                        </h3>
                        @can('create-bill')
                        <button type="button"
                                data-toggle="modal"
                                data-target="#createBillModal"
                                class="btn btn-info float-right btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="billsTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">Customer Name</th>
                                <th style="width: 10%">Date</th>
                                <th style="width: 10%">Package Price</th>
                                <th style="width: 10%">Amount</th>
                                <th style="width: 10%">Due</th>
                                <th style="width: 15%">Note</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{@$bill->customer->full_name}}</td>
                                    <td>{{$bill->date}}</td>
                                    <td>&#2547; {{$bill->package->price}}</td>
                                    <td>&#2547; {{$bill->amount}}</td>
                                    @if($bill->due)
                                        <td>&#2547; {{$bill->due }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{$bill->note}}</td>
                                    <td>
                                        @if($bill->status == 0 )
                                            <span class='badge badge-danger'>Due</span>
                                        @elseif($bill->status == 1)
                                            <span class='badge badge-success'>Paid</span>
                                        @else
                                            <span class='badge badge-warning'>Partially Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('update-bill')
                                        <button onclick="openEditBillModal({{$bill->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>
                                        @endcan
                                        @can('delete-bill')
                                        {{Form::open(['route'=>['bills.destroy', $bill->id], 'method'=>'DELETE', 'id' => "deleteForm-$bill->id", 'class' => 'd-inline'])}}
                                        <button type="button"
                                                onclick="deleteBtn('{{$bill->id}}')"
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
        <div class="modal fade" id="createBillModal" tabindex="-1" aria-labelledby="createBillModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBillModalLabel">Create bill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'bills.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'billCreateForm', 'autocomplete' => 'off'])}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="CustomerName" class="col-sm-3 col-form-label">Select Customer</label>
                                    <div class="col-sm-9">
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="" selected>Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->full_name}}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="text-danger">{{$errors->has('user_id') ? $errors->first('user_id') : ''}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="package_name" class="col-sm-3 col-form-label">Package Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="package_name" class="form-control"
                                               readonly>
                                        <input type="hidden" id="package_id" name="package_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="date" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="date" name="date" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="package_price" class="col-sm-3 col-form-label">Package Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="package_price" name="package_price" class="form-control"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="amount" name="amount" class="form-control"
                                               placeholder="Enter amount">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="due" class="col-sm-3 col-form-label">Due</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="due" name="due" class="form-control"
                                               placeholder="Due" readonly>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="0">Due</option>
                                            <option value="1" selected>Paid</option>
                                            <option value="2">Partially Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="note" class="col-sm-3 col-form-label">Note</label>
                                    <div class="col-sm-9">
                                <textarea name="note" id="note" rows="2" class="form-control"
                                          placeholder="Enter note"></textarea>
                                    </div>
                                </div>
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

        <div class="modal fade" id="editBillModal" tabindex="-1" aria-labelledby="editBillModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBillModalLabel">Update bill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'billEditForm', 'autocomplete' => 'off'])}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editUserId" class="col-sm-3 col-form-label">Select Customer</label>
                                    <div class="col-sm-9">
                                        <select name="user_id" id="editUserId" class="form-control">
                                            <option value="" selected>Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->full_name}}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="text-danger">{{$errors->has('user_id') ? $errors->first('user_id') : ''}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editPackageName" class="col-sm-3 col-form-label">Package Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="editPackageName" class="form-control"
                                               readonly>
                                        <input type="hidden" id="editPackageId" name="package_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editDate" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="editDate" name="date" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editPackagePrice" class="col-sm-3 col-form-label">Package Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="editPackagePrice" name="package_price" class="form-control"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editAmount" class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="editAmount" name="amount" class="form-control"
                                               placeholder="Enter amount">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editDue" class="col-sm-3 col-form-label">Due</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="editDue" name="due" class="form-control"
                                               placeholder="Due" readonly>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editStatus" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="editStatus" class="form-control">
                                            <option value="0">Due</option>
                                            <option value="1" selected>Paid</option>
                                            <option value="2">Partially Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row no-gutters">
                                    <label for="editNote" class="col-sm-3 col-form-label">Note</label>
                                    <div class="col-sm-9">
                                <textarea name="note" id="editNote" rows="2" class="form-control"
                                          placeholder="Enter note"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info">Update</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // all bills in json format
        let customers = @json($customers);
        let bills = @json($bills);

        $(document).ready(function () {
            //datatable
            $("#billsTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [7]}
                ],
                "pageLength": {{settings('per_page')}}
            });


            //Datepicker
            $('.datepicker').datepicker({
                todayHighlight: true,
                // format: 'dd-mm-yyyy'
                format: 'yyyy-mm-dd'
            });

            //Event fire for total amount calculation
            $('#amount').keyup(function () {
                calculate();
            });

            //Event fire for total amount edit calculation
            $('#editAmount').keyup(function () {
                editCalculate();
            });


            // Bill create form
            $('#billCreateForm').validate({
                rules: {
                    user_id: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                },
                messages: {
                    user_id: {
                        required: "Please select any customer",
                    },
                    amount: {
                        required: "The amount field is required",
                    },
                    date: {
                        required: "Please select any date",
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

            $('#user_id').change(function () {
                $('#package_name').empty();
                $('#package_id').empty();
                $('#package_price').empty();

                let customerId = $(this).val();
                let customer = customers.find(customer => customer.id == customerId);
                if(customer){
                    $('#package_name').val(customer.package.name);
                    $('#package_id').val(customer.package_id);
                    $('#package_price').val(customer.package.price);
                }
                calculate()
            });

            $('#editUserId').change(function () {
                $('#editPackageName').empty();
                $('#editPackageId').empty();
                $('#editPackagePrice').empty();

                let customerId = $(this).val();
                let customer = customers.find(customer => customer.id == customerId);
                if(customer){
                    $('#editPackageName').val(customer.package.name);
                    $('#editPackageId').val(customer.package_id);
                    $('#editPackagePrice').val(customer.package.price);
                }
                editCalculate()
            });

        });

        // Functions
        function openEditBillModal(id) {
            let bill = bills.find(x => x.id == id);
            // console.log(flats)

            // Set edit form action url
            $('#billEditForm').attr('action', app_url + '/bills/' + bill.id);

            // Set update row value
            $('#editDate').val(bill.date);
            $('#editPackageName').val(bill.package.name);
            $('#editPackageId').val(bill.package_id);
            $('#editPackagePrice').val(bill.package_price);
            $('#editAmount').val(bill.amount ? bill.amount : '');
            $('#editDue').val(bill.due ? bill.due : '');
            $('#editPaidAmount').val(bill.paid_amount ? bill.paid_amount : '');
            $('#editNote').val(bill.note);

            $('#editUserId').html("")
            $.each(customers, function (index, customer) {
                $('#editUserId').append("<option value='" + customer.id + "' >" + customer.full_name + "</option>")
            });
            $('#editUserId option[value=' + bill.user_id + ']').attr("selected", "selected");

            if (bill.status == 0) {
                $('#editStatus option[value=0]').attr("selected", "selected");
            } else if (bill.status == 1) {
                $('#editStatus option[value=1]').attr("selected", "selected");
            } else {
                $('#editStatus option[value=2]').attr("selected", "selected");
            }

            // Open modal
            $('#editBillModal').modal('show');

        }

        // Delete Bill
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

        // Bill Status Change
        function billStatusChange(id) {
            Swal.fire({
                title: 'Are you sure to change?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $('#billStatus-' + id).data('href');
                }
            })
        }

        // Calculate total bill
        function calculate() {
            let due = 0;

            let package_price = $('#package_price').val() ? $('#package_price').val() : 0;
            let amount = $('#amount').val() ? $('#amount').val() : 0;

            if (package_price && amount) {
                due = parseFloat(package_price) - parseFloat(amount)
                $('#due').val(due);
            }
        }

        function editCalculate() {
            let due = 0;
            let editPackagePrice = $('#editPackagePrice').val() ? $('#editPackagePrice').val() : 0;
            let editAmount = $('#editAmount').val() ? $('#editAmount').val() : 0;

            if (editPackagePrice && editAmount) {
                due = parseFloat(editPackagePrice) - parseFloat(editAmount)
                $('#editDue').val(due);
            }
        }

    </script>
@endpush
