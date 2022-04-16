<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
    protected $table = "vote";
    protected $dates = ['deleted_at'];
    /**
     * Add Blog
     * @param Array of post data
     * @return category_id 
    */
    public static function addVote($data) {
        try {
            $vote = new self;
            $id=0;
            if($id = $vote->insertGetId($data)) {
                return ['status' => true, 'message' => "Vote added sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in adding vote" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    /**
     * Get Search log
     * @param Search data
     * @return array 
    */
    public static function getAllVote($search = ''){
        try {
            $contact = new self;
            $pagination_no = 10;
            // $pagination_no = config('constant.paginate.num_per_page');   
            if(isset($search['per_page']) && !empty($search['per_page'])){
                $pagination_no = $search['per_page'];
            }
            // if(isset($search['search_keyword']) && $search['search_keyword'] != ''){
            //   $keyword = $search['search_keyword'];
            //   $contact = $contact->where(function($q) use ($keyword){
            //         $q->where(DB::raw('LOWER(search_keyword)'), 'like', '%'.strtolower($keyword). '%');
            //     });
            // }
            $data = $contact->orderBy('id','DESC')
                    ->paginate($pagination_no)->appends('per_page', $pagination_no);
            
                    return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
