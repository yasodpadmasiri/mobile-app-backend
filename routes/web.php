<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::middleware('loggedin')->group(function() {
    Route::get('login', 'AuthController@loginView')->name('login-view');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('register', 'AuthController@registerView')->name('register-view');
    Route::post('register', 'AuthController@register')->name('register');
});

Route::middleware('auth')->group(function() { 
    Route::get('/', 'DashboardController@index');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('page/{layout}/{theme}/{pageName}', 'PageController@loadPage')->name('page');
    Route::get('/dashboard/{layout}/{theme}', 'DashboardController@index');

    Route::get('/category/{layout}/{theme}', 'CategoryController@index');
    Route::post('/category/{layout}/{theme}', 'CategoryController@index');
    Route::post('/add-update-category', 'CategoryController@addUpdateCategory');


    Route::get('/author/{layout}/{theme}', 'AuthorController@index');
    Route::post('/author/{layout}/{theme}', 'AuthorController@index');
    Route::post('/uploadImage', 'AuthorController@uploadImage');


    Route::post('/addUpdateAuthor', 'AuthorController@addUpdateAuthor');
    Route::get('/change-status-author/{id}/{status}', 'AuthorController@changeAuthorStatus');
    Route::get('/deleteAuthor/{id}', 'AuthorController@deleteAuthor');

    Route::get('/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/change-status-category/{id}/{status}', 'CategoryController@changeCategoryStatus');
    
    Route::get('/blog/{layout}/{theme}', 'BlogController@index');
    Route::post('/blog/{layout}/{theme}', 'BlogController@index');

    Route::get('/add-blog', 'BlogController@addBlog');


    Route::get('/edit-blog/{id}', 'BlogController@editBlog');


    Route::get('/delete-blog/{id}', 'BlogController@deleteBlog');
	Route::get('/change-status-blog/{id}/{status}', 'BlogController@changeBlogStatus');

    Route::post('/uploadBlogThumbImage', 'BlogController@uploadBlogThumbImage');
    Route::post('/uploadBannerImage', 'BlogController@uploadBannerImage');


    Route::post('/addUpdateblog', 'BlogController@addUpdateblog');



    Route::get('/users/{layout}/{theme}', 'UserController@index');
    Route::post('/users/{layout}/{theme}', 'UserController@index');

    Route::get('/delete-user/{id}', 'UserController@deleteUser');
    Route::get('/change-status-user/{id}/{status}', 'UserController@changeUserStatus');
    Route::get('/profile/{layout}/{theme}', 'UserController@profile');
    Route::post('/editProfile', 'UserController@editProfile');
    Route::post('/uploadProfileImage', 'UserController@uploadProfileImage');


    Route::get('/setting/{layout}/{theme}', 'SiteContentController@index');


    Route::get('/settings/{page}', 'SiteContentController@editSetting');


    Route::get('/sendMail', 'SiteContentController@sendMail');
    


    Route::post('/uploadLogoImage', 'SiteContentController@uploadLogoImage');
    Route::post('/uploadBGImage', 'SiteContentController@uploadBGImage');
    Route::post('/uploadsplashImage', 'SiteContentController@uploadsplashImage');



    Route::post('/updateSetting', 'SiteContentController@updateSetting');

    Route::get('/search-log/{layout}/{theme}', 'SearchController@index');
    Route::post('/search-log/{layout}/{theme}', 'SearchController@index');
    


});
Route::get('/privacy', 'SiteContentController@updateSetting');
Route::get('/sendTest', 'SiteController@sendTest');
Route::get('/privacy', 'SiteController@privacy');
Route::get('/terms', 'SiteController@terms');
Route::get('/about-us', 'SiteController@about');
Route::get('/contact-us', 'SiteController@contact');
Route::get('/advertise', 'SiteController@advertise');
Route::get('/join-us', 'SiteController@join');
