<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login/main', [
            'theme' => 'light',
            'page_name' => 'auth-login',
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();        
        if($user){
            //echo "111";
            if($user->type=='admin'){
                if (!\Auth::attempt([
                    'email' => $request->email, 
                    'password' => $request->password
                ])) {
                    throw new \Exception('Wrong email or password.');
                }else{
                    return Response::json(['status' => true, 'message' => '','data'=>[]], '200');
                }
            }else{
                return Response::json(['status' => false, 'message' => 'Please use admin login credentials.','data'=>[]], '200');
                //throw new \Exception('Please use admin login credentials.');
            }
        }else{
            return Response::json(['status' => false, 'message' => 'Credentials not found.','data'=>[]], '200');
            //echo "000";
            //throw new \Exception('Credentials not found.');
        }        
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
