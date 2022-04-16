<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class ScoreAPIController extends Controller
{
    public function getScoreByUserID($userID){
        $score = Score::where('user_id', $userID)->sum('count_score');
        return $score;
    }

    public function saveScoreByUserID(Request $request){
//        dd($request->all());
        $post = $request->all();
        if(!empty($post)){
            if(!isset($post['id'])){
                $id = Score::addScore($post);
                $msg = 'successfully added';
            }else{
                $id = Score::updateScore($post);
                $msg = 'successfully added';
            }
            return array('success'=>true,'data'=>$id,'message'=>$msg);
        }else{
            return array('success'=>false,'data'=>null,'message'=>'something went wrong');
        }
    }

    public function getUsersScoreCount(){
        $returnArray = [];
        $score = '';
        $users = User::get()->toArray();
//        dd($users);
        if($users){
          foreach ($users as $key => $user){
              $users[$key]['score'] = $this->getScoreByUserID($user['id']);
              $users[$key]['rank'] = $key;
          }
        }
        $array = collect($users)->sortBy('score')->reverse()->values()->all();
        if($array){
          foreach ($array as $key => $user){
              $array[$key]['rank'] = $key;
          }
        }
        // return $users->sortBy('score')->reverse();
        return $array;
    }
    
    public function getUserRank($userID){
        $rank = 0;
        $userlist = $this->getUsersScoreCount();
        if($userlist){
            // dd($userlist);
          foreach ($userlist as $key => $user){
              if($user['id'] == $userID){
                //   dd($user['id']);
                  $rank = $key + 1;
              }
          }
        }
        return $rank;
    }
}
