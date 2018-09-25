<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function storeUI(Request $request)
    {   
				
				$sql = ' update members set favor_ui = ? where user_pk = ? ';
				$favor_ui = $request->get('fav');
				$login_id = $request->session()->get('login_id');
				DB::update($sql,array($favor_ui,$login_id));

				if($favor_ui == 1){
					return redirect()->to('/recommended/index');
				} else if($favor_ui == 2){
					return redirect()->to('/archives/index');
				} else if($favor_ui == 3){
					return redirect()->to('/search');
				} else if($favor_ui == 4){
					return redirect()->to('/favorites/index');
				}
				
    }

    public function setMyUI($ui_id, Request $request){
				$sql = ' update members set favor_ui = ? where user_pk = ? ';
				$login_id = $request->session()->get('login_id');
				DB::update($sql,array($ui_id,$login_id));
				$ret = array("result"=>"ok");
				return response()->json($ret,200);
    }

    public function setMyGenre($genre_group_id, Request $request){
				$sql = ' update members set favor_genre = ? where user_pk = ? ';
				$login_id = $request->session()->get('login_id');
				DB::update($sql,array($genre_group_id,$login_id));
				$ret = array("result"=>"ok");
				return response()->json($ret,200);
    }

}


