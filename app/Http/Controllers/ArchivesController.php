<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class ArchivesController extends Controller
{   

    public function index($f_date='',Request $request)
    {   

			if(!$f_date){
				$f_date = $request->get('f_date');
			}

			if(!$f_date){
				$sql = " select DATE_FORMAT(max(release_date),'%Y-%m-%d') max_date from album_info_tbl ";
				if(DB::select($sql)[0]){
					$f_date = DB::select($sql)[0]->max_date;
				}
			} else {
				$f_date = substr($f_date,0,10);
			}

			$sql = " call get_total('album_id','album_info_tbl',' release_date = \'$f_date\'');";

			if(DB::select($sql)[0]){
				$RecordCount = DB::select($sql)[0]->cnt_total;					
			} else{
				$RecordCount = 0;
			}

			$sql = " call get_record('album_id, album_path, genre, group_name, file_size, file_cnt, is_online, DATE_FORMAT(release_date,\'%Y-%m-%d\') as release_date, DATE_FORMAT(uploaded_time,\'%Y-%m-%d %H:%i\') as uploaded_time','album_info_tbl',' release_date = \'$f_date\'','album_id',0,1000)";
			$obj_rs = DB::select($sql);
			
			$str_rs = json_encode($obj_rs);
			$arr_rs = json_decode($str_rs,1);

      return view('archives.index',compact('f_date','RecordCount','arr_rs'));

		}

    public function genreIndex()
    {   

			$sql = " call get_genre_index() ";
			
			$obj_rs = DB::select($sql);
			$str_rs = json_encode($obj_rs);
			$arr_rs = json_decode($str_rs,1);
			
      return view('archives.genre.index',compact('arr_rs'));
				
    }

    public function genreList($f_genre)
    {   

			$sql = " call get_total('album_id','album_info_tbl',' genre = \'$f_genre\' ');";

			if(DB::select($sql)[0]){
				$RecordCount = DB::select($sql)[0]->cnt_total;					
			} else{
				$RecordCount = 0;
			}

			$sql = " call get_record(' DATE_FORMAT(release_date,\'%Y-%m-%d\') as release_date, album_id, album_path, genre, group_name, file_size, file_cnt, is_online, DATE_FORMAT(uploaded_time,\'%H:%i\') as uploaded_time','album_info_tbl',' genre = \'$f_genre\' ',' release_date desc ',0,2000)";
			$obj_rs = DB::select($sql);
			
			$str_rs = json_encode($obj_rs);
			$arr_rs = json_decode($str_rs,1);

      return view('archives.genre.list',compact('f_genre','RecordCount','arr_rs'));
				
    }

    public function groupIndex()
    {   

			$sql = " call get_group_index() ";
			
			$obj_rs = DB::select($sql);
			$str_rs = json_encode($obj_rs);
			$arr_rs = json_decode($str_rs,1);
			
      return view('archives.group.index',compact('arr_rs'));
				
    }

    public function groupList($f_group)
    {   

			$sql = " call get_total('album_id','album_info_tbl',' group_name = \'$f_group\' ');";

			if(DB::select($sql)[0]){
				$RecordCount = DB::select($sql)[0]->cnt_total;					
			} else{
				$RecordCount = 0;
			}

			$sql = " call get_record(' DATE_FORMAT(release_date,\'%Y-%m-%d\') as release_date, album_id, album_path, genre, group_name, file_size, file_cnt, DATE_FORMAT(uploaded_time,\'%H:%i\') as uploaded_time','album_info_tbl',' group_name = \'$f_group\' ',' release_date desc ',0,2000)";
			$obj_rs = DB::select($sql);
			
			$str_rs = json_encode($obj_rs);
			$arr_rs = json_decode($str_rs,1);

      return view('archives.group.list',compact('f_group','RecordCount','arr_rs'));
				
    }

    public function show(Request $request,$album_id)
    {   

			if(!is_numeric($album_id)){
				exit;
			}

			$sql = " call get_img_path('$album_id')";
			$row = DB::select($sql)[0];

			if($row){
				$img_path = $row->img_path;
			}

			$sql = " call get_album_pic(".$album_id.") ";
			$arr_rs = DB::select($sql,[$album_id]);
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
			
			$sql = " call get_track_info($album_id)";
			$arr_track = DB::select($sql);
			$str_track = json_encode($arr_track);
			$arr_track = json_decode($str_track,1);
			$new_track = array();
			
			foreach($arr_track as $k=> $row){

				$track_id = $row['track_id'];
				$length_min = floor($row['lengths'] / 60);
				$length_sec = $row['lengths'] % 60;
				$mbytes = round($row['files'] *10/ (1024*1024))/10;
				$frequency = $row['frequency'] / 1000;
				$filename = $row['filename'];
				$artist = $row['artist'];
				
				$sql = " select useremailid, password from members where user_pk = ".$request->session()->get("login_id")." limit 0,1";
				$user_auth = DB::select($sql)[0];
				$uid = $user_auth->useremailid;
				$pwd = $user_auth->password;

				$ftp_con = "http://".$uid.":".$pwd."@$ftp_ip:$port";

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
					"mbytes" => $mbytes,
					"frequency" => $frequency,
					"filename" => $filename,
					"mp3_path" => $mp3_path,
					"artist" => $artist,
					"img_url" => $img_url
				);
				
				list($artist) = explode('-',$album_path);
				$artist = str_replace('_',' ',$artist);
				$artist = trim($artist);
				$artist = str_replace(' ','_',$artist);

				$sql = " select * from album_info_tbl where album_path like ? order by release_date desc limit 0,10";
				$arr_rel = DB::select($sql,[$artist.'%']);
				$arr_css = ['bg-gd-primary','bg-gd-dusk','bg-gd-fruit','bg-gd-aqua','bg-gd-sublime','bg-gd-sea','bg-gd-leaf','bg-gd-lake','bg-gd-sun','bg-gd-dusk-op','bg-gd-fruit-op','bg-gd-aqua-op','bg-gd-sublime-op','bg-gd-sea-op','bg-gd-leaf-op','bg-gd-lake-op','bg-gd-sun-op'];
				$arr_css = randomize_css($arr_css,6);
			}

      return view('album.show',compact('album_id','arr_img','album_path','new_track','arr_rel','arr_css'));
				
    }
    
    public function getSearch(Request $request)
    {       
			
			$keyword = $request->input("keyword");

			if(!($keyword)){

	      return view('album.search');

			} else {

				$sql = " select * from album_info_tbl where album_path like ? order by release_date desc limit 0,100";
				$arr_rs = DB::select($sql,['%'.$keyword.'%']);
				$str_rs = json_encode($arr_rs);
				$arr_rs = json_decode($str_rs,1);

				$cnt_rs = count($arr_rs);

	      return view('album.search',compact('arr_rs','cnt_rs'));

			}

		}

    public function getJson(Request $request,$album_id)
    {       

			if(!is_numeric($album_id)){
				exit;
			}

			if(!$request->session()->get("login_id")){
				exit;
			}
			
			$sql = " call get_img_path('$album_id')";
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
			
			$sql = " call get_track_info($album_id)";
			$arr_track = DB::select($sql);
			$str_track = json_encode($arr_track);
			$arr_track = json_decode($str_track,1);
			$new_track = array();
			
			foreach($arr_track as $k=> $row){

				$track_id = $row['track_id'];
				$length_min = floor($row['lengths'] / 60);
				$length_sec = $row['lengths'] % 60;
				$mbytes = round($row['files'] *10/ (1024*1024))/10;
				$frequency = $row['frequency'] / 1000;
				$filename = $row['filename'];
				$artist = $row['artist'];
				
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

}


