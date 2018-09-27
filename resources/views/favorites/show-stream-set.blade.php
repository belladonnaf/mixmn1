<script>if(location.port && location.port != '80'){ location.href= window.location.protocol + '//' + window.location.hostname + window.location.pathname + window.location.hash; }</script>
@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('content')
    <!-- Hero -->
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
<input type="hidden" name="stream_set_id" class="stream_set_id" value="{{$stream_set_id}}">
	<div class="row">
		<div class="col-md-6 col-xl-6">
			<div class="playlist-header">
	      <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
          <div class="block-content block-content-full d-flex align-items-center justify-content-between">
              <div class="mr-3">
                  <p class="text-white font-size-lg font-w600 mb-0">
                      {{$row->set_alias}}
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
@foreach($arr_rs as $k=>$r)
					<div class="col-md-12">
					    <a class="block block-rounded block-transparent d-md-flex align-items-md-stretch bg-black-75 js-click-ripple-enabled" href="/stream-set/{{$r->set_id}}" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">
					        <div class="block-content block-content-full {{$arr_css[$k]}}">
					            <div>
					                <h6 class="font-w700 text-white mb-1">{{$r->set_alias}}</h3>
					            </div>
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