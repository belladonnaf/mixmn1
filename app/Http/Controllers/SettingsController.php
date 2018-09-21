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
					return redirect()->to('/search/index');
				} else if($favor_ui == 4){
					return redirect()->to('/favorites/index');
				}
				
    }

}


