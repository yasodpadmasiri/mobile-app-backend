<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = "score";

    public static function addScore($data) {
        try {
            $category = new self;
            $id=0;
//            dd($data);
            if($id = $category->insertGetId($data)) {
                return ['status' => true, 'message' => "Score added sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in adding contact" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    public static function updateScore($data) {
        try {
            $template = new self;
            $id=0;
            if($id = $template->where('id', $data['id'])->update($data)) {
                return ['status' => true, 'message' => "Score updated sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in updating category" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
