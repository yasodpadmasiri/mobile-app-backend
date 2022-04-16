<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Auth;

 use UploadImage;

class UserAPIController extends Controller
{
     /**
     * Registration Req
     */
    public function register(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();

                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{

                $emailExist = User::where('email',$request->email)->get();

                if(count($emailExist)){
                    return response(\Helpers::sendFailureAjaxResponse('Email already used'));
                }else if(strlen($post['phone'])<10){
                    return response(\Helpers::sendFailureAjaxResponse('Please enter at least 10 digit for phone.'));
                }else if(strlen($post['phone'])>10){
                    return response(\Helpers::sendFailureAjaxResponse('Please enter 10 digit for phone.'));
                }else if(strlen($post['name'])<4){
                    return response(\Helpers::sendFailureAjaxResponse('Please enter at least 4 charater for username.'));
                }else if(strlen($post['password'])<=7){
                    return response(\Helpers::sendFailureAjaxResponse('Password must be 8 digit.'));
                }
                
                if(isset($post['photo']) && $post['photo']!=''){
                    $images = $post['photo'];
                    $post['photo'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $img = \UploadImage::make($images->getRealPath());
                    $destinationPath = public_path('/user');
                    $images->move($destinationPath, $post['photo']);
                }

                $img = '';

                if(isset($post['photo']) && $post['photo'] !=''){
                    $img = $post['photo'];
                }
                if(isset($request->phone) && $request->phone !=''){
                    $phone = $request->phone;
                }else{
                    $phone = "";
                }

                $user = User::create([
                    'type'=>'user',
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender'=>$request->gender,
                    'photo'=>$img,
                    'phone'=>$phone,
                    'active' => 1,
                    'password' => bcrypt($request->password),
                ]);
                $data = $user;
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                $data->api_token = $token;
                return response(\Helpers::sendSuccessAjaxResponse('Registerd Successfully.',$data));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        // dd($request);
        try{
            $user = User::where('email',$request->email)->first();
            // dd($user);
            if($user){
                if($user->type=='user'){
                    $data = [
                        'email' => $request->email,
                        'password' => $request->password
                    ];
                    if (auth()->attempt($data)) {
                        // dd($data);
                        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                        // $token =Auth::user()->createToken('LaravelAuthApp')->accessToken;
                        // dd($token);
                        $data = auth()->user();
                        // dd($data->device_token);
                        $data->api_token = $token;
                        return response(\Helpers::sendSuccessAjaxResponse('Registerd Successfully.',$data));
                    }else{
                        return response(\Helpers::sendFailureAjaxResponse('Unauthorised'));
                    }
                }else{
                    return response(\Helpers::sendFailureAjaxResponse('Please use valid email and password'));
                }
            }else{
                return response(\Helpers::sendFailureAjaxResponse('User Not found'));
            }            
        }catch(\Exception $ex){
            return response(\Helpers::sendFailureAjaxResponse('Unauthorised'.$ex));
        }
    }

    /**
     * forgetPassword
     */
    public function forgetPassword(Request $request)
    {

        try {
            $post = $request->all();
            if(!empty($post)){
                $emailexist = User::where('email',$post['email'])->first();
                if($emailexist){
                    $otp = rand(1000,9999); 
                    //todo Email
                    $data = array();
                    $data['otp'] = $otp;
                    $c = \Helpers::sendEmail('emails.opt',$data,$emailexist->email,'','Otp','Bloggit','','');
                    return response(\Helpers::sendSuccessAjaxResponse('OTP Successfully sent.',$data));
                }else{
                    return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
                }
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

    /**
     * resetPassword
     */
    public function resetPassword(Request $request)
    {
        try {
            $post = $request->all();
            if(!empty($post)){
                $inject = array();
                if(isset($post['password']) && $post['password'] != ''){
                    $inject['password'] = bcrypt($post['password']);
                }
                 $user = User::where('email',$post['email'])->first();
                
                 User::where('id',$user->id)->update($inject);
                return response(\Helpers::sendSuccessAjaxResponse('Password Successfully reset.',$post));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }
    /**
     * updateProfile
     */
    public function updateProfile(Request $request)
    {


        try {
            $post = $request->all();
            if(!empty($post)){

                $emailexist = User::where('email',$post['email'])->where('id','!=',$post['id'])->get();

                if(count($emailexist)){
                    return response(\Helpers::sendFailureAjaxResponse('Email already taken'));
                }

                if(isset($post['photo']) && $post['photo']!=''){
                    $images = $post['photo'];
                    $post['photo'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $img = \UploadImage::make($images->getRealPath());
                    $destinationPath = public_path('/user');
                    $images->move($destinationPath, $post['photo']);
                }
                $img = '';
                $inject = array();
                if(isset($post['photo']) && $post['photo'] !=''){
                    $img = $post['photo'];
                    $inject['photo'] =$post['photo'];
                }

                if(isset($post['name']) && $post['name'] != ''){
                    $inject['name'] = $post['name'];
                }

                if(isset($post['email']) && $post['email'] != ''){
                    $inject['email'] = $post['email'];
                }

                if(isset($post['gender']) && $post['gender'] != ''){
                    $inject['gender'] = $post['gender'];
                }
                if(isset($post['phone']) && $post['phone'] != ''){
                    $inject['phone'] = $post['phone'];
                }
                if(isset($post['password']) && $post['password'] != ''){
                    $inject['password'] = $post['password'];
                }
                User::where('id',$post['id'])->update($inject);
                $data = User::where('id',$post['id'])->first();
                return response(\Helpers::sendSuccessAjaxResponse('Profile updated successfully.',$data));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

    /**
     * Update Profile Picture 
     */
    public function updateProfilePicture(Request $request)
    {
        try {
            $post = $request->all();
            if(!empty($post)){
                if(isset($_FILES['photo'])){
                    $image = $_FILES['photo'];
                    $name = time() . rand() .'.png';
                    $imagepath = public_path('upload/user/');
                    $tmp_name = $_FILES["photo"]["tmp_name"];
                    $path = $imagepath.$name;
                    $post['photo'] = url('upload/user/').'/'.$name;
                    move_uploaded_file($_FILES['photo']['tmp_name'], $path);
                }
                $img = '';
                $inject = array();
                if(isset($post['photo']) && $post['photo'] !=''){
                    $img = $post['photo'];
                    $inject['photo'] =$post['photo'];
                }
                User::where('id',$post['id'])->update($inject);
                $data = User::where('id',$post['id'])->first();    
                return response(\Helpers::sendSuccessAjaxResponse('Profile updated successfully.',$data));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }


    /**
     * updateProfile
     */
    public function getProfile(Request $request)
    {
        try {
            $post = $request->all();
            if(isset($post['id'])){
                $userData = User::where('id',$post['id'])->first();
                return response(\Helpers::sendSuccessAjaxResponse('Profile updated successfully.',$userData));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }
    /**
     * updateProfile
     */
    public function updateToken(Request $request)
    {

        try {
            $post = $request->all();
            if(!empty($post)){
                $inject = array();

                if(isset($post['device_token']) && $post['device_token'] != ''){
                    $inject['device_token'] = $post['device_token'];
                }
                User::where('id',$post['id'])->update($inject);
                $data = User::where('id',$post['id'])->first();
                return response(\Helpers::sendSuccessAjaxResponse('Device updated successfully.',$data));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

    /**
     * Delete Account
     */
    public function deleteAccount(Request $request)
    {
        try {
            $post = $request->all();
            if(!empty($post)){
                User::where('id',$post['id'])->delete();
                //$data = User::where('id',$post['id'])->first();
                return response(\Helpers::sendSuccessAjaxResponse('Account deleted succefully.',[]));
            }else{
                return response(\Helpers::sendFailureAjaxResponse('Something went wrong'));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

     /**
     * Registration Req
     */
    public function socialMediaLogin(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'name' => 'required|min:4',
                'email' => 'required',
                //'password' => 'required|min:6',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();

                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $emailexist = User::where('email',$post['email'])->first();
                if($emailexist){
                    $data = User::where('email',$post['email'])->first();
                    if($data->photo==null){
                        $data->photo = url('upload/user/default.png');
                    }
                    return response(\Helpers::sendSuccessAjaxResponse('Logged in Successfully.',$data));
                    //return response(\Helpers::sendSuccessAjaxResponse('Login Succefully.',$emailexist));
                }else{
                    if(isset($request->phone) && $request->phone !=''){
                        $phone = $request->phone;
                    }else{
                        $phone = "";
                    }
                    if(isset($request->fb_token) && $request->fb_token !=''){
                        $fb_token = $request->fb_token;
                    }else{
                        $fb_token = "";
                    }
                    if(isset($request->device_token) && $request->device_token !=''){
                        $device_token = $request->device_token;
                    }else{
                        $device_token = "";
                    }
                    $image = "https://graph.facebook.com/v2.9/".$request->fb_id."/picture?width=360&height=360";
                    $content = file_get_contents($image);
                    //Store in the filesystem.
                    $name = time() . rand() .'.png';
                    $imagepath = public_path('upload/user/');
                    $fp = fopen($imagepath.''.$name, "w");
                    fwrite($fp, $content);
                    fclose($fp);
                    $saved_image = url('upload/user/').'/'.$name;
                    //move_uploaded_file($_FILES['photo']['tmp_name'], $path);

                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        //'gender'=>$request->gender,
                        'photo'=>$saved_image,
                        //'phone'=>$phone,
                        'fb_token'=>$request->fb_token,
                        //'device_token'=>$device_token,
                        'active' => 1,
                    ]);
                    $data = $user;
                    $token = $user->createToken('LaravelAuthApp')->accessToken;
                    $data->api_token = $token;
                    if($data->photo==null){
                        $data->photo = url('upload/user/default.png');
                    }
                    return response(\Helpers::sendSuccessAjaxResponse('Registered Successfully.',$data));
                }             
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

}
