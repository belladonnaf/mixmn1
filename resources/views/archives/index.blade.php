@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('content')
    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Archives _ Album Index</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active" aria-current="page">Album Index</li>
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

@if (!$agent->isMobile())

@section('css_after')
<link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
@endsection

            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">Genre</th>
                        <th>Release</th>
                        <th class="d-none d-sm-table-cell" style="width: 100px;">Info</th>
                        <th class="d-none d-sm-table-cell" style="width: 60px;">Button</th>
                        <th style="width: 100px;">Group</th>
                        <th style="width: 100px;">Date</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($arr_rs as $r)
                    <tr class="is_online_{{$r['is_online']}}">
                        <td class="text-center"><a href="/archives/genre/{{urlencode($r['genre'])}}">{{ $r['genre'] }}</a></td>
                        <td class="font-w600"><a href="/album/{{$r['album_id']}}">{{ $r['album_path'] }}</a></td>
                        <td class="d-none d-sm-table-cell">
                           {{$r['file_cnt']}}F {{$r['file_size']}}M
                        </td>
                        <td class="d-none d-sm-table-cell">

<a href="#" id="btn_download" data-id="{{$r['album_id']}}"><span class="fa fa-floppy-o"></span></a> <a href="#" id="btn_phone" data-description="{{ htmlspecialchars($r['album_path']) }}" data-toggle="modal" data-target="#music_player" data-id="{{$r['album_id']}}"><span class="fa fa-volume-up"></span></a> <a href="#" id="btn_bookmark" data-description="{{ htmlspecialchars($r['album_path']) }}" data-field="album" data-id="{{$r['album_id']}}"><span class="fa fa-bookmark"></span></a>

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
@else
@section('css_after')
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

        <form action="/archives/" method="get" onsubmit="return false;">
            <div class="row">
                <div class="col-lg-8 col-xl-6">
                    <div class="form-row">
                       <div class="form-group col-xl-4">
											    <div class="input-group col-sm-6">
                            <input type="text" class="js-datepicker form-control" id="sel_date" name="sel_date" data-week-start="0" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
										        <div class="input-group-append">
										            <button type="submit" class="btn btn-primary btn-go">Go</button>
										        </div>
													</div>
                        </div>
                    </div>
                </div>
            </div>
				</form>
<?php
				$arr_css = ['bg-gd-primary','bg-gd-dusk','bg-gd-fruit','bg-gd-aqua','bg-gd-sublime','bg-gd-sea','bg-gd-leaf','bg-gd-lake','bg-gd-sun','bg-gd-dusk-op','bg-gd-fruit-op','bg-gd-aqua-op','bg-gd-sublime-op','bg-gd-sea-op','bg-gd-leaf-op','bg-gd-lake-op','bg-gd-sun-op'];
				$arr_css = randomize_css($arr_css,6);

?>

          @foreach($arr_rs as $k=>$r)

<?php			$page = floor(($k-1)/20)+1; ?>

					<div class="col-md-6 col-xl-6 page-{{$page}} <?php if($page == 1){ echo 'd-block'; } else { echo 'd-none'; } ?>">
					    <a class="block block-rounded block-transparent d-md-flex align-items-md-stretch bg-black-75 js-click-ripple-enabled" href="/album/{{$r['album_id']}}" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">
					        <div class="block-content block-content-full {{$arr_css[($k%6)]}}">
					            <span class="d-inline-block py-1 px-2 rounded bg-black-75 font-size-sm font-w700 text-uppercase text-white">
					                {{$r['genre']}}
					            </span>
					            <div>
					                <h6 class="font-w700 text-white mb-1">{{$r['album_path']}}</h3>
					            </div>
					            <span class="font-size-sm font-w700 text-uppercase text-white-75">
					                {{$r['file_cnt']}} Files | {{$r['file_size']}} Mbyte
					            </span>
					        </div>
					    </a>
					</div>
				  @endforeach

					<div class="load-more">
						<button class="btn btn-hero-lg btn-hero-primary w-100" data-value="1">LOAD MORE</button>
					</div>

@endif
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->

</div>
<!-- END Page Content -->

@endsection
@section('js_after')
<!-- Page JS Plugins -->

@if (!$agent->isMobile())

<script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
@else
<script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
jQuery(document).ready(function(){
	jQuery(function(){ Dashmix.helpers(['datepicker']); });
	jQuery(".load-more button").click(function(){
			var cur_page = jQuery(this).attr("data-value");
			var next_page = parseInt(cur_page)+1;
			jQuery(".page-"+next_page).removeClass('d-none').addClass('d-block');
			jQuery(".load-more button").attr("data-value",next_page);
	});
	jQuery(".btn-go").click(function(){
		window.location.href='/album/archives/index/' + jQuery("#sel_date");
	});
});
</script>
@endif

<!-- Page JS Code -->
<script src="/js/pages/be_tables_datatables.min.js"></script>
@endsection