<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'photo','phone','type','fb_token'
    ];


    protected $hidden = ['password', 'remember_token'];
    // protected $appends = ['photo'];

    // public function getPhotoUrlAttribute()
    // {
    //     if ($this->foto !== null) {
    //         return url('media/user/' . $this->id . '/' . $this->foto);
    //     } else {
    //         return url('media-example/no-image.png');
    //     }
    // }



    /**
     * Get All category
     * @param Search data
     * @return array 
    */
    public static function getAllUsers($search = ''){
        //try {
            $contact = new self;
            $pagination_no = 10;
            if(isset($search['per_page']) && !empty($search['per_page'])){
                $pagination_no = $search['per_page'];
            }

            if(isset($search['name']) && $search['name'] != ''){
              $keyword = $search['name'];
              $contact = $contact->where(function($q) use ($keyword){
                    $q->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($keyword). '%')
                    ->orWhere(DB::raw('email'), 'like', '%'.strtolower($keyword). '%');
                });
            }

            $data = $contact->where('type','user')->orderBy('id','DESC')
                    ->paginate($pagination_no)->appends('per_page', $pagination_no);

            return $data;
        //}catch (\Exception $e) {
        //    return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
       //}
    }

    /**
     * Get All category
     * @param Search data
     * @return array 
    */
    public static function getAllUsersForDash($search = ''){
        try {
            $contact = new self;
            if(isset($search['name']) && $search['name'] != ''){
              $keyword = $search['name'];
              $contact = $contact->where(function($q) use ($keyword){
                    $q->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($keyword). '%')
                    ->orWhere(DB::raw('email'), 'like', '%'.strtolower($keyword). '%');
                });
            }
            $data = $contact->orderBy('id','DESC')
                    ->get();
            return $data;
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }


        /**
     * Upadte Category
     * @param Array of post data
     * @return template_id
    */
    public static function updateUser($data) {
        try {
            $template = new self;
            $id=0;              
            if($id = $template->where('id', $data['id'])->update($data)) {
                return ['status' => true, 'message' => "User updated sucessfully", 'id' =>$id];
            } else {
                return ['status' => false, 'message' => "Error in updating category" ];
            }
        }catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
}
