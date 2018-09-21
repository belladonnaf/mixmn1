<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{   


    public function store()
    {   

				$sql = " select user_pk as cnt from members where useremailid = '".esc_sql($request->input['email'])."' and password = '".esc_sql($request->input['password'])."' and service_enddate > NOW() and status = 1 and level > 1 limit 0,1";
				$user_pk = DB::select($sql)->value('cnt');

        if (!$user_pk) {

            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);

        } else {

					$request->session()->put('login_id', $user_pk);

					$sql = " select favor_ui from members where user_pk = ".$user_pk;
					$favor_ui = DB::select($sql)->value('favor_ui');
	
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

    public function destroy()
    {   
//        auth()->logout();
				$request->session()->flush();
        return redirect()->to('/');
    }

    //
}


