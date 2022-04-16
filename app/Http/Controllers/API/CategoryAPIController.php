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

class CategoryAPIController extends Controller
{
    /**
     * Show Category view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {

        try {
            $category = Category::where('status',1)->orderBy('order','ASC')->get();
            $final_arr = array();
            $i=0;
            $header = $request->header('userData');
            foreach($category as $row){
                if($row->image!=''){
                    $row->image= url('upload/category/580x400/'.$row->image);
                }else{
                    $row->image= url('upload/category/default.png');
                }
                $row->blog = array();
                $blog = Blog::where('status',1)->where('category_id',$row->id)->get();
                if($blog){
                    foreach ($blog as $detail) {
                        $detail->trimed_description = strip_tags($detail->description);
                        $detail->trimed_description =  str_replace("&nbsp;",'',$detail->trimed_description);
                        $detail->trimed_description =  str_replace("&#39;","'",$detail->trimed_description);
                        $detail->created_at = date("d M Y h:i a",strtotime($detail->created_at));
                        if($detail->thumb_image!=''){
                            $detail->thumb_image= url('upload/blog/thumb/original/'.$detail->thumb_image);
                        }else{
                            $detail->thumb_image= url('upload/blog/thumb/default.png');
                        }  
                        if($detail->banner_image!=''){
                        $detail->banner_image= url('upload/blog/banner/original/'.$detail->banner_image);
                    }else{
                        $detail->banner_image= url('upload/blog/banner/default.png');
                    } 
                        // $check_image = BlogImages::where('blog_id',$detail->id)->pluck('image');  
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
                        //     $detail->banner_image = $blog_image;
                        // }else{
                        //     // echo "000";
                        //     // echo json_encode($check_image);
                        //     $blog_image[0] = url('upload/author/default.png');
                        //     $detail->banner_image =  $blog_image;
                        // }  
                        if($header!=null){
                            $vote = Vote::where('user_id',$header)->where('blog_id',$detail->id)->first();
                            if($vote){
                                $detail->is_vote = 1;
                            }else{
                                $detail->is_vote = 0;
                            }
                            $bookmarked = BookMarkPost::where('user_id',$header)->where('blog_id',$detail->id)->first();
                            if($bookmarked){
                                $detail->is_bookmark = 1;
                            }else{
                                $detail->is_bookmark = 0;
                            }                         
                        }else{
                            $detail->is_vote = 0;
                            $detail->is_bookmark = 0;
                        }
                        $total_votes = Vote::where('blog_id',$detail->id)->count();
                        $yes_votes = Vote::where('blog_id',$detail->id)->where('vote',1)->count();
                        $no_votes = $total_votes - $yes_votes;
                        $detail->view_count = BlogViewCount::where('blog_id',$detail->id)->count();
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
                        $detail->yes_percent = $yes_percent;
                        $detail->no_percent = $no_percent;  
                        $author = Author::where('status',1)->where('id',$detail->author_id)->first();
                        if($author){
                            $detail->author_name = $author->name;
                            if($author->image!=''){
                                $detail->image = url('upload/author/580x400/'.$author->image);
                            }else{
                                $detail->image = url('upload/author/default.png');
                            }
                        }else{
                            $detail->author_name = "";
                            $detail->image = url('upload/author/default.png');
                        }
                        $detail->category_name = $row->name;
                        $detail->color = $row->color;
                        $detail->time = $detail->time. " min";
                        $detail->create_date = date("d M Y // h:i a",strtotime($detail->created_at));
                    }
                    $row->blog = $blog;
                    if(count($blog)>0){
                        $row->index = $i;
                        array_push($final_arr,$row);
                        $i++; 
                    }  
                                     
                }                
            }
            return $this->sendResponse($final_arr, 'List of all category');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
}