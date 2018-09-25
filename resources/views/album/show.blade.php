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
			<div class="playlist-header">
				<span class="btn btn-warning add-fav js-swal-add-fav push"><i class="fa fa-heart"></i></span>
	      <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
          <div class="block-content block-content-full d-flex align-items-center justify-content-between">
              <div class="mr-3">
                  <p class="text-white font-size-lg font-w600 mb-0">
                      {{$album_path}}
                  </p>
              </div>
          </div>
	      </a>
			</div>
			<div id="playlist" class="playlist"></div>
	  </div>

@if (!$agent->isMobile())
		<div class="col-md-6 col-xl-6">
				<div class="row">

@foreach($arr_rel as $k=>$r)
					<div class="col-md-12">
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
@endif
	
	</div>
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

	if( window.location.port || window.location.port != '80'){
		window.location.href = window.location.protocol + '//' + window.location.hostname + window.location.pathname + window.location.hash;
	}

	jQuery(".add-fav").click(function(){
		
		var api_url = 'http://mix.mn1.net/api/favorites/set/' + jQuery(".album_id").val();
    axios.get(api_url).then(response => {
			console.log(response.data);
		});

	});

});
</script>
@endsection