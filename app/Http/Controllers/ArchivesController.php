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

    public function show($album_id)
    {   
				
    }

}


