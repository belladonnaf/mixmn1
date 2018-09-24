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
				<div class="row">

@foreach($search_result as $k=>$r)
					<div class="col-md-6 col-xl-6">
					    <a class="block block-rounded block-transparent d-md-flex align-items-md-stretch bg-black-75 js-click-ripple-enabled" href="/album/{{$r->album_id}}" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">
					        <div class="block-content block-content-full {{$arr_css[$k]}}">
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
<script>
jQuery(document).ready(function(){

	jQuery(".add-fav").click(function(){
		
		var api_url = 'http://mix.mn1.net/api/favorites/set/' + jQuery(".album_id").val();
    axios.get(api_url).then(response => {
			console.log(response.data);
		});

	});

});
</script>
@endsection