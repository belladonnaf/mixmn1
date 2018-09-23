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
	      <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
	      	<span class="btn btn-warning add-fav js-swal-success push"><i class="fa fa-heart"></i></span>
	          <div class="block-content block-content-full d-flex align-items-center justify-content-between">
	              <div class="mr-3">
	                  <p class="text-white font-size-lg font-w600 mb-0">
	                      {{$album_path}}
	                  </p>
	              </div>
	          </div>
	      </a>
			</div>
			<div id="app" class="playlist">
			</div>
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

@endsection