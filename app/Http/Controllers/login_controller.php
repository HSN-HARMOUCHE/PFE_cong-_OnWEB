<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Employee ;
use Illuminate\Support\Facades\Session;

class login_controller extends Controller
{
    public function getlogin(Request  $request){

        return view('login');

    }
    public function login(Request  $request){
    
        $user = $request->input('user_mat');
        $psw = $request->input('password');
        $user = Employee::where('mat', $user )->where('psw_cnx', $psw)->first();
     
            if($user){
                if($user->fonction=='directeur complexe' || $user->fonction=='Directeur' ){
                    Session::put('admin', $user->fonction);
                }
                Session::put('mat', $user->mat);
                Session::put('nom', $user->nom .' '.$user->prenom);
                return redirect('/accueil') ;

            }else{
                return back()->with('message', 'Les donnée est incorrect.') ;
            }
    
    }
    public function log_out(){
        Session::flush();
        return redirect('/');
    }

}
