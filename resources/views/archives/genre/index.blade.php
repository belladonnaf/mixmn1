@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Archives _ Album Index</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active" aria-current="page">Genre Index</li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
	<div class="row">
<?php
$k= 0 ;
$k_dump = "";
$cnt_rt = count($arr_rs);

for ($i=0;$i<$cnt_rt;$i++){ 

	if ($i % 10 == 0){ 
		$k++;
		$is_finish = 0;
?>

<div class="col-xl-6">
    <!-- Default List Groups -->
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <ul class="list-group push">

							<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active" href="javascript:void(0)">
                                           {{ $arr_rs[$i]['genre_init'] }}
              </a>
<?php
		}
?>

							<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="{{route('archives.genre.base')}}/{{rawurlencode($arr_rs[$i]['genre'])}}">
								{{ $arr_rs[$i]['genre'] }}
	            </li>
              </a>
<?php
	if ($i % 10 == 9){ 
	$is_finish = 1;
?>                        
  					</ul>
				</div>
		</div>
</div>
<?php 
	}			
}

if ($is_finish == 0){ ?>
  					</ul>
				</div>
		</div>
</div>
<?php
}
?>
	</div>
</div>
<!-- END Page Content -->

@endsection
@section('js_after')
<!-- Page JS Plugins -->
<script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="/js/pages/be_tables_datatables.min.js"></script>
@endsection