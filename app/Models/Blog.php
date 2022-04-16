<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    protected $table = "blog";
    protected $dates = ['deleted_at'];



    // public function likes(){
    //     return $this->hasMany('App\Models\Vote',"blog_id","id");
    // }


    /**
     * Add Blog
     * @param Array of post data
     * @return category_id 
    */
    public static function addBlog($data) {
        try {
            $blog = new self;
            $id=0;
            if($id = $blog->insertGetId($data)) {
                return ['status' => true, 'message' => "Blogs added sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in adding blog" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Upadte Blog
     * @param Array of post data
     * @return template_id
    */
    public static function updateBlog($data) {
        try {
            $template = new self;
            $id=0;              
            if($id = $template->where('id', $data['id'])->update($data)) {
                return ['status' => true, 'message' => "Blog updated sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in updating blog" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Get All Blog
     * @param Search data
     * @return array 
    */
    public static function getAllBlog($search = ''){
        try {
            $contact = new self;
            $pagination_no = 10;
            // $pagination_no = config('constant.paginate.num_per_page');   
            if(isset($search['per_page']) && !empty($search['per_page'])){
                $pagination_no = $search['per_page'];
            }

            if(isset($search['name']) && $search['name'] != ''){
              $keyword = $search['name'];
              $contact = $contact->where(function($q) use ($keyword){
                    $q->where(DB::raw('LOWER(title)'), 'like', '%'.strtolower($keyword). '%');
                });
            }

            $data = $contact->orderBy('id','DESC')->paginate($pagination_no)->appends('per_page', $pagination_no);
            foreach($data as $likes){
                $likes->likes = Vote::where('blog_id',$likes->id)->get();
            }
            return $data;

        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Get All Blog
     * @param Search data
     * @return array 
    */
    public static function getAllActiveBlog($search = ''){
        try {
            $blog = new self;
            $pagination_no = 10;
            // $pagination_no = config('constant.paginate.num_per_page');   
            if(isset($search['per_page']) && !empty($search['per_page'])){
                $pagination_no = $search['per_page'];
            }
            $data = $blog->where('status',1)->orderBy('id','DESC')
                    ->paginate($pagination_no)->appends('per_page', $pagination_no);
            
                    return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Get All Blog
     * @param Search data
     * @return array 
    */
    public static function getAllActiveBlogForDash($search = ''){
        try {
            $blog = new self;
            $data = $blog->where('status',1)->orderBy('id','DESC')
                    ->get();
            
                    return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Get All Blog Details
     * @param blog id
     * @return object 
    */
    public static function getActiveBlogDetail($id){
        try {
            $blog = new self;
            
            $data = $blog->where('id',$id)->first();
            return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
