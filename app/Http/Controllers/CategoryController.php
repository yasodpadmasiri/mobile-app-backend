<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Show Category view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$layout = 'side-menu', $theme = 'light')
    {
        $category = Category::getAllCategory($request->all());
        return view('category.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'category'=>$category
        ]);
    }

    /**
     * Show Category view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUpdateCategory(Request $request)
    {
        $post = $request->all();
        if(!empty($post)){
            if(!isset($post['id'])){
                $id = Category::addCategory($post);
                $msg = 'successfully added';
            }else{
                $id = Category::updateCategory($post);
                $msg = 'successfully updated';
            }            
            return array('success'=>true,'data'=>$id,'message'=>$msg);
        }else{
            return array('success'=>false,'data'=>null,'message'=>'something went wrong');
        }
    }


    /**
     * Method to delete category
     * @param array $request post data, id
    */
    public function deleteCategory(Request $request,$id)
    {
        Category::where('id', $id)->delete();      
        return back()->with('success','Category deleted successfully.');
    }
    /**
     * Method to change status of category
     * @param array $request post data ,id ,status
    */
    public function changeCategoryStatus(Request $request,$id,$status)
    {
        $post['status'] = $status;
        $post['id'] = $id;
        Category::updateCategory($post);         
        return back()->with('success','Category status changed successfully.');  
    }
}
