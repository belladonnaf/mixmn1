@extends('layouts.backend')
<!-- Page JS Plugins CSS -->

@section('css_after')
@endsection

@section('content')

<!-- Page Content -->
<div class="content">

	<div class="row">
		<div class="col-md-6 col-xl-6">

			<div class="block block-bordered">
			  <div class="block-header block-header-default">
			      <h3 class="block-title">Stream Set List</h3>
			  </div>
			  <div class="block-content">
			      <p>Click play icon to listen to the music, Click checkbox to edit the stream set in detail.</p>
			  </div>
			</div>
                            
			<div class="album-list-wrapper bg-white">

				<div class="js-task-list">

          <!-- Task -->
@foreach($arr_set as $r)
          <div class="js-task block block-rounded block-fx-pop block-fx-pop mb-2 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">
              <table class="table table-borderless table-vcenter mb-0">
                  <tbody><tr>
                      <td class="text-center pr-0" style="width: 38px;">
                          <div class="js-task-status custom-control custom-checkbox custom-checkbox-rounded-circle custom-control-primary custom-control-lg">
                              <input type="checkbox" class="custom-control-input open-detail" id="set-id-{{$r['id']}}" name="set-id-{{$r['id']}}" data-value="{{ json_encode($r['details']) }}">
                              <label class="custom-control-label" for="set-id-{{$r['id']}}"></label>
                          </div>
                      </td>
                      <td class="js-task-content font-w600 pl-0">
                      {{$r['set_alias']}}
                      </td>
                      <td class="text-right" style="width: 100px;">
                          <button type="button" class="js-task-star btn btn-sm btn-link text-primary btn-play-music" data-id="{{$r['id']}}">
                              <i class="fas fa-play fa-fw"></i>
                          </button>
                          <button type="button" class="js-task-remove btn btn-sm btn-link text-danger btn-delete-set" data-id="{{$r['id']}}">
                              <i class="fa fa-times fa-fw"></i>
                          </button>
                      </td>
                  </tr>
              </tbody></table>
          </div>
@endforeach
          <!-- END Task -->

     	 </div>
                                
			</div>
			<div id="playlist" class="playlist"></div>
		</div>
		<div class="col-md-6 col-xl-6">

			<div class="block block-bordered">
			  <div class="block-header block-header-default">
			      <h3 class="block-title">Detail Browser</h3>
			  </div>
			  <div class="block-content">
			      <p>You can queue multiple albums and listen in series.</p>
			  </div>
			</div>

			<div class="play-list-wrapper bg-white">
		    <ul class="target p-0">

		    </ul>
			</div>

			<div class="button-wrapper mt-1">
				<button type="button" class="btn btn-lg btn-success w-100" id="btn-create-stream-set">Save Stream Set</button>
			</div>

		</div>
</div>

<!-- END Page Content -->

@endsection
@section('js_after')
<!-- Page JS Plugins -->
<script src="/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>jQuery(function(){ Dashmix.helpers('notify'); });</script>

<script src="/js/plugins/html5sortable/jquery.sortable.min.js"></script>

<script type="text/javascript">
	
	var arr_stream_set = [];

  jQuery(function () {
    jQuery(".target").sortable({
    });
  });

	jQuery(".btn-play-music").click(function(){
			
		var set_id = jQuery(this).attr("data-id");
		var api_url = 'http://mix.mn1.net/api/stream-set/' + set_id;

	  axios.get(api_url).then(response => {
	
			if( response.data == 'ok' ){
				vm1.addPlaylist(data);
			}

		});

	});
	
	jQuery(".open-detail").click(function(){

		jQuery(".open-detail").prop("checked",false);
		jQuery(this).prop("checked",true);

		var details = jQuery(this).attr("data-value");
		var obj_details = JSON.parse(details);
	
		jQuery(".target").html('');
	
		var ss = '';
		jQuery.each(obj_details, function(i,obj){
	    ss = ss + '      <div class="js-task block block-rounded block-fx-pop block-fx-pop mb-2 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">';
	    ss = ss + '          <table class="table table-borderless table-vcenter mb-0">';
	    ss = ss + '              <tbody><tr>';
	    ss = ss + '                  <td class="js-task-content font-w600">';
	    ss = ss + '                  <span class="track-info">[' + obj.album_path + '] ' + obj.filename + '</span>';
	    ss = ss + '                  </td>';
	    ss = ss + '                  <td class="text-right" style="width: 100px;">';
	    ss = ss + '                      <button type="button" class="js-task-star btn btn-sm btn-link text-primary btn-play-music" data-id="' + obj.id + '">';
	    ss = ss + '                          <i class="fas fa-play fa-fw"></i>';
	    ss = ss + '                      </button>';
	    ss = ss + '                      <button type="button" class="js-task-remove btn btn-sm btn-link text-danger btn-delete-id" data-id="' + obj.id + '" data-set-id="' + obj.set_id + '">';
	    ss = ss + '                          <i class="fa fa-times fa-fw"></i>';
	    ss = ss + '                      </button>';
	    ss = ss + '                  </td>';
	    ss = ss + '              </tr>';
	    ss = ss + '          </tbody></table>';
	    ss = ss + '      </div>';
		});

		jQuery(".target").append(ss);
    jQuery(".target").sortable({
    });
		jQuery(".js-task-remove").click(function(){
			 ftask   = jQuery(this).closest('.js-task');
			 ftaskId = ftask.data('task-id');
       jQuery('.js-task[data-task-id="' + taskId + '"]').remove();
		});
			
	});
	
	jQuery("#btn-save-stream-set").click(function(){
		
		jQuery("ul.target li").each(function(){
			arr_stream_set.push( jQuery(this).attr("data-track-id") );
		});

		if(arr_stream_set.length < 1){
			Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'At least one of tracks is required.'});
		}

		var api_url = 'http://mix.mn1.net/api/favorites/save-stream-set';
		var str_stream_set = JSON.stringify(arr_stream_set); 
	  axios.post(api_url,{ ids: str_stream_set }).then(response => {
	
			if( response.data == 'ok' ){
				Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'Stream set saved.'});
			}

		});

	});

</script>
@endsection