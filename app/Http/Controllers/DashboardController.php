<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;



class DashboardController extends Controller
{
    /**
     * Show Dashboard view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($layout = 'side-menu', $theme = 'light')
    {
        $User = User::get();
        $Author = Author::getAllAuthorsForDash('');
        $Blog = Blog::getAllActiveBlogForDash('');
        $Category = Category::getAllforDashCategory('');

        return view('dashboard.index', [
            'theme' => $theme,
            'page_name' => 'index',
            'side_menu' => array(),
            'layout' => $layout,
            'user' => count($User),
            'author' => count($Author),
            'blog' => count($Blog),
            'category' => count($Category),
        ]);
    }
}
