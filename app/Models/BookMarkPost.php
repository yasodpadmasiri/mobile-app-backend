<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BookMarkPost extends Model
{
    protected $table = "bookmark_post";

    use SoftDeletes;

    protected $dates = ['deleted_at'];



    public function myblog(){
        return $this->hasOne('App\Models\Blog',"id","blog_id");
    }
}
