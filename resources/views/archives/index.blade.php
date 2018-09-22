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

			<td height="20" style="text-align:center"><a href="/genre.list/<?=urlencode($genre)?>"><?=$genre?></a></td>
			<td><a href="/show.album/<?=urlencode($album_path)?>"><?=$album_path?></a></td>
			<td align="center"><?=$file_cnt?>F <?=$file_size?>M</td>
			<td align="left" style="padding-left:4px;"><? if ($_SESSION[mem]){ ?><a href="#" id="btn_download" data-id="<?=$row['album_id']?>"><span class="fa fa-floppy-o"></span></a><img src="/img/spacer.gif" width="1"/><a href="#" id="btn_phone" data-description="<?=htmlspecialchars($album_path)?>" data-toggle="modal" data-target="#music_player" data-id="<?=$row['album_id']?>"><span class="fa fa-volume-up"></span></a><? } ?><img src="/img/spacer.gif" width="1"/><a href="#" id="btn_bookmark" data-description="<?=htmlspecialchars($album_path)?>" data-field="album" data-id="<?=$row['album_id']?>"><span class="fa fa-bookmark"></span></a><? if (0) { ?><img src="/img/spacer.gif" width="3"/><? if ($check_pic) { ?><a href="#" id="btn_pic" data-toggle="modal" data-target="#responsive" data-description="<?=htmlspecialchars($album_path)?>" data-id="<?=$row['album_id']?>"><span class="fa fa-camera"></span></a><? } } ?></td>
			<td style="text-align:center"><a href="/group.list/<?=$group_name?>"><?=$group_name?></a></td>
			<td style="text-align:center"><a href="/today.list/<?=$release_date?>"><?=$release_date?></a></td>

                <tbody>

<?=$file_cnt?>F <?=$file_size?>M

                    @foreach($arr_rs as $r)
                    <tr class="is_online_{{$r['is_online']}}">
                        <td class="text-center"><a href="/archives/genre/{{urlencode($r['genre'])}}">{{ $r['genre'] }}</a></td>
                        <td class="font-w600"><a href="/archives/album/{{$r['album_id']}}">{{ $r['album_path'] }}</a></td>
                        <td class="d-none d-sm-table-cell">
                           {{$r['file_cnt']}}F {{$r['file_size']}}M
                        </td>
                        <td class="d-none d-sm-table-cell">

<a href="#" id="btn_download" data-id="{{$r['album_id']}}"><span class="fa fa-floppy-o"></span></a> <a href="#" id="btn_phone" data-description="{{ htmlspecialchars($r['album_path']) }}" data-toggle="modal" data-target="#music_player" data-id="{{$r['album_id']}}"><span class="fa fa-volume-up"></span></a> <a href="#" id="btn_bookmark" data-description="{{ htmlspecialchars($r['album_path'] }}" data-field="album" data-id="{{$r['album_id']}}"><span class="fa fa-bookmark"></span></a>

                        </td>
                        <td class="d-none d-sm-table-cell">
                            <a href="/archives/group/{{urlencode($r['group_name'])}}">{{$r['group_name']}}</a>
                        </td>
                        <td>
                            <em class="text-muted"><a href="/archives/index/{{$r['release_date']}}">{{$r['release_date']}}</a></em>
                        </td>
                    </tr>
                    @endforeach
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