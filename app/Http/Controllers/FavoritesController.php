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

      return view('favorites.index',compact('arr_rs'));

		}


}


