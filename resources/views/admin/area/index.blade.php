@extends('admin.layouts.app')
@section('title')
    Area
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Area</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Area</li>
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
                        <h3 class="card-title float-left">All Area
                        </h3>
                        @can('access-area')
                            <button type="button"
                                    data-toggle="modal"
                                    data-target="#createPackageModal"
                                    class="btn btn-info float-right btn-sm">
                                <i class="fa fa-plus"></i> Add New
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{--                        <table id="categoriesTable" class="table table-bordered table-striped dataTable dtr-inline text-center">--}}
                        <table id="areaTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 30%">Division</th>
                                <th style="width: 10%">District</th>
                                <th style="width: 10%">Upazila</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($areas as $area)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$area->name}}</td>
                                    <td>{{$area->division->name}}</td>
                                    <td>{{$area->district->name}}</td>
                                    <td>{{$area->upazila->name}}</td>
                                    <td>
                                        <span
                                            class="badge {{$area->status == 1 ? 'badge-success' : 'badge-danger'}}">
                                            {{$area->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        @can('show-area')
                                            <button onclick="openShowPackageModal({{$area->id}})" type="button"
                                                    class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                    title="@lang('trans.view')"><i class="fa fa-search-plus"></i>
                                            </button>
                                        @endcan
                                        {{--                                        @can('update-area')--}}
                                        <button onclick="openEditAreaModal({{$area->id}})" type="button"
                                                class="btn btn-sm btn-success" data-toggle="tooltip"
                                                title="@lang('trans.edit')"><i class="fa fa-edit"></i></button>
                                        {{--                                        @endcan--}}
                                        {{--                                        @can('delete-area')--}}
                                        {{Form::open(['route'=>['areas.destroy', $area->id], 'method'=>'DELETE', 'id' => "deleteForm-$area->id", 'class' => 'd-inline'])}}
                                        <button type="button"
                                                {{--                                                @can('access-area')--}}
                                                onclick="deleteBtn('{{$area->id}}')"
                                                {{--                                                @endcan--}}
                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="@lang('trans.delete')"><i class="fa fa-trash"></i></button>
                                        {{Form::close()}}
                                        {{--                                        @endcan--}}
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
                        <h5 class="modal-title" id="createPackageModalLabel">Create Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['route' => 'areas.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'areaCreateForm'])}}
                    <div class="modal-body">
                        <div class="form-group row no-gutters">
                            <label for="name" class="col-sm-3 col-form-label mandatory">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}" id="name" placeholder="Enter area name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="divisionSelect" class="col-sm-3 col-form-label mandatory">Division</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info"
                                    name="division_id" id="divisionSelect" style="width: 100%;">
                                    <option value="">Select Division</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="districtSelect" class="col-sm-3 col-form-label mandatory">District</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info"
                                    name="district_id" id="districtSelect" style="width: 100%;">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="upazilaSelect" class="col-sm-3 col-form-label mandatory">Upazila</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info"
                                    name="upazila_id" id="upazilaSelect" style="width: 100%;">
                                    <option value="">Select Upazila</option>
                                </select>
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


        <div class="modal fade" id="editAreaModal" tabindex="-1" aria-labelledby="editAreaModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAreaModalLabel">Edit Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{Form::open(['id' => 'areaEditForm', 'method' => 'PATCH', 'class' => 'form-horizontal'])}}
                    <div class="modal-body">

                        <div class="form-group row no-gutters">
                            <label for="editAreaName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="editAreaName" placeholder="Enter area name">
                                @error('name')<span class="text-danger">{{$errors->first('name')}}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editAreaDivision" class="col-sm-3 col-form-label mandatory">Division</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info w-100"
                                    data-dropdown-css-class="select2-info"
                                    name="division_id" id="editAreaDivision">
                                    <option value="" disabled>Select Division</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editAreaDistrict" class="col-sm-3 col-form-label mandatory">District</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info w-100"
                                    data-dropdown-css-class="select2-info"
                                    name="district_id" id="editAreaDistrict">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="editAreaUpazila" class="col-sm-3 col-form-label mandatory">Upazila</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control select2 select2-info w-100"
                                    data-dropdown-css-class="select2-info"
                                    name="upazila_id" id="editAreaUpazila">
                                    <option value="">Select Upazila</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row no-gutters">
                            <label for="editAreaStatus" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input type="checkbox" id="editAreaStatus" name="status" data-bootstrap-switch
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


    </section>
@endsection

@push('script')
    <script>
        // all categories in json format
        let areas = @json($areas);

        $(document).ready(function () {
            $.ajax({
                method: "GET",
                url: "/divisions/all",
            })
                .done(function (response) {
                    if (response.status == 'success') {
                        $.each(response.data, function (index, division) {
                            $('#divisionSelect').append(`<option value="` + division.id + `">` + division.name + `</option>`)
                            $('#editAreaDivision').append(`<option value="` + division.id + `">` + division.name + `</option>`)
                        });
                    }
                });


            $("#divisionSelect").change(function () {
                $('#districtSelect').html("");
                $('#districtSelect').append(`<option value="" selected>` + "Select District" + `</option>`);

                getDistrict(this.value);
            });

            //..................
            $("#districtSelect").change(function () {
                $('#upazilaSelect').html("");
                $('#upazilaSelect').append(`<option value="" selected>` + "Select Upazila" + `</option>`);

                getUpazila(this.value);
            });

            $("#editAreaDivision").change(function () {
                $('#editAreaDistrict').html("");
                $('#editAreaDistrict').append(`<option value="" selected>` + "Select District" + `</option>`);

                getDistrict(this.value);
            });

            //..................
            $("#editAreaDistrict").change(function () {
                $('#editAreaUpazila').html("");
                $('#editAreaUpazila').append(`<option value="" selected>` + "Select Upazila" + `</option>`);

                getUpazila(this.value);
            });

            //datatable
            $("#areaTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [6]}
                ],
                "pageLength": {{settings('per_page')}}
            });

            // Category create form
            $('#areaCreateForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    division_id: {
                        required: true,
                    },
                    district_id: {
                        required: true,
                    },
                    upazila_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a area name",
                    },
                    division_id: {
                        required: "Please enter a area division",
                    },
                    district_id: {
                        required: "Please enter a area district",
                    },
                    upazila_id: {
                        required: "Please enter a area upazila",
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

        async function openEditAreaModal(id) {
            let area = areas.find(x => x.id == id);

            $('#editAreaDivision option[value=' + area.division_id + ']').attr("selected", false);

            $('#editAreaDistrict').html("");

            $('#editAreaDistrict').append(`<option value="" selected>` + "Select District" + `</option>`);
            $('#editAreaUpazila').html("");

            $('#editAreaUpazila').append(`<option value="" selected>` + "Select Upazila" + `</option>`);

            await getDistrict(area.division_id);
            await getUpazila(area.district_id)


            // Set edit form action url
            $('#areaEditForm').attr('action', app_url + '/areas/' + area.id);

            // Set update row value
            $('#editAreaName').val(area.name);

            $('#editAreaDivision option[value=' + area.division_id + ']').attr("selected", "selected");
            $('#editAreaDistrict option[value=' + area.district_id + ']').attr("selected", "selected");
            $('#editAreaUpazila option[value=' + area.upazila_id + ']').attr("selected", "selected");

            area.status == 1 ? $('#editAreaStatus').bootstrapSwitch('state', area.status, true) : $('#editAreaStatus').bootstrapSwitch('state', area.status, false);

            // Open modal
            $('#editAreaModal').modal('show');

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

        //Get division
        async function getDistrict(divisionId) {
            await $.ajax({
                method: "GET",
                url: '/divisions/' + divisionId + '/districts',
            })
                .done(function (response) {
                    if (response.status == 'success') {

                        $.each(response.data, function (index, district) {

                            $('#districtSelect').append(`<option value="` + district.id + `">` + district.name + `</option>`)
                            $('#editAreaDistrict').append(`<option value="` + district.id + `">` + district.name + `</option>`)
                        });
                    }

                });
        }

        //Get upazila
        async function getUpazila(districtId) {
            await $.ajax({
                method: "GET",
                url: '/districts/' + districtId + '/upazilas',
            })
                .done(function (response) {
                    if (response.status == 'success') {

                        $.each(response.data, function (index, upazila) {

                            $('#upazilaSelect').append(`<option value="` + upazila.id + `">` + upazila.name + `</option>`);
                            $('#editAreaUpazila').append(`<option value="` + upazila.id + `">` + upazila.name + `</option>`);

                        });
                    }
                });
        }
    </script>
@endpush
