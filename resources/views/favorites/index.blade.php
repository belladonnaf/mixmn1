@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
<style>
ul.source, ul.target {
  min-height: 50px;
  margin: 0px;
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

			<div class="block block-bordered">
			  <div class="block-header block-header-default">
			      <h3 class="block-title">Favorites List</h3>
			  </div>
			  <div class="block-content">
			      <p>You can arrange the order. Drag from the left panel to the right panel.</p>
			  </div>
			</div>
                            
			<div class="album-list-wrapper bg-white">
		    <ul class="source connected">
@foreach($arr_rs as $r)
		      <li data-album-id="{{$r->album_id}}">{{$r->album_path}} <button type="button" class="btn btn-primary btn-sm" data-toggle="click-ripple" onclick="javascript:window.location.href='/album/{{$r->album_id}}';">Listen</button></li>
@endforeach
		    </ul>
			</div>
			<div class="button-wrapper mt-1">
				<button type="button" class="btn btn-lg btn-warning w-100" id="btn-save-order">Save List Order</button>
			</div>
		</div>
		<div class="col-md-6 col-xl-6">

			<div class="block block-bordered">
			  <div class="block-header block-header-default">
			      <h3 class="block-title">Stream Set</h3>
			  </div>
			  <div class="block-content">
			      <p>You can queue multiple albums and listen in series.</p>
			  </div>
			</div>

			<div class="play-list-wrapper bg-white">
		    <ul class="target connected">
		    </ul>
			</div>

			<div class="button-wrapper mt-1">
				<button type="button" class="btn btn-lg btn-success w-100" id="btn-create-stream-set">Create New Stream Set</button>
			</div>

		</div>
</div>

<!-- END Page Content -->

@endsection
@section('js_after')
<script src="/js/plugins/html5sortable/jquery.sortable.min.js"></script>
<script type="text/javascript">
	
	var arr_fav_album = [];
	var arr_stream_set = [];

  jQuery(function () {
    jQuery(".source, .target").sortable({
      connectWith: ".connected"
    });
  });

	jQuery("#btn-save-order").click(function(){
		
		jQuery("ul.source li").each(function(){
			arr_fav_album.push( jQuery(this).attr("data-album-id") );
		});

		if(arr_fav_album.length < {{$cnt_rs}}){
			Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'For reorder, you should not move item to stream set.'});
		}

		var api_url = 'http://mix.mn1.net/api/favorites/reorder';
		var str_fav_album = JSON.stringify(arr_fav_album); 
	  axios.post(api_url,{ ids: str_fav_album }).then(response => {
			console.log(response.data);
		});

	});

	jQuery("#btn-create-stream-set").click(function(){
		
		jQuery("ul.target li").each(function(){
			arr_stream_set.push( jQuery(this).attr("data-album-id") );
		});

		if(arr_stream_set.length < 1){
			Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'At least one of albums is required'});
		}

		var api_url = 'http://mix.mn1.net/api/favorites/create-stream-set';
		var str_stream_set = JSON.stringify(arr_stream_set); 
	  axios.post(api_url,{ ids: str_stream_set }).then(response => {
			console.log(response.data);
		});

	});

</script>
@endsection