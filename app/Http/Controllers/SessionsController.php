<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{   

    public function create(Request $request)
    {   
			$site_status = DB::select('select * from site_status limit 0,1')[0];
      return view('members.login',compact('site_status'));
		}

    public function store(Request $request)
    {   
				
				$sql = " select user_pk as cnt from members where useremailid = ".esc_sql($request->get('email'))." and password = ".esc_sql($request->get('password'))." and service_enddate > NOW() and status = 1 and level > 1 limit 0,1";

				if(DB::select($sql)[0]){
					$user_pk = DB::select($sql)[0]->cnt;
				}
	
        if (!$user_pk) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        } else {

					$request->session()->put('login_id', $user_pk);

					$sql = " select favor_ui from members where user_pk = ".$user_pk;

					if(DB::select($sql)[0]){
						$favor_ui = DB::select($sql)[0]->favor_ui;
					}
	
					if(!$favor_ui){
		        return redirect()->to('/settings/ui');
					} else if($favor_ui == 1){
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

    public function destroy(Request $request)
    {   
//        auth()->logout();
				$request->session()->flush();
        return redirect()->to('/');
    }

    //
}


