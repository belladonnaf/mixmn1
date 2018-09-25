@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<style>
ul.source, ul.target {
  min-height: 50px;
  margin: 0px 25px 10px 0px;
  padding: 2px;
  border-width: 1px;
  border-style: solid;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  list-style-type: none;
  list-style-position: inside;
}
ul.source {
  border-color: #f8e0b1;
}
ul.target {
  border-color: #add38d;
}
.source li, .target li {
  margin: 5px;
  padding: 5px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}
.source li {
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  color: #c09853;
}
.target li {
  background-color: #ebf5e6;
  border: 1px solid #d6e9c6;
  color: #468847;
}
.sortable-dragging {
  border-color: #ccc !important;
  background-color: #fafafa !important;
  color: #bbb !important;
}
.sortable-placeholder {
  height: 40px;
}
.source .sortable-placeholder {
  border: 2px dashed #f8e0b1 !important;
  background-color: #fefcf5 !important;
}
.target .sortable-placeholder {
  border: 2px dashed #add38d !important;
  background-color: #f6fbf4 !important;
}
</style>
@endsection

@section('content')

<!-- Page Content -->
<div class="content">

	<div class="row">
		<div class="col-md-6 col-xl-6">
			<div class="album-list-wrapper">
		    <ul class="source connected">
@foreach($arr_rs as $r)
		      <li>{{$r->album_path}}</li>
@endforeach
		    </ul>
			</div>
		</div>
		<div class="col-md-6 col-xl-6">
			<div class="play-list-wrapper">
		    <ul class="target connected">
		    </ul>
			</div>
		</div>
</div>

<!-- END Page Content -->

@endsection
@section('js_after')
<script src="/js/plugins/html5sortable/jquery.sortable.min.js"></script>
<script type="text/javascript">
  jQuery(function () {
    jQuery(".source, .target").sortable({
      connectWith: ".connected"
    });
  });
</script>
@endsection