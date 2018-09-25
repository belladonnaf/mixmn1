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

		public function reorder(Reqest $request)
		{
		
			$str_ids = $request->post('ids');
			$arr_ids = json_decode($str_ids);
			var_dump($arr_ids);
	
		}

}


