<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{   

    public function index(Request $request)
    {   
			
			$sql = " select a.order_num, b.* from mp3_favorite a inner join album_info_tbl b on a.album_id = b.album_id where user_id = ? order by order_num asc ";
			$arr_rs = DB::select($sql,[$request->session()->get("login_id")]);
			$cnt_rs = count($arr_rs);

      return view('favorites.index',compact('arr_rs','cnt_rs'));

		}


    public function setFavorite(Request $request,$album_id)
    {       

			if(!is_numeric($album_id)){
				exit;
			}

			if(!$request->session()->get("login_id")){
				exit;
			}

			if(!$album_id){
				$album_id = 0;
			}
			
			if(!$track_id){
				$track_id = 0;
			}
			
			$i=0;
			
			$sql = " select ifnull(max(order_num)+1,1) as max_num from mp3_favorite where user_id = ".$request->session()->get("login_id");
			$max_num = DB::select($sql)[0]->max_num;
			
			$sql = " select count(*) cnt from mp3_favorite where album_id = ? and user_id = ? ";			
			$check_dupe = DB::select($sql,[$album_id,$request->session()->get("login_id")])[0]->cnt;
			
			if($check_dupe){
				$sql = " update mp3_favorite set order_num = ? where album_id = ? and user_id = ? ";
				DB::update($sql,[$max_num,$album_id,$request->session()->get("login_id")]);
			} else {
				$sql = " insert into mp3_favorite ( user_id, track_id, album_id, order_num, reg_date ) values ( ".$request->session()->get("login_id").", ".$track_id.",".$album_id.",".$max_num.", NOW() )";
				DB::insert($sql);
			}

			$sql = " select * from album_info_tbl where album_id = ? ";
			$album_info = DB::select($sql,[$album_id])[0];

			return response()->json($album_info,200);

		}

		public function delete(Request $request,$album_id)
		{

			if(!is_numeric($album_id)){
				exit;
			}

			if(!$request->session()->get("login_id")){
				exit;
			}

			$sql = " delete from mp3_favorite where user_id = ? and album_id = ? ";
			
			DB::delete($sql,[$request->session()->get("login_id"),$album_id]);
		
			return back();

		}

		public function reorder(Request $request)
		{
		
			$str_ids = $request->get('ids');
			$arr_ids = json_decode($str_ids);
			$login_id = $request->session()->get("login_id");

			foreach($arr_ids as $k=>$v){
				$sql = " update mp3_favorite set order_num = ? where user_id = ? and album_id = ? ";
				DB::update($sql,[($k+1),$login_id,$v]);
			}

			$msg = "ok";
			return response()->json($msg,200);
	
		}

		public function createStreamset(Request $request)
		{

			$str_ids = $request->get('ids');
			$arr_ids = json_decode($str_ids);
			$login_id = $request->session()->get("login_id");
			$set_alias = $request->get('set_alias');

			$sql = " select ifnull(max(list_order)+1,1) max_list_order from mp3_stream_set where user_id = ? ";
			$max_list_order = DB::select($sql,[$login_id])[0]->max_list_order;
		
			$sql = " INSERT INTO mp3_stream_set (user_id, set_alias, list_order, reg_date) VALUES (?, ?, ?, NOW() ); ";
			DB::insert($sql,[$login_id,$set_alias,$max_list_order]);
			$set_id = DB::getPdo()->lastInsertId();

			foreach($arr_ids as $k=>$v){

				$sql = " select track_id from track_tbl where album_id = ? ";
				$arr_track = DB::select($sql,[$v]);
				$arr_track_id = array();

				foreach($arr_track as $t){
					$j=$j+1;
					$sql = " INSERT INTO mp3_stream_set_detail (user_id, set_id, list_order, album_id, track_id, is_hide ) VALUES ( ?, ?, ?, ?, ?, 0 );";

					DB::insert($sql,[$login_id,$set_id,$j,$v,$t->track_id]);
				}

			}						

			$msg = "ok";
			return response()->json($msg,200);

		}
		
		public function streamSet(Request $request)
		{

			$login_id = $request->session()->get("login_id");

			$sql = " select * from mp3_stream_set where user_id = ? order by list_order asc ";
			$arr_set = DB::select($sql,[$login_id]);
			$str_set = json_encode($arr_set);
			$arr_set = json_decode($str_set,1);
			$cnt_set = count($arr_set);
			
			foreach($arr_set as $k=>$r){
				
				$sql = " select * from mp3_stream_set_detail where set_id = ? order by list_order asc ";
				$arr_details = DB::select($sql,[$r['id']]);

				foreach($arr_details as $k2=>$r2){

					$sql = " select album_path from album_info_tbl where album_id = ? ";
					$album_path = DB::select($sql,[$r2->album_id])[0]->album_path;
	
					$sql = " select filename from track_tbl where track_id = ? ";
					$filename = DB::select($sql,[$r2->track_id])[0]->filename;

					$arr_details[$k2]->album_path = $album_path;
					$arr_details[$k2]->filename = $filename;

				}

				$arr_set[$k]['details'] = $arr_details;
				$arr_set[$k]['total_details'] = count($arr_details);
				
			}
			
      return view('favorites.stream-set',compact('arr_set','cnt_set'));
			
		}
		
		public function deleteStreamDetail(Request $request)
		{

			$detail_id = $request->get('detail_id');
			$set_id = $request->get('set_id');
			$login_id = $request->session()->get("login_id");

			$sql = " delete from mp3_stream_set_detail where user_id = ? and set_id = ? and id = ? ";
			DB::delete($sql,[$login_id,$set_id,$detail_id]);

			$msg = "ok";
			return response()->json($msg,200);

		}

		public function getStreamSetJson(Request $request,$set_id){
			

			if(!is_numeric($set_id)){
				exit;
			}

			if(!$request->session()->get("login_id")){
				exit;
			}
			

			$sql = " select * from mp3_stream_set_detail where user_id = ? and set_id = ? ";
			$arr_sd = DB::select($sql,[$request->session()->get("login_id"),$set_id]);
			
			foreach($arr_sd as $k=> $sd){
	
				$track_id = $sd->track_id;

				$album_id = $sd->album_id;

				$sql = " call get_img_path('".$album_id."')";
				$row = DB::select($sql)[0];

				if($row){
					$img_path = $row->img_path;
				}

				$sql = " call get_album_pic(".$album_id.") ";
				$arr_rs = DB::select($sql);
				$str_rs = json_encode($arr_rs);
				$arr_rs = json_decode($str_rs,1);
				$cnt_img = count($arr_rs);
				$arr_img = array();
				
				if($arr_rs) {
					foreach($arr_rs as $k=> $row) { 
						$url = $img_path."/".$row['filename'];
						$row['image'] = $url;
						$arr_img[] = $row;
					}
				}
				
				$sql = " call get_album_path($album_id);";
				
				if(DB::select($sql)[0]){
					$album_path = DB::select($sql)[0]->album_path;
				}
			
				$sql = " select * from track_tbl where track_id = ? ";
				$row = DB::select($sql,[$track_id])[0];

				$track_id = $row->track_id;
				$length_min = floor($row->lengths / 60);
				$length_sec = $row->lengths % 60;
				$mbytes = round($row->files *10/ (1024*1024))/10;
				$frequency = $row->frequency / 1000;
				$filename = $row->filename;
				$artist = $row->artist;
				
				$sql = " select useremailid, password from members where user_pk = ".$request->session()->get("login_id")." limit 0,1";
				$user_auth = DB::select($sql)[0];
				$uid = $user_auth->useremailid;
				$pwd = $user_auth->password;

				$sql = " call get_ftp_info('$track_id')";
				$row1 = DB::select($sql)[0];
				
				$ftp_ip = $row1->server_ip;
				$port = 80;

				$ftp_con = "http://".myUrlEncode($uid).":".myUrlEncode($pwd)."@$ftp_ip:$port";

				$sql = " select album_path, DATE_FORMAT(release_date,'%Y') as release_year, DATE_FORMAT(release_date,'%m%d') as release_mmdd from album_info_tbl where album_id = $album_id ";
				$row2 = DB::select($sql)[0];
				$str_row2 = json_encode($row2);
				$row2 = json_decode($str_row2,1);

				$album_path = $row2['album_path'];
				$release_year = $row2['release_year'];
				$release_mmdd = $row2['release_mmdd'];

				$src_path = "/MP3/$release_year/$release_mmdd/$album_path/$filename";
			
				$mp3_path = "$ftp_con$src_path"; 
				
				if( $arr_img[0]['image'] ){
					$img_url = $arr_img[0]['image'];
				} else {
					$img_url = 'http://mix.mn1.net/media/images/vol.gif';
				}

				$new_track[$k] = array(
					"track_id" => $track_id,
					"length_min" => $length_min,
					"length_sec" => $length_sec,
					"mbytes" => (round($mbytes*100)/100).'',
					"frequency" => (round($frequency*100)/100).'',
					"filename" => $filename,
					"mp3_path" => $mp3_path,
					"artist" => $artist,
					"img_url" => $img_url
				);

			}

			$sql = " INSERT INTO mp3_album_log (login, album_id, server_ip, reg_date, ip) VALUES (?, ?, ?, NOW(), ?); ";
			DB::insert($sql,[$request->session()->get("login_id"),$album_id,$ftp_ip,$_SERVER['REMOTE_ADDR']]);

			return response()->json($new_track,200);
					
		}

}


