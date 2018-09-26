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
			            1 - 10 RANK
			        </p>
<?php

var_dump($first_arr);
?>
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