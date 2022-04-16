<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = "category";
    protected $dates = ['deleted_at'];
    /**
     * Add Contact
     * @param Array of post data
     * @return category_id 
    */
    public static function addCategory($data) {
        try {
            $category = new self;
            $id=0;
            if($id = $category->insertGetId($data)) {
                return ['status' => true, 'message' => "Category added sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in adding contact" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
    /**
     * Upadte Category
     * @param Array of post data
     * @return template_id
    */
    public static function updateCategory($data) {
        try {
            $template = new self;
            $id=0;              
            if($id = $template->where('id', $data['id'])->update($data)) {
                return ['status' => true, 'message' => "Category updated sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in updating category" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
    /**
     * Get All category
     * @param Search data
     * @return array 
    */
    public static function getAllCategory($search = ''){
        try {
            $contact = new self;
            $pagination_no = 10;
            // $pagination_no = config('constant.paginate.num_per_page');   
            if(isset($search['per_page']) && !empty($search['per_page'])){
                $pagination_no = $search['per_page'];
            }
            $data = $contact->orderBy('id','DESC')
                    ->paginate($pagination_no)->appends('per_page', $pagination_no);
            
                    return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
