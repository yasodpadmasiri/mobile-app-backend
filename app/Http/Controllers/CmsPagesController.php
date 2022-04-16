<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsPages;
use Illuminate\Support\Facades\Validator;


class CmsPagesController extends Controller
{
    

    /**
     * list of cms pages
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$layout = 'side-menu', $theme = 'light')
    {
        $cms = CmsPages::get();
        return view('cms-pages.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'cms'=>$cms
        ]);
    }



        /**
     * Show Edit Page view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPage($id)
    {
        $data = CmsPages::find($id);

        return view('cms-pages.edit', [
            'theme' => 'light',
            'page_name' => 'create',
            'side_menu' => array(),
            'layout' => 'side-menu',
            'data'=>$data
        ]);
    }



    public function uploadCMSBannerImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/cms/580x400');
                    $img = \UploadImage::make($images->getRealPath());
                    $img->resize(580, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$post['image']);
                    $destinationPath = public_path('/upload/cms/original');
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



        /**
     * add update CMS page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUpdateCMSPage(Request $request)
    {
         try {
            if($request->ajax()){
                $post = $request->all();
                //echo json_encode($post);exit;
                $data['prefield'] = $post;
                $validate = [
                    'title' => 'required',
                ];
                $validator = Validator::make($post, $validate);
                if ($validator->fails()) {
                    $data['error'] = $validator->errors();
                    $error = '';
                    $errors = (array)$data['error'];
                    foreach ($errors as $row) {
                        foreach ($validate as $key => $value) {
                            if(isset($row[$key])){
                                $error = $row[$key];
                            }
                        }
                    }
                    return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error'),$data['prefield']));
                }else{

                    unset($post['_token']);
                    $postData = array(
                        'title' => \Helpers::checkEmpty($post['title']),
                    );

                    if(isset($post['banner_image']) && $post['banner_image'] != ''){
                        $postData['image'] = \Helpers::checkEmpty($post['banner_image']);
                    }

                    if(isset($post['description']) && $post['description'] != ''){
                        $postData['description'] = $post['description'];
                    }

                    if(isset($post['id']) && $post['id'] !='' & $post['id'] != 0){
                        CmsPages::where('id', $post['id'])->update($postData);
                    }else{
                        CmsPages::insertGetId($postData);
                    }
                    return response(\Helpers::sendSuccessAjaxResponse('Succefully updated.'));
                }
            }else{
                return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.invalid_request')));
            }
        } catch (\Exception $ex) {
            return response(\Helpers::sendFailureAjaxResponse(config('constant.common.messages.there_is_an_error').$ex));
        }
    }


}
