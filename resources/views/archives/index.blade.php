@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">DataTables</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active" aria-current="page">DataTables</li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">

    <!-- Dynamic Table Full Pagination -->
    <div class="block block-rounded block-bordered">
        <div class="block-content block-content-full archive-margin-top">
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">Genre</th>
                        <th>Release</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Info</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Button</th>
                        <th style="width: 15%;">Group</th>
                        <th style="width: 15%;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 201; $i++) { ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="font-w600">123123</td>
                        <td class="d-none d-sm-table-cell">
                            client<?php echo $i; ?><em class="text-muted">@example.com</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            123123
                        </td>
                        <td class="d-none d-sm-table-cell">
                            123123
                        </td>
                        <td>
                            <em class="text-muted"><?php echo rand(2, 10); ?> days ago</em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->

</div>
<!-- END Page Content -->

@endsection
@section('js_after')
<!-- Page JS Plugins -->
<script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="/js/pages/be_tables_datatables.min.js"></script>
@endsection