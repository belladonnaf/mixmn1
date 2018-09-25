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
					$sql = " INSERT INTO mp3_stream_set (user_id, set_id, list_order, album_id, track_id, is_hide ) VALUES ( ?, ?, ?, ?, ?, 0 );";
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

				$arr_set[$k]['details'] = $arr_details;
				$arr_set[$k]['total_details'] = count($arr_details);
				
			}
			
      return view('favorites.stream-set',compact('arr_set','cnt_set'));
			
		}

}


