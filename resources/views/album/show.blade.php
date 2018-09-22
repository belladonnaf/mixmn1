@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
@endsection

@section('content')
    <!-- Hero -->
<!-- END Hero -->

<!-- Page Content -->
<div class="content">

	<div class="row">
		<div class="col-md-6 col-xl-6">
			<div class="playlist-header">
	      <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
	          <div class="block-content block-content-full d-flex align-items-center justify-content-between">
	              <div class="mr-3">
	                  <p class="text-white font-size-lg font-w600 mb-0">
	                      {{$album_path}}
	                  </p>
	                  <p class="text-white-75 mb-0">
	                      {{$new_track[0]["uploaded_date"]}}
	                  </p>
	                  <p class="text-white-75 mb-0">
	                      {{$new_track[0]["genre"]}}
	                  </p>
	              </div>
	              <div class="item">
	                  <i class="fa fa-2x fa-globe text-xinspire-lighter"></i>
	              </div>
	          </div>
	      </a>
			</div>
			<div id="playlist" class="playlist"></div>
	  </div>
	

</div>
<!-- END Page Content -->

@endsection
@section('js_after')

@endsection

                        