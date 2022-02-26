@extends('admin.layouts.app')
@section('title')
    Report
@endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"/>
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row no-gutters mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                        <h3 class="card-title">All Reports</h3>
                        <div class="d-flex justify-content-center">
                            {{Form::open(['route' => 'reports.index', 'method' => 'GET', 'class' => 'form-inline', 'id' => 'reportSearchForm', 'autocomplete' => 'off'])}}
                            <input type="text" class="form-control datepicker mx-2 " placeholder="Select month"
                                   name="month" required>
                            <button type="submit" class="btn bnt-sm btn-info mx-2">Submit</button>
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="reportsTable" class="table text-center table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 34%">Total Income</th>
                                <th style="width: 33%">Total Due</th>
                                <th style="width: 33%">Total Expense</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{isset($reportData->total_amount) ? $reportData->total_amount : ''}}</td>
                                <td>{{isset($reportData->total_due) ? $reportData->total_due : ''}}</td>
                                <td>{{isset($reportData->total_expense) ? $reportData->total_expense : ''}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script>

        $(document).ready(function () {
            //Datepicker
            $('.datepicker').datepicker({
                format: "yyyy-mm",
                // format: 'yyyy-mm-dd'
                viewMode: "months",
                minViewMode: "months"
            });

            $('#reportsTable').DataTable({
                searching: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    className: 'exportExcel',
                    filename: 'Excel',
                    exportOptions: {modifier: {page: 'all'}}
                },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        className: 'exportExcel',
                        filename: 'Csv',
                        exportOptions: {modifier: {page: 'all'}}
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'exportExcel',
                        filename: 'Pdf',
                        exportOptions: {modifier: {page: 'all'}}
                    }]
            });


        });

    </script>
@endpush

