@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<style>
	div.item { width:64px !important; height:64px !important;}
	span.rank {
    position: absolute;
    top:15px;
    left:15px;
	}	
	span.album-info { font-size:0.8rem;}
</style>
endsection

@section('content')

<!-- Page Content -->
<div class="content">

	<div class="row">
		
		<div class="col-md-6 col-xl-4">
	
			<div class="block block-rounded bg-gd-primary">
			    <div class="block-content">
			        <p class="text-white text-uppercase font-size-sm font-w700 text-center mt-2 mb-4">
			            1 - 10 RANK
			        </p>
@foreach ($first_arr as $k=>$r)
			        <a class="block block-rounded block-link-rotate bg-black-10 mb-2" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="item">
<span class="rank rank-{{($k+1)}}">{{($k+1)}}</span>
@if($r->image)
													<img src="{{$r->image}}" width="64px" height="64px" onerror="this.src='/media/images/eee.jpg';">
@else
			                    <div style="background-color:#eeeeee;width:64px;height:64px;"></div>
@endif
			                </div>
			                <div class="ml-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                        <span class="album-info">{{$r->album_path}}</span>
			                    </p>
			                </div>
			            </div>
			        </a>
@endforeach
			    </div>
			</div>

		</div>

		<div class="col-md-6 col-xl-4">
	
			<div class="block block-rounded bg-gd-primary">
			    <div class="block-content">
			        <p class="text-white text-uppercase font-size-sm font-w700 text-center mt-2 mb-4">
			            11 - 20 RANK
			        </p>

@foreach ($second_arr as $k=>$r)
			        <a class="block block-rounded block-link-rotate bg-black-10 mb-2" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="item">
<span class="rank rank-{{($k+11)}}">{{($k+11)}}</span>
@if($r->image)
													<img src="{{$r->image}}" width="64px" height="64px" onerror="this.src='/media/images/eee.jpg';">
@else
			                    <div style="background-color:#eeeeee;width:64px;height:64px;"></div>
@endif
			                </div>
			                <div class="ml-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                       <span class="album-info">{{$r->album_path}}</span>
			                    </p>
			                </div>
			            </div>
			        </a>
@endforeach
			    </div>
			</div>

		</div>

		<div class="col-md-6 col-xl-4">
	
			<div class="block block-rounded bg-gd-primary">
			    <div class="block-content">
			        <p class="text-white text-uppercase font-size-sm font-w700 text-center mt-2 mb-4">
			           21 - 30 RANK
			        </p>

@foreach ($third_arr as $k=>$r)
			        <a class="block block-rounded block-link-rotate bg-black-10 mb-2" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="item">
<span class="rank rank-{{($k+21)}}">{{($k+21)}}</span>
@if($r->image)
													<img src="{{$r->image}}" width="64px" height="64px" onerror="this.src='/media/images/eee.jpg';">
@else
			                    <div style="background-color:#eeeeee;width:64px;height:64px;"></div>
@endif
			                </div>
			                <div class="ml-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                        <span class="album-info">{{$r->album_path}}</span>
			                    </p>
			                </div>
			            </div>
			        </a>
@endforeach
			    </div>
			</div>

		</div>


	</div>
</div>

<!-- END Page Content -->

@endsection
@section('js_after')
<!-- Page JS Plugins -->
<script src="/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

@endsection