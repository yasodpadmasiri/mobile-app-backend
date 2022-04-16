<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class UserController extends Controller
{
    /**
     * Show User view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$layout = 'side-menu', $theme = 'light')
    {
        //dd('aaaaaaaaa');
        $User = User::getAllUsers($request->all());
        // $User = User::get()->toArray();
        // dd($User);
        return view('user.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'user'=>$User
        ]);
    }
    /**
     * Show User view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile($layout = 'side-menu', $theme = 'light')
    {
        $user = Auth::user();
        return view('profile.edit', [
            'theme' => $theme,
            'page_name' => 'edit',
            'side_menu' => array(),
            'layout' => $layout,
            'user'=>$user
        ]);
    }
    /**
     * Method to delete category
     * @param array $request post data, id
    */
    public function deleteUser(Request $request,$id)
    {
        User::where('id', $id)->delete();      
        return back()->with('success','User deleted successfully.');
    }
    /**
     * Method to change status of category
     * @param array $request post data ,id ,status
    */
    public function changeUserStatus(Request $request,$id,$status)
    {
        $post['active'] = $status;
        $post['id'] = $id;
        User::updateUser($post);         
        return back()->with('success','User status changed successfully.');  
    }

    public function uploadProfileImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/user/');
                    $images->move($destinationPath, $post['image']);
                }
                return response(\Helpers::sendSuccessAjaxResponse('Record updated.',$post['image']));
            }else{
              return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.invalid_request')));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }

    /**Update setting
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        $post = $request->all();
        if(!empty($post)){
            if (isset($post['photo_img'])) {
                unset($post['photo_img']);
            }
            unset($post['_token']);
            if($post['password']==null){
                unset($post['password']);
            }
            $id = User::where('id',$post['id'])->update($post);
            return back()->with('success','Updated successfully.');  
        }else{
            return back()->with('failure','unable to change try again.');  
        }
    }
}
