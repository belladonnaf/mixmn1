@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Hero -->
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
<input type="hidden" name="album_id" class="album_id" value="{{$album_id}}">
	<div class="row">
		<div class="col-md-6 col-xl-6">
			<div class="search-wrapper">

				<div class="form-group">
				    <div class="input-group">
				        <input type="text" class="form-control form-control-alt bg-light" id="example-group3-input2-alt" name="example-group3-input2-alt" placeholder="{{$keyword}}">
				        <div class="input-group-append">
				            <button type="button" class="btn btn-hero-danger">Search</button>
				        </div>
				    </div>
				</div>
					
			</div>
	  </div>
	</div>
@if($search_result)
	<div class="row">
		<div class="col-md-12">
				<div class="row" id="search-result-wrapper">

@foreach($search_result as $k=>$r)
					<div class="col-md-6 col-xl-6">
					    <a class="block block-rounded block-transparent d-md-flex align-items-md-stretch bg-black-75 js-click-ripple-enabled" href="/album/{{$r->album_id}}" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">
					        <div class="block-content block-content-full {{$arr_css[($k%6)]}}">
					            <span class="d-inline-block py-1 px-2 rounded bg-black-75 font-size-sm font-w700 text-uppercase text-white">
					                {{$r->genre}}
					            </span>
					            <div>
					                <h6 class="font-w700 text-white mb-1">{{$r->album_path}}</h3>
					            </div>
					            <span class="font-size-sm font-w700 text-uppercase text-white-75">
					                {{$r->file_cnt}} Files | {{$r->file_size}} Mbyte
					            </span>
					        </div>
					    </a>
					</div>
@endforeach
					
				</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">

@if (!$agent->isMobile())

				<nav aria-label="Page navigation">
	        <ul class="pagination">

	            <li class="page-item">
	                <a class="page-link" href="/search?keyword={{$keyword}}&page={{$start_page}}" tabindex="-1" aria-label="Previous">
	                    <span aria-hidden="true">
	                        <i class="fa fa-angle-double-left"></i>
	                    </span>
	                    <span class="sr-only">Previous</span>
	                </a>
	            </li>

		@for ($i=$start_page;$i<$end_page+1;$i++)
	            <li class="page-item <?php if($cur_page == $i) { echo 'active'; } ?>">
	                <a class="page-link" href="/search?keyword={{$keyword}}&page={{$i}}">{{$i}}</a>
	            </li>
		@endfor			    
	            <li class="page-item">
	                <a class="page-link" href="/search?keyword={{$keyword}}&page={{$end_page}}" aria-label="Next">
	                    <span aria-hidden="true">
	                        <i class="fa fa-angle-double-right"></i>
	                    </span>
	                    <span class="sr-only">Next</span>
	                </a>
	            </li>
	        </ul>
	    </nav>
			
		</div>
	</div>

@else
	
	<div class="load-more">
		<button class="btn btn-hero-lg btn-hero-primary" data-value="{{$next_page}}">LOAD MORE</button>
	</div>

<script>
jQuery(document).ready(function(){
	jQuery(".load-more button").click(function(){

		var next_page = jQuery(this).attr("data-value");
		var search_keyword = '{{$keyword}}';
		var api_url = 'http://mix.mn1.net/api/search/' + search_keyword + '/' + next_page;
		var str_res = '';

//{{$arr_css[($k%6)]}}

    axios.get(api_url).then(response => {

      for ( var k in response.data){

	      if(response.data[k]){
					var r = response.data[k];

					str_res = '<div class="col-md-6 col-xl-6"><a class="block block-rounded block-transparent d-md-flex align-items-md-stretch bg-black-75 js-click-ripple-enabled" href="/album/' + r.album_id ' data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">';
					str_res = str_res + '<div class="block-content block-content-full ' + r.css + '">';
					str_res = str_res + '<span class="d-inline-block py-1 px-2 rounded bg-black-75 font-size-sm font-w700 text-uppercase text-white">';
					str_res = str_res + r.genre;
					str_res = str_res + '</span>';
					str_res = str_res + '<div>';
					str_res = str_res + '<h6 class="font-w700 text-white mb-1">' + r.album_path + '</h3>';
					str_res = str_res + '</div>';
					str_res = str_res + '<span class="font-size-sm font-w700 text-uppercase text-white-75">';
					str_res = str_res + r.file_cnt + ' Files | ' + r.file_size + ' Mbyte';
					str_res = str_res + '</span>';
					str_res = str_res + '</div>';
					str_res = str_res + '</a>';
					str_res = str_res + '</div>';
					
					jQuery(".search-result-wrapper").append(str_res);
					jQuery(".load-more button").attr("data-value",parseInt(next_page)+1);
									
				}				 
      }

		});
	});
});
</script>

@endif
	
@else

	<div class="alert alert-warning" role="alert">
	    <h3 class="alert-heading font-size-h4 my-2">Warning</h3>
	    <p class="mb-0">There is no results</p>
	</div>

@endif

</div>
<!-- END Page Content -->

@endsection
@section('js_after')

<!-- Page JS Plugins -->
<script src="/js/plugins/es6-promise/es6-promise.auto.min.js"></script>
<script src="/js/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Page JS Code -->
<script src="/js/pages/be_comp_dialogs.min.js"></script>

@endsection