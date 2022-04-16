<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogAuthor;
use App\Models\Author;
use App\Models\BlogCategory;
use App\Models\SiteContent;
use App\Models\SearchLog;
use App\Models\BookMarkPost;
use App\Models\BlogViewCount;
use App\Models\BlogImages;
use App\Models\Vote;


use Illuminate\Support\Facades\Validator;

class BlogAPIController extends Controller
{    /**
     * Show 7 Blogs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        try {
            $header = $request->header('userData');
            //print(arg)
            $blog_image = array();
            $blog = Blog::where('status',1)->where('is_featured',1)->orderBy('id','DESC')->limit(7)->get();
            if($blog){
                foreach ($blog as $row) {

                    $row->trimed_description = strip_tags($row->description);
                    $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                    $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                    //$row->created_at = "hgdeshdg"
                    
                    //$row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                    if($row->thumb_image!=''){
                        $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                    }else{
                        $row->thumb_image= url('upload/blog/thumb/default.png');
                    } 
                    if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                    // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                    // if(count($check_image)){
                    //     // echo "111";
                    //     // echo json_encode($check_image);
                    //     foreach ($check_image as $value) {
                    //         //echo $value;
                    //         //echo "<br>";
                    //         $value = url('upload/blog/banner/original/'.$value);
                    //         //echo $value;exit;
                    //         array_push($blog_image,$value);
                    //         //$blog_image = $value;
                    //     }
                    //     $row->banner_image = $blog_image;
                    // }else{
                    //     $blog_image[0] = url('upload/author/default.png');
                    //     $row->banner_image =  $blog_image;
                    // }
                    if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($vote){
                            $row->is_vote = 1;
                        }else{
                            $row->is_vote = 0;
                        }  
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($bookmarked){
                            $row->is_bookmark = 1;
                        }else{
                            $row->is_bookmark = 0;
                        }                       
                    }else{
                        $row->is_vote = 0;
                        $row->is_bookmark = 0;
                    }
                    $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    $total_votes = Vote::where('blog_id',$row->id)->count();
                    $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->yes_percent = $yes_percent;
                    $row->no_percent = $no_percent;
                    $author = Author::where('id',$row->author_id)->first();
                    if($author){                    
                        $row->author_name = $author->name;
                        if($author->image!=null || $author->image!=''){
                            $row->image = url('upload/author/580x400/'.$author->image);
                        }else{
                            $row->image = url('upload/author/default.png');
                        }
                    }else{
                        $row->author_name = "";
                        $row->image = url('upload/author/default.png');
                    }
                    $category = Category::where('id',$row->category_id)->first();
                    if($category){                  
                        $row->category_name = $category->name;
                        $row->color = $category->color;
                    }else{
                        $row->category_name = "";
                        $row->color = "";
                    }
                    $row->time = $row->time. " min";
                    $row->created_at = date("d-M-Y",strtotime($row->created_at));
                    $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                    $blog_image = array();
                }
                //exit;
                return $this->sendResponse($blog, 'List of all blog');
            }else{
                $blog= array();
                return $this->sendResponse($blog, 'List of all blog');
            }            
            
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Show All Blogs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allBloglist(Request $request)
    {
        try {
            $header = $request->header('userData');
            $blog_image = array();
            $blog = Blog::where('status',1)->orderBy('id','DESC')->get();
            if($blog){
                foreach ($blog as $row) {
                    $row->trimed_description = strip_tags($row->description);
                    $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                    $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                    $row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                    if($row->thumb_image!=''){
                        $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                    }else{
                        $row->thumb_image= url('upload/blog/thumb/default.png');
                    } 
                    if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                    // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                    // if(count($check_image)){
                    //     // echo "111";
                    //     // echo json_encode($check_image);
                    //     foreach ($check_image as $value) {
                    //         //echo $value;
                    //         //echo "<br>";
                    //         $value = url('upload/blog/banner/original/'.$value);
                    //         //echo $value;exit;
                    //         array_push($blog_image,$value);
                    //         //$blog_image = $value;
                    //     }
                    //     $row->banner_image = $blog_image;
                    // }else{
                    //     // echo "000";
                    //     // echo json_encode($check_image);
                    //     $blog_image[0] = url('upload/author/default.png');
                    //     $row->banner_image =  $blog_image;
                    // } 
                    if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($vote){
                            $row->is_vote = 1;
                        }else{
                            $row->is_vote = 0;
                        } 
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($bookmarked){
                            $row->is_bookmark = 1;
                        }else{
                            $row->is_bookmark = 0;
                        }                        
                    }else{
                        $row->is_vote = 0;
                        $row->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$row->id)->count();
                    $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    //$no_votes = Vote::where('blog_id',$row->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->yes_percent = $yes_percent;
                    $row->no_percent = $no_percent; 
                    // if($row->banner_image!=''){
                    //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    // }else{
                    //     $row->banner_image= url('upload/blog/banner/default.jpg');
                    // }
                    $author = Author::where('id',$row->author_id)->first();
                    if($author){                    
                        $row->author_name = $author->name;
                        if($author->image!=null || $author->image!=''){
                            $row->image = url('upload/author/580x400/'.$author->image);
                        }else{
                            $row->image = url('upload/author/default.png');
                        }
                    }else{
                        $row->author_name = "";
                        $row->image = url('upload/author/default.png');
                    }
                    $category = Category::where('id',$row->category_id)->first();
                    if($category){                  
                        $row->category_name = $category->name;
                        $row->color = $category->color;
                    }else{
                        $row->category_name = "";
                        $row->color = "";
                    }
                    $row->time = $row->time. " min";
                    $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                }
            }else{
                $blog= array();
            }            
            return $this->sendResponse($blog, 'List of all blog');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Show Blog view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail($id,Request $request)
    {
        try {
            $blog = Blog::getActiveBlogDetail($id);
            return $this->sendResponse($blog, 'List of all blog');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
    /**
     * Show Blog Search Result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchBlog(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'title' => 'required|min:1',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $header = $request->header('userData');
                $blog_image = array();
                //echo json_encode($post);exit;
                $blog = Blog::where('title','like', '%'.trim($post['title']). '%')->where('status',1)->get();
                if(count($blog)==0){
                    $blog = Blog::where('tags','like', '%'.trim($post['title']). '%')->where('status',1)->get();
                }
                if(count($blog)){
                    foreach ($blog as $row) {
                        $row->trimed_description = strip_tags($row->description);
                        $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                        $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                        $row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                        if($row->thumb_image!=''){
                            $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                        }else{
                            $row->thumb_image= url('upload/blog/thumb/default.png');
                        }
                        if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                        // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                        // if(count($check_image)){
                        //     // echo "111";
                        //     // echo json_encode($check_image);
                        //     foreach ($check_image as $value) {
                        //         //echo $value;
                        //         //echo "<br>";
                        //         $value = url('upload/blog/banner/original/'.$value);
                        //         //echo $value;exit;
                        //         array_push($blog_image,$value);
                        //         //$blog_image = $value;
                        //     }
                        //     $row->banner_image = $blog_image;
                        // }else{
                        //     // echo "000";
                        //     // echo json_encode($check_image);
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $row->banner_image =  $blog_image;
                        // }  
                        if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($vote){
                            $row->is_vote = 1;
                        }else{
                            $row->is_vote = 0;
                        } 
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($bookmarked){
                            $row->is_bookmark = 1;
                        }else{
                            $row->is_bookmark = 0;
                        }                        
                    }else{
                        $row->is_vote = 0;
                        $row->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$row->id)->count();
                    $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    //$no_votes = Vote::where('blog_id',$row->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->yes_percent = $yes_percent;
                    $row->no_percent = $no_percent;  
                        // if($row->banner_image!=''){
                        //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                        // }else{
                        //     $row->banner_image= url('upload/blog/banner/default.jpg');
                        // }
                        $author = Author::where('id',$row->author_id)->first();
                        if($author){                    
                            $row->author_name = $author->name;
                            if($author->image!=null || $author->image!=''){
                                $row->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $row->image = url('upload/author/default.png');
                            }
                        }else{
                            $row->author_name = "";
                            $row->image = url('upload/author/default.png');
                        }
                        $category = Category::where('id',$row->category_id)->first();
                        if($category){                  
                            $row->category_name = $category->name;
                            $row->color = $category->color;
                        }else{
                            $row->category_name = "";
                            $row->color = "";
                        }
                        $row->time = $row->time. " min";
                        $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                    }
                    $log = array(
                        'user_id'=>$post['user_id'],
                        'search_keyword'=>$post['title'],
                        'search_count'=>count($blog),
                        'created_at'=>date('Y-m-d h:i:s')
                    );
                    SearchLog::addSearchLog($log);
                    return response(\Helpers::sendSuccessAjaxResponse('Search result found.',$blog));
                }else{
                    return response(\Helpers::sendFailureAjaxResponse("Search not found."));
                }
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
    /**
     * Show list of settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function settingList(Request $request)
    {
        try {
            $app_name = SiteContent::where('key','app_name')->first();
            $app_subtitle = SiteContent::where('key','app_subtitle')->first();
            $app_image = SiteContent::where('key','bg_image')->first();   
            if($app_image){
                if($app_image->value!=''){
                    $app_image->value = url('upload/bg/'.$app_image->value);
                }else{
                    $app_image->value = url('upload/bg/default.jpg');
                }
            }
            $settings = array('app_name'=>$app_name->value,'app_image'=>$app_image->value,'app_subtitle'=>$app_subtitle->value);         
            return $this->sendResponse($settings, 'List of all settings');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }


    /**
     * bookmarkPost
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    public function bookmarkPost(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'user_id' => 'required',
                'blog_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();

                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $alreadyBookmarked = BookMarkPost::where('user_id',$post['user_id'])->where('blog_id',$post['blog_id'])->count();
                if ($alreadyBookmarked) {
                    return $this->sendResponse([], 'Already Bookmarked');
                }else{
                    $data['blog'] = BookMarkPost::insertGetID(array('user_id'=>$post['user_id'],'blog_id'=>$post['blog_id'])); 
                    $bookmarked = BookMarkPost::where('user_id',$post['user_id'])->where('blog_id',$post['blog_id'])->first();
                    if($bookmarked){
                        $data['is_bookmark'] = 1;
                    }else{
                        $data['is_bookmark'] = 0;
                    } 
                   if ($data['blog']) {
                        return $this->sendResponse($data, 'Successfully Bookmarked');
                   }else{
                        return $this->sendError($data['blog'], 500);
                   }
                }
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }


    /**
     * Delete bookmarkPost
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    public function deleteBookmarkPost(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'user_id' => 'required',
                'blog_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                BookMarkPost::where('user_id',$post['user_id'])->where('blog_id',$post['blog_id'])->delete();
                return $this->sendResponse([], 'Removed Bookmark');
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }
     /**
     * All bookmarked Post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function AllBookmarkPost(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'user_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $blog_image = array();
                $blogs = array();
                $header = $request->header('userData');
                if (isset($post['category_id']) && $post['category_id'] != '' && $post['category_id'] !=0) {
                    $blogs = Blog::where('category_id',$post['category_id'])->get();
                    //$data = BookMarkPost::whereIn('blog_id',$blogIDs)->with('myblog')->get();
                    if($blogs){
                        foreach($blogs as $row){
                        $row->trimed_description = strip_tags($row->description);
                        $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                        $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                        $row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                        if($row->thumb_image!=''){
                            $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                        }else{
                            $row->thumb_image= url('upload/blog/thumb/default.png');
                        }
                        if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                        // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                        // if(count($check_image)){
                        //     // echo "111";
                        //     // echo json_encode($check_image);
                        //     foreach ($check_image as $value) {
                        //         //echo $value;
                        //         //echo "<br>";
                        //         $value = url('upload/blog/banner/original/'.$value);
                        //         //echo $value;exit;
                        //         array_push($blog_image,$value);
                        //         //$blog_image = $value;
                        //     }
                        //     $row->banner_image = $blog_image;
                        // }else{
                        //     // echo "000";
                        //     // echo json_encode($check_image);
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $row->banner_image =  $blog_image;
                        // } 
                        if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($vote){
                            $row->is_vote = 1;
                        }else{
                            $row->is_vote = 0;
                        }
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($bookmarked){
                            $row->is_bookmark = 1;
                        }else{
                            $row->is_bookmark = 0;
                        }                         
                    }else{
                        $row->is_vote = 0;
                        $row->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$row->id)->count();
                    $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    //$no_votes = Vote::where('blog_id',$row->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->yes_percent = $yes_percent;
                    $row->no_percent = $no_percent; 
                        // if($row->banner_image!=''){
                        //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                        // }else{
                        //     $row->banner_image= url('upload/blog/banner/default.jpg');
                        // }
                        $author = Author::where('id',$row->author_id)->first();
                        if($author){                    
                            $row->author_name = $author->name;
                            if($author->image!=null || $author->image!=''){
                                $row->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $row->image = url('upload/author/default.png');
                            }
                        }else{
                            $row->author_name = "";
                            $row->image = url('upload/author/default.png');
                        }
                        $category = Category::where('id',$row->category_id)->first();
                        if($category){                  
                            $row->category_name = $category->name;
                            $row->color = $category->color;
                        }else{
                            $row->category_name = "";
                            $row->color = "";
                        }
                        $row->time = $row->time. " min";
                        $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                        //array_push($blogs,$row->myblog);
                    }
                    }else{
                        $blogs = array();
                    }
                    
                }else{
                    
                    $data = BookMarkPost::where('user_id',$post['user_id'])->with('myblog')->get();
                    //echo json_encode($data);
                    if($data){
                        foreach($data as $row){
                        //echo json_encode($row);
                        if($row->myblog!=null){
                            $row->myblog->trimed_description = strip_tags($row->myblog->description);
                        $row->myblog->trimed_description =  str_replace("&nbsp;",'',$row->myblog->trimed_description); 
                        $row->myblog->trimed_description =  str_replace("&#39;","'",$row->myblog->trimed_description);
                        $row->myblog->created_at = date("d M Y h:i a",strtotime($row->myblog->created_at));
                        if($row->myblog->thumb_image!=''){
                            $row->myblog->thumb_image= url('upload/blog/thumb/original/'.$row->myblog->thumb_image);
                        }else{
                            $row->myblog->thumb_image= url('upload/blog/thumb/default.png');
                        }  
                        if($row->myblog->banner_image!=''){
                            $row->myblog->banner_image= url('upload/blog/banner/original/'.$row->myblog->banner_image);
                        }else{
                            $row->myblog->banner_image= url('upload/blog/banner/default.png');
                        } 
                        // $check_image = BlogImages::where('blog_id',$row->blog_id)->pluck('image');  
                        // if(count($check_image)){
                        //     // echo "111";
                        //     // echo json_encode($check_image);
                        //     foreach ($check_image as $value) {
                        //         //echo $value;
                        //         //echo "<br>";
                        //         $value = url('upload/blog/banner/original/'.$value);
                        //         //echo $value;exit;
                        //         array_push($blog_image,$value);
                        //         //$blog_image = $value;
                        //     }
                        //     $row->myblog->banner_image = $blog_image;
                        // }else{
                        //     // echo "000";
                        //     // echo json_encode($check_image);
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $row->myblog->banner_image =  $blog_image;
                        // }
                        if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$row->blog_id)->first();
                        if($vote){
                            $row->myblog->is_vote = 1;
                        }else{
                            $row->myblog->is_vote = 0;
                        } 
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->blog_id)->first();
                        if($bookmarked){
                            $row->myblog->is_bookmark = 1;
                        }else{
                            $row->myblog->is_bookmark = 0;
                        }                        
                    }else{
                        $row->myblog->is_vote = 0;
                        $row->myblog->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$row->blog_id)->count();
                    $yes_votes = Vote::where('blog_id',$row->blog_id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $row->myblog->view_count = BlogViewCount::where('blog_id',$row->blog_id)->count();
                    //$no_votes = Vote::where('blog_id',$row->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->myblog->yes_percent = $yes_percent;
                    $row->myblog->no_percent = $no_percent; 
                        // if($row->myblog->banner_image!=''){
                        //     $row->myblog->banner_image= url('upload/blog/banner/original/'.$row->myblog->banner_image);
                        // }else{
                        //     $row->myblog->banner_image= url('upload/blog/banner/default.jpg');
                        // }
                        $author = Author::where('id',$row->myblog->author_id)->first();
                        if($author){                    
                            $row->myblog->author_name = $author->name;
                            if($author->image!=null || $author->image!=''){
                                $row->myblog->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $row->myblog->image = url('upload/author/default.png');
                            }
                        }else{
                            $row->myblog->author_name = "";
                            $row->myblog->image = url('upload/author/default.png');
                        }
                        $category = Category::where('id',$row->myblog->category_id)->first();
                        if($category){                  
                            $row->myblog->category_name = $category->name;
                            $row->myblog->color = $category->color;
                        }else{
                            $row->myblog->category_name = "";
                            $row->myblog->color = "";
                        }
                        $row->myblog->time = $row->myblog->time. " min";
                        $row->myblog->create_date = date("d M Y // h:i a",strtotime($row->myblog->created_at));
                        array_push($blogs,$row->myblog);
                        }else{
                            $blogs = array();
                        }
                        
                    }
                    //exit;
                    }else{
                        $blogs = array();
                    }
                    
                }
                return $this->sendResponse($blogs,'Record found');
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }


    /**
     * increaseBlogViewCount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function increaseBlogViewCount(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'user_id' => 'required',
                'blog_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{

               $alreadyBookmarked = BlogViewCount::where('user_id',$post['user_id'])->where('blog_id',$post['blog_id'])->count();
                if ($alreadyBookmarked) {
                    return $this->sendResponse([], 'Already Viewed');
                }else{
                   $blog = BlogViewCount::insertGetID(array('user_id'=>$post['user_id'],'blog_id'=>$post['blog_id'])); 
                   if ($blog) {
                        return $this->sendResponse($blog, 'Successfully Viewed');
                   }else{
                        return $this->sendError($blog, 500);
                   }
                }
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }

    /**
     * Vote for the blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addBlogVote(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'user_id' => 'required',
                'blog_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
               $alreadyVoted = Vote::where('user_id',$post['user_id'])->where('blog_id',$post['blog_id'])->count();
                if ($alreadyVoted) {
                    return $this->sendResponse([], 'Already Viewed');
                }else{
                    $post['created_at'] = date("Y-m-d h:i:s");
                   $vote = Vote::addVote($post); 
                   if ($vote) {
                        return $this->sendResponse($vote, 'Successfully voted for the blog');
                   }else{
                        return $this->sendError($vote, 500);
                   }
                }
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }

     /**
     * For Swipe next blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function blogSwipe(Request $request)
    {
        try {
            $header = $request->header('userData');
            $post = $request->all();
            $validate = [
                'blog_id' => 'required',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $blog_image = array();
                $blogs = array();
                $header = $request->header('userData');
                $singleBlog = Blog::where('id',$post['blog_id'])->first();
                if($singleBlog){
                    $singleBlog->trimed_description = strip_tags($singleBlog->description);
                    $singleBlog->trimed_description =  str_replace("&nbsp;",'',$singleBlog->trimed_description); 
                    $singleBlog->trimed_description =  str_replace("&#39;","'",$singleBlog->trimed_description);
                    $singleBlog->created_at = date("d M Y h:i a",strtotime($singleBlog->created_at));
                    if($singleBlog->thumb_image!=''){
                        $singleBlog->thumb_image= url('upload/blog/thumb/original/'.$singleBlog->thumb_image);
                    }else{
                        $singleBlog->thumb_image= url('upload/blog/thumb/default.png');
                    }  
                    if($singleBlog->banner_image!=''){
                        $singleBlog->banner_image= url('upload/blog/banner/original/'.$singleBlog->banner_image);
                    }else{
                        $singleBlog->banner_image= url('upload/blog/banner/default.png');
                    } 
                    // $check_image = BlogImages::where('blog_id',$singleBlog->id)->pluck('image');  
                    // if(count($check_image)){
                    //     // echo "111";
                    //     // echo json_encode($check_image);
                    //     foreach ($check_image as $value) {
                    //         //echo $value;
                    //         //echo "<br>";
                    //         $value = url('upload/blog/banner/original/'.$value);
                    //         //echo $value;exit;
                    //         array_push($blog_image,$value);
                    //         //$blog_image = $value;
                    //     }
                    //     $singleBlog->banner_image = $blog_image;
                    // }else{
                    //     // echo "000";
                    //     // echo json_encode($check_image);
                    //     $blog_image[0] = url('upload/author/default.png');
                    //     $singleBlog->banner_image =  $blog_image;
                    // } 

                    // if($row->banner_image!=''){
                    //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    // }else{
                    //     $row->banner_image= url('upload/blog/banner/default.jpg');
                    // }
                    //echo $header;exit;
                    if($header!=null){
                        //echo $header;
                        //echo "string";
                        $vote = Vote::where('user_id',$header)->where('blog_id',$singleBlog->id)->first();
                        if($vote){
                            //echo "hghghgh";
                            //echo json_encode($vote);exit;
                            $singleBlog->is_vote = 1;
                        }else{
                            $singleBlog->is_vote = 0;
                        } 
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$singleBlog->id)->first();
                        if($bookmarked){
                            $singleBlog->is_bookmark = 1;
                        }else{
                            $singleBlog->is_bookmark = 0;
                        }                        
                    }else{
                        $singleBlog->is_vote = 0;
                        $singleBlog->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$singleBlog->id)->count();
                    $yes_votes = Vote::where('blog_id',$singleBlog->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $singleBlog->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    //$no_votes = Vote::where('blog_id',$singleBlog->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $singleBlog->yes_percent = $yes_percent;
                    $singleBlog->no_percent = $no_percent; 

                    $author = Author::where('id',$singleBlog->author_id)->first();
                    if($author){                    
                        $singleBlog->author_name = $author->name;
                        if($author->image!=null || $author->image!=''){
                            $singleBlog->image = url('upload/author/580x400/'.$singleBlog->image);
                        }else{
                            $singleBlog->image = url('upload/author/default.png');
                        }
                    }else{
                        $singleBlog->author_name = "";
                        $singleBlog->image = url('upload/author/default.png');
                    }
                    $category = Category::where('id',$singleBlog->category_id)->first();
                    if($category){                  
                        $singleBlog->category_name = $category->name;
                        $singleBlog->color = $category->color;
                    }else{
                        $singleBlog->category_name = "";
                        $singleBlog->color="";
                    }
                    $singleBlog->time = $singleBlog->time. " min";
                    $singleBlog->create_date = date("d M Y // h:i a",strtotime($singleBlog->created_at));
                    //echo json_encode($singleBlog);exit;
                    $blogs[0] = $singleBlog;
                }                
                $getBlog = Blog::where('status',1)->where('id','!=',$post['blog_id'])->orderBy('id','DESC')->get();
                foreach ($getBlog as $row) {
                    $row->trimed_description = strip_tags($row->description);
                    $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                    $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                    $row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                    if($row->thumb_image!=''){
                        $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                    }else{
                        $row->thumb_image= url('upload/blog/thumb/default.png');
                    }  
                    if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                    // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                    // if(count($check_image)){
                    //     // echo "111";
                    //     // echo json_encode($check_image);
                    //     foreach ($check_image as $value) {
                    //         //echo $value;
                    //         //echo "<br>";
                    //         $value = url('upload/blog/banner/original/'.$value);
                    //         //echo $value;exit;
                    //         array_push($blog_image,$value);
                    //         //$blog_image = $value;
                    //     }
                    //     $row->banner_image = $blog_image;
                    // }else{
                    //     // echo "000";
                    //     // echo json_encode($check_image);
                    //     $blog_image[0] = url('upload/author/default.png');
                    //     $row->banner_image =  $blog_image;
                    // } 
                    // if($row->banner_image!=''){
                    //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    // }else{
                    //     $row->banner_image= url('upload/blog/banner/default.jpg');
                    // }
                    if($header!=null){
                        $votes = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($votes){
                            $row->is_vote = 1;
                        }else{
                            $row->is_vote = 0;
                        } 
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                        if($bookmarked){
                            $row->is_bookmark = 1;
                        }else{
                            $row->is_bookmark = 0;
                        }                        
                    }else{
                        $row->is_vote = 0;
                        $row->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$row->id)->count();
                    $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                    //$no_votes = Vote::where('blog_id',$row->id)->where('vote',0)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $row->yes_percent = $yes_percent;
                    $row->no_percent = $no_percent; 
                    $author = Author::where('id',$row->author_id)->first();
                    if($author){                    
                        $row->author_name = $author->name;
                        if($author->image!=null || $author->image!=''){
                            $row->image = url('upload/author/580x400/'.$author->image);
                        }else{
                            $row->image = url('upload/author/default.png');
                        }
                    }else{
                        $row->author_name = "";
                        $row->image = url('upload/author/default.png');
                    }
                    $category = Category::where('id',$row->category_id)->first();
                    if($category){                  
                        $row->category_name = $category->name;
                        $row->color = $category->color;
                    }else{
                        $row->category_name = "";
                        $row->color = "";
                    }
                    $row->time = $row->time. " min";
                    $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                    array_push($blogs,$row);
                }
                // if (isset($post['category_id']) && $post['category_id'] != '' && $post['category_id'] !=0) {
                //     $blogs = Blog::where('category_id',$post['category_id'])->get();
                //     //$data = BookMarkPost::whereIn('blog_id',$blogIDs)->with('myblog')->get();
                //     foreach($blogs as $row){
                //         $row->trimed_description = strip_tags($row->description);
                //         $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                //         $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                //         if($row->thumb_image!=''){
                //             $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                //         }else{
                //             $row->thumb_image= url('upload/blog/thumb/default.png');
                //         }  
                //         $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                //         if(count($check_image)){
                //             // echo "111";
                //             // echo json_encode($check_image);
                //             foreach ($check_image as $value) {
                //                 //echo $value;
                //                 //echo "<br>";
                //                 $value = url('upload/blog/banner/original/'.$value);
                //                 //echo $value;exit;
                //                 array_push($blog_image,$value);
                //                 //$blog_image = $value;
                //             }
                //             $row->banner_image = $blog_image;
                //         }else{
                //             // echo "000";
                //             // echo json_encode($check_image);
                //             $blog_image[0] = url('upload/author/default.png');
                //             $row->banner_image =  $blog_image;
                //         } 
                //         // if($row->banner_image!=''){
                //         //     $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                //         // }else{
                //         //     $row->banner_image= url('upload/blog/banner/default.jpg');
                //         // }
                //         $author = Author::where('id',$row->author_id)->first();
                //         if($author){                    
                //             $row->author_name = $author->name;
                //             if($author->image!=null || $author->image!=''){
                //                 $row->image = url('upload/author/580x400/'.$author->image);
                //             }else{
                //                 $row->image = url('upload/author/default.png');
                //             }
                //         }else{
                //             $row->author_name = "";
                //             $row->image = url('upload/author/default.png');
                //         }
                //         $category = Category::where('id',$row->category_id)->first();
                //         if($category){                  
                //             $row->category_name = $category->name;
                //         }else{
                //             $row->category_name = "";
                //         }
                //         $row->time = $row->time. " min";
                //         //array_push($blogs,$row->myblog);
                //     }
                // }else{
                    
                //     $data = BookMarkPost::where('user_id',$post['user_id'])->with('myblog')->get();
                //     foreach($data as $row){
                //         $row->myblog->trimed_description = strip_tags($row->myblog->description);
                //         $row->myblog->trimed_description =  str_replace("&nbsp;",'',$row->myblog->trimed_description); 
                //         $row->myblog->trimed_description =  str_replace("&#39;","'",$row->myblog->trimed_description);
                //         if($row->myblog->thumb_image!=''){
                //             $row->myblog->thumb_image= url('upload/blog/thumb/original/'.$row->myblog->thumb_image);
                //         }else{
                //             $row->myblog->thumb_image= url('upload/blog/thumb/default.png');
                //         }   
                //         $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                //         if(count($check_image)){
                //             // echo "111";
                //             // echo json_encode($check_image);
                //             foreach ($check_image as $value) {
                //                 //echo $value;
                //                 //echo "<br>";
                //                 $value = url('upload/blog/banner/original/'.$value);
                //                 //echo $value;exit;
                //                 array_push($blog_image,$value);
                //                 //$blog_image = $value;
                //             }
                //             $row->banner_image = $blog_image;
                //         }else{
                //             // echo "000";
                //             // echo json_encode($check_image);
                //             $blog_image[0] = url('upload/author/default.png');
                //             $row->banner_image =  $blog_image;
                //         }
                //         // if($row->myblog->banner_image!=''){
                //         //     $row->myblog->banner_image= url('upload/blog/banner/original/'.$row->myblog->banner_image);
                //         // }else{
                //         //     $row->myblog->banner_image= url('upload/blog/banner/default.jpg');
                //         // }
                //         $author = Author::where('id',$row->myblog->author_id)->first();
                //         if($author){                    
                //             $row->myblog->author_name = $author->name;
                //             if($author->image!=null || $author->image!=''){
                //                 $row->myblog->image = url('upload/author/580x400/'.$author->image);
                //             }else{
                //                 $row->myblog->image = url('upload/author/default.png');
                //             }
                //         }else{
                //             $row->myblog->author_name = "";
                //             $row->myblog->image = url('upload/author/default.png');
                //         }
                //         $category = Category::where('id',$row->myblog->category_id)->first();
                //         if($category){                  
                //             $row->myblog->category_name = $category->name;
                //         }else{
                //             $row->myblog->category_name = "";
                //         }
                //         $row->myblog->time = $row->myblog->time. " min";
                //         array_push($blogs,$row->myblog);
                //     }
                // }
                return $this->sendResponse($blogs,'Record found');
            }
        } catch (\Exception $ex) {
           return $this->sendError($ex->getMessage(), 401);
        }
    }

    /**
     * Show Blog votes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBlogVote(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'blog_id' => 'required|min:1',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $header = $request->header('userData');
                $blog_image = array();
                //echo json_encode($post);exit;
                $blog = Blog::where('id',$post['blog_id'])->first();
                if($blog){
                        $blog->trimed_description = strip_tags($blog->description);
                        $blog->trimed_description =  str_replace("&nbsp;",'',$blog->trimed_description); 
                        $blog->trimed_description =  str_replace("&#39;","'",$blog->trimed_description);
                        $blog->created_at = date("d M Y h:i a",strtotime($blog->created_at)) ;
                        if($blog->thumb_image!=''){
                            $blog->thumb_image= url('upload/blog/thumb/original/'.$blog->thumb_image);
                        }else{
                            $blog->thumb_image= url('upload/blog/thumb/default.png');
                        }
                        if($blog->banner_image!=''){
                        $blog->banner_image= url('upload/blog/banner/original/'.$blog->banner_image);
                    }else{
                        $blog->banner_image= url('upload/blog/banner/default.png');
                    } 
                        // $check_image = BlogImages::where('blog_id',$blog->id)->pluck('image');  
                        // if(count($check_image)){
                        //     foreach ($check_image as $value) {
                        //         $value = url('upload/blog/banner/original/'.$value);
                        //         array_push($blog_image,$value);
                        //     }
                        //     $blog->banner_image = $blog_image;
                        // }else{
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $blog->banner_image =  $blog_image;
                        // }  
                        if($header!=null){
                        $vote = Vote::where('user_id',$header)->where('blog_id',$blog->id)->first();
                        if($vote){
                            $blog->is_vote = 1;
                        }else{
                            $blog->is_vote = 0;
                        }   
                        $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$blog->id)->first();
                        if($bookmarked){
                            $blog->is_bookmark = 1;
                        }else{
                            $blog->is_bookmark = 0;
                        }                      
                    }else{
                        $blog->is_vote = 0;
                        $blog->is_bookmark = 0;
                    }
                    $total_votes = Vote::where('blog_id',$blog->id)->count();
                    $yes_votes = Vote::where('blog_id',$blog->id)->where('vote',1)->count();
                    $no_votes = $total_votes - $yes_votes;
                    $blog->view_count = BlogViewCount::where('blog_id',$blog->id)->count();
                    if($yes_votes!=0){
                        $yes_percent = ($yes_votes/$total_votes)*100;
                    }else{
                        $yes_percent = 0;
                    }
                    if($no_votes!=0){
                        $no_percent = ($no_votes/$total_votes)*100;
                    }else{
                        $no_percent = 0;
                    }                 
                    $blog->yes_percent = $yes_percent;
                    $blog->no_percent = $no_percent; 
                        $author = Author::where('id',$blog->author_id)->first();
                        if($author){                    
                            $blog->author_name = $author->name;
                            if($author->image!=null || $author->image!=''){
                                $blog->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $blog->image = url('upload/author/default.png');
                            }
                        }else{
                            $blog->author_name = "";
                            $blog->image = url('upload/author/default.png');
                        }
                        $category = Category::where('id',$blog->category_id)->first();
                        if($category){                  
                            $blog->category_name = $category->name;
                            $blog->color = $category->color;
                        }else{
                            $blog->category_name = "";
                            $blog->color = "";
                        }
                        $blog->time = $blog->time. " min";
                        $blog->create_date = date("d M Y // h:i a",strtotime($blog->created_at));
                    return response(\Helpers::sendSuccessAjaxResponse('Search result found.',$blog));
                }else{
                    return response(\Helpers::sendFailureAjaxResponse("Search not found."));
                }
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
    /**
     * Show Next and Previous Blog.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nextPreviousBlog(Request $request)
    {
        try {
            $post = $request->all();
            $validate = [
                'blog_id' => 'required|min:1',
            ];
            $validator = Validator::make($post, $validate);
            if ($validator->fails()) {
                $data['error'] = $validator->errors();
                return response(\Helpers::sendFailureAjaxResponse($data['error']));
            }else{
                $header = $request->header('userData');
                $blog_image = array();
                //echo json_encode($post);exit;
                if($post['type']=='next'){
                    $blog = Blog::where('id', '>',$post['blog_id'])->where('deleted_at',null)->limit(1)->get();
                    //echo json_encode($blog);exit;
                }else{
                    $blog = Blog::where('id', '<',$post['blog_id'])->where('deleted_at',null)->orderBy('id','desc')->limit(1)->get();
                    //echo json_encode($blog);exit;
                }
                //echo json_encode($blog);exit;
                if($blog){
                    foreach($blog as $row){
                        $row->trimed_description = strip_tags($row->description);
                        $row->trimed_description =  str_replace("&nbsp;",'',$row->trimed_description); 
                        $row->trimed_description =  str_replace("&#39;","'",$row->trimed_description);
                        $row->created_at = date("d M Y h:i a",strtotime($row->created_at));
                        if($row->thumb_image!=''){
                            $row->thumb_image= url('upload/blog/thumb/original/'.$row->thumb_image);
                        }else{
                            $row->thumb_image= url('upload/blog/thumb/default.png');
                        }
                        if($row->banner_image!=''){
                        $row->banner_image= url('upload/blog/banner/original/'.$row->banner_image);
                    }else{
                        $row->banner_image= url('upload/blog/banner/default.png');
                    } 
                        //echo json_encode($row);exit;
                        // $check_image = BlogImages::where('blog_id',$row->id)->pluck('image');  
                        // if(count($check_image)){
                        //     foreach ($check_image as $value) {
                        //         $value = url('upload/blog/banner/original/'.$value);
                        //         array_push($blog_image,$value);
                        //     }
                        //     $row->banner_image = $blog_image;
                        // }else{
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $row->banner_image =  $blog_image;
                        // }  
                        if($header!=null){
                            $vote = Vote::where('user_id',$header)->where('blog_id',$row->id)->first();
                            if($vote){
                                $row->is_vote = 1;
                            }else{
                                $row->is_vote = 0;
                            }   
                            $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$row->id)->first();
                            if($bookmarked){
                                $row->is_bookmark = 1;
                            }else{
                                $row->is_bookmark = 0;
                            }                      
                        }else{
                            $row->is_vote = 0;
                            $row->is_bookmark = 0;
                        }
                        $total_votes = Vote::where('blog_id',$row->id)->count();
                        $yes_votes = Vote::where('blog_id',$row->id)->where('vote',1)->count();
                        $no_votes = $total_votes - $yes_votes;
                        $row->view_count = BlogViewCount::where('blog_id',$row->id)->count();
                        if($yes_votes!=0){
                            $yes_percent = ($yes_votes/$total_votes)*100;
                        }else{
                            $yes_percent = 0;
                        }
                        if($no_votes!=0){
                            $no_percent = ($no_votes/$total_votes)*100;
                        }else{
                            $no_percent = 0;
                        }                 
                        $row->yes_percent = $yes_percent;
                        $row->no_percent = $no_percent; 
                        $author = Author::where('id',$row->author_id)->first();
                        if($author){                    
                            $row->author_name = $author->name;
                            if($author->image!=null || $author->image!=''){
                                $row->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $row->image = url('upload/author/default.png');
                            }
                        }else{
                            $row->author_name = "";
                            $row->image = url('upload/author/default.png');
                        }
                        $category = Category::where('id',$row->category_id)->first();
                        if($category){                  
                            $row->category_name = $category->name;
                            $row->color = $category->color;
                        }else{
                            $row->category_name = "";
                            $row->color = "";
                        }
                        $row->time = $row->time. " min";
                        $row->create_date = date("d M Y // h:i a",strtotime($row->created_at));
                    }                        
                    return response(\Helpers::sendSuccessAjaxResponse(ucfirst($post['type']).' result found.',$blog));
                }else{
                    return response(\Helpers::sendFailureAjaxResponse("Search not found."));
                }
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
}