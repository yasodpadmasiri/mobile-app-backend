<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
     /**
     * Show Category view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$layout = 'side-menu', $theme = 'light')
    {
        $author = Author::getAllAuthors($request->all());
        return view('author.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'author'=>$author
        ]);
    }


    public function uploadImage(Request $request){
        try {
            if($request->ajax()){
                $post = $request->all();
                if($post['image']!=''){
                    $images = $post['image'];
                    $post['image'] = time() . rand() .'.'.$images->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/author/580x400');
                    $img = \UploadImage::make($images->getRealPath());
                    $img->resize(580, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$post['image']);
                    $destinationPath = public_path('/upload/author/original');
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
     * Sadd update author
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUpdateAuthor(Request $request)
    {
         try {
            if($request->ajax()){
                $post = $request->all();
                $data['prefield'] = $post;
                $validate = [
                    'name' => 'required',
                    'email' => 'required',
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
                        'name' => \Helpers::checkEmpty($post['name']),
                        'email' => \Helpers::checkEmpty($post['email']),
                        'designation' => \Helpers::checkEmpty($post['designation']),
                    );

                    if(isset($post['authorimage']) && $post['authorimage'] != ''){
                        $postData['image'] = \Helpers::checkEmpty($post['authorimage']);
                    }

                    if(isset($post['id']) && $post['id'] !='' & $post['id'] != 0){
                        $catExist = Author::where(DB::raw('LOWER(email)'),strtolower($post['email']))->where('id','!=',$post['id'])->get();
                        if (count($catExist)>0) {
                            return response(\Helpers::sendFailureAjaxResponse('This email already exist.',$data['prefield']));
                        }else{
                            Author::where('id', $post['id'])->update($postData);
                        }
                    }else{
                        $catExist = Author::where(DB::raw('LOWER(email)'),strtolower($post['email']))->where('id','!=',0)->get();
                        if (count($catExist)>0) {
                            return response(\Helpers::sendFailureAjaxResponse('This email already exist.',$data['prefield']));
                        }else{
                            $postData['created_at'] = date('Y-m-d H:i:s');
                            Author::insert($postData);
                        }
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

        /**
     * Method to delete category
     * @param array $request post data, id
    */
    public function deleteAuthor(Request $request,$id)
    {
        Author::where('id', $id)->delete();      
        return back()->with('success','author deleted successfully.');
    }
    /**
     * Method to change status of category
     * @param array $request post data ,id ,status
    */
    public function changeAuthorStatus(Request $request,$id,$status)
    {
        $post['status'] = $status;
        $post['id'] = $id;
        Author::updateAuthor($post);         
        return back()->with('success','author status changed successfully.');  
    }

}
