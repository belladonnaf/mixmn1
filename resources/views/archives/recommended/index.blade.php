@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
endsection

@section('content')

<!-- Page Content -->
<div class="content">

	<div class="row">
		
		<div class="col-md-6 col-xl-4">
	
			<div class="block block-rounded bg-gd-primary">
			    <div class="block-content">
			        <p class="text-white text-uppercase font-size-sm font-w700 text-center mt-2 mb-4">
			            Movies Collection
			        </p>
			        <a class="block block-rounded block-link-rotate bg-black-10 mb-2" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="mr-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                        936
			                    </p>
			                    <p class="text-white-75 mb-0">
			                        in Adventure
			                    </p>
			                </div>
			                <div class="item">
			                    <i class="fa fa-2x fa-film text-primary-lighter"></i>
			                </div>
			            </div>
			        </a>
			        <a class="block block-rounded block-link-rotate bg-black-10 mb-2" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="mr-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                        260
			                    </p>
			                    <p class="text-white-75 mb-0">
			                        in Horror
			                    </p>
			                </div>
			                <div class="item">
			                    <i class="fa fa-2x fa-film text-primary-lighter"></i>
			                </div>
			            </div>
			        </a>
			        <a class="block block-rounded block-link-rotate bg-black-10" href="javascript:void(0)">
			            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
			                <div class="mr-3">
			                    <p class="text-white font-size-h3 font-w300 mb-0">
			                        763
			                    </p>
			                    <p class="text-white-75 mb-0">
			                        in Sci-fi
			                    </p>
			                </div>
			                <div class="item">
			                    <i class="fa fa-2x fa-film text-primary-lighter"></i>
			                </div>
			            </div>
			        </a>
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