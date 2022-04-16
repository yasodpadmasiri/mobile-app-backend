<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContent;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SiteContentController extends Controller
{
    

         /**
     * Show Category view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$layout = 'side-menu', $theme = 'light')
    {
        $Cms = SiteContent::get();
        return view('cms.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'cms'=>$Cms
        ]);
    }


    public function sendMail(){
        $c = \Helpers::sendEmail('emails.emailtest',array('name'=>'xxxx'),'softthink.tech@gmail.com','','testing mail','bloggit','','');
        if ($c) {
            echo 'Mail sent';
        }else{
            echo 'Mail not sent';
        }
        die;
    }


   /**
     * Show Edit Setting view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editSetting($page)
    {
        $data = SiteContent::get();
        if ($page == 'global') {
        	return view('cms.global-setting', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data
        	]);
        }else if ($page == 'local') {

        	$zones = timezone_identifiers_list();
        	return view('cms.localisation', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data,
            'zones'=>$zones,
        	]);
        }else if ($page == 'mail') {

        	return view('cms.mail', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data,
        	]);
        }else if ($page == 'notification') {

        	return view('cms.push-notification', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data,
        	]);
        }else if ($page == 'social') {

        	return view('cms.social-authentication', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data,
        	]);
        }
    }




    public function uploadLogoImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/logo');
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



    public function uploadBGImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/bg');
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


    public function uploadsplashImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/splash');
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
    public function updateSetting(Request $request)
    {
        $post = $request->all();


        if(!empty($post)){

            if (isset($post['image'])) {
                unset($post['image']);
            }

            if (isset($post['bgimage'])) {
                unset($post['bgimage']);
            }

            if (isset($post['splashimage'])) {
                unset($post['splashimage']);
            }


            if (!isset($post['bg_image'])) {
                unset($post['bg_image']);
            }

            if (!isset($post['app_logo'])) {
                unset($post['app_logo']);
            }


            if (!isset($post['splash_image'])) {
                unset($post['splash_image']);
            }
            

        	if (isset($post['pushNoti'])) {
				if (isset($post['push_notification_enabled'])) {
					$post['push_notification_enabled'] = 1;
				}else{
					$post['push_notification_enabled'] = 0;
				}
			}


			if (isset($post['enable_google_check'])) {
				if (isset($post['enable_google'])) {
					$post['enable_google'] = 1;
				}else{
					$post['enable_google'] = 0;
				}
			}


			if (isset($post['enable_facebook_check'])) {
				if (isset($post['enable_facebook'])) {
					$post['enable_facebook'] = 1;
				}else{
					$post['enable_facebook'] = 0;
				}
			}

            unset($post['_token']);

        	foreach ($post as $key => $value) {
    			$exist = SiteContent::where('key',$key)->first();

    			if ($exist) {
    				$id = SiteContent::where('id',$exist->id)->update(array('value'=>$value));
    			}else{
    				SiteContent::insert(array('key'=>$key,'value'=>$value));
    			}
        	}



            if (isset($post['mail_host'])) {
                \Artisan::call('env:set mail_host '.$post['mail_host']);
            }

            if (isset($post['mail_port'])) {
                \Artisan::call('env:set mail_port '.$post['mail_port']);
            }

            if (isset($post['mail_encryption'])) {
                \Artisan::call('env:set mail_encryption '.$post['mail_encryption']);
            }

            if (isset($post['mail_username'])) {
                \Artisan::call('env:set mail_username '.$post['mail_username']);
            }

            if (isset($post['mail_password'])) {
                \Artisan::call('env:set mail_password '.$post['mail_password']);
            }

            if (isset($post['mail_from_address'])) {
                \Artisan::call('env:set mail_from_address '.$post['mail_from_address']);
            }

            if (isset($post['mail_from_name'])) {
                \Artisan::call('env:set mail_from_name '.$post['mail_from_name']);
            }

            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');


        	return back()->with('success','changed successfully.');  
        }else{
        	return back()->with('failure','unable to change try again.');  
        }
    }



}
