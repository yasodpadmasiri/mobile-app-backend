<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogAuthor;
use App\Models\Author;
use App\Models\BlogCategory;
use App\Models\SiteContent;
use Illuminate\Support\Facades\Validator;

class SettingAPIController extends Controller
{
    /**
     * Show list of settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        try {
            $settings = SiteContent::get();            
            return $this->sendResponse($settings, 'List of all settings');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
}
