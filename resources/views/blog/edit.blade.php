@extends('../layout/' . $layout)

@section('subhead')
    <title>Edit Blog - Blog</title>
@endsection

@section('subcontent')
<link href="{{ asset('dist/css/tagsinput.css') }}" rel="stylesheet" type="text/css">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit Blog</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <form id="addUpdateBlog">
                <?php 
                    if(file_exists(public_path()."/upload/blog/banner/original/".$blog->banner_image) && $blog->banner_image!='') { 
                        $bannerurl = url('upload/blog/banner/original').'/'.$blog->banner_image;
                    }else{
                        $bannerurl = url('upload/no-image.png');
                    }
                    if(file_exists(public_path()."/upload/blog/thumb/original/".$blog->thumb_image) && $blog->thumb_image!='') { 
                        $thumburl = url('upload/blog/thumb/original').'/'.$blog->thumb_image;
                    }else{
                        $thumburl = url('upload/no-image.png');
                    }
                ?>
                <input type="hidden" name="id" value="{{$blog->id}}">
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <div class="grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label>Category</label>
                                <div class="mt-2">
                                    <select data-placeholder="Select Category" name="category_id" class="tail-select w-full">
                                        <option value="" >Select Category</option>
                                        @foreach($category as $cat)
                                            <option @if($cat->id == $blog->category_id) selected  @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label>Author</label>
                                <div class="mt-2">
                                    <select data-placeholder="Select your author"  name="author_id" class="tail-select w-full">
                                        <option value="" >Select Author</option>
                                        @foreach($author as $auth)
                                            <option @if($auth->id == $blog->author_id) selected  @endif value="{{$auth->id}}">{{$auth->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title" placeholder="Title" value="{{$blog->title}}">
                    </div>
                    <div class="mt-3">
                        <label>Tags</label>
                        <input type="text" class="input w-full border mt-2" name="tags" data-role="tagsinput" value="{{$blog->tags}}" placeholder="Tags">
                    </div>
                    <!-- <div class="mt-3">
                        <label>Short Description</label>
                        <div class="mt-2">
                            <div class="preview">
                                <textarea name="short_description">{{$blog->short_description}}</textarea>
                            </div>
                        </div>
                    </div> -->
                    <div class="mt-3">
                        <label>Description</label>
                        <div class="mt-2">
                            <div class="preview">
                                <textarea name="blogdescription">{{$blog->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12 sm:col-span-4">
                                <label>Time</label>
                                <div class="col-span-12 sm:col-span-12">
                                    <input type="number" class="input w-full border mt-2" name="time" placeholder="Time" min="0" value="{{$blog->time}}">
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <input type="hidden" name="thumb_image" id="thumb_image" value="">
                                <div class="col-span-12 sm:col-span-12">
                                    <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Thumb Image" onclick="triggerFileInput('thumbimageuploadBtn')">
                                    <input class="thumbimageuploadBtn" style="display: none;" type="file" name="thumbimage" onchange="uploadblogThumbImage(this,'thumbimage_image_add','update',{{$blog->id}});" accept="image/jpg, image/jpeg"/>
                                </div>
                                <div class="col-span-12 sm:col-span-12 mt-3" >
                                    <img id="thumbimage_image_add" src="{{$thumburl}}" style="width: 30%;" >
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <input type="hidden" name="banner_image" id="banner_image" value="">
                                <div class="col-span-12 sm:col-span-12">
                                    <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Banner Image" onclick="triggerFileInput('BannerimageuploadBtn')">
                                    <input class="BannerimageuploadBtn" style="display: none;" type="file" name="Bannerimage" onchange="uploadBannerImage(this,'Bannerimage_image_add','update',{{$blog->id}});" accept="image/jpg, image/jpeg"/>
                                </div>
                                <div class="col-span-12 sm:col-span-12 mt-3" >
                                    <img id="Bannerimage_image_add" src="{{$bannerurl}}" style="width: 30%;" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Feature</label>
                        <div class="mt-2">
                            <input type="checkbox" name="is_featured" class="input input--switch border" @if($blog->is_featured) checked @endif>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{url('blog/side-menu/light')}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Back</a>
                        <button type="button" id="createBtn" class="button w-24 bg-theme-1 text-white" onclick="addUpdateBlog(event,'addUpdateBlog')">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
    <script>
        CKEDITOR.replace( 'blogdescription' );
        CKEDITOR.replace( 'short_description' );
  </script>
@endsection