@extends('../layout/' . $layout)

@section('subhead')
    <title>Edit {{$data->page_title}} - Blog</title>
@endsection

@section('subcontent')
<link href="{{ asset('dist/css/tagsinput.css') }}" rel="stylesheet" type="text/css">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit {{$data->page_title}}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <form id="addUpdateBlog">
                <?php 
                    if(file_exists(public_path()."/upload/cms/original/".$data->image) && $data->image!='') { 
                        $bannerurl = url('upload/cms/original').'/'.$data->image;
                    }else{
                        $bannerurl = url('upload/no-image.png');
                    }
                   
                ?>
                <input type="hidden" name="id" value="{{$data->id}}">
                
                    <div class="mt-3">
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title" placeholder="Title" value="{{$data->title}}">
                    </div>
                    
               
                    <div class="mt-3">
                        <label>Description</label>
                        <div class="mt-2">
                            <div class="preview">
                                <textarea name="blogdescription">{{$data->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="grid grid-cols-12 gap-4 row-gap-3">
                           
                            
                            <div class="col-span-12 sm:col-span-4">
                                <input type="hidden" name="banner_image" id="banner_image" value="">
                                <div class="col-span-12 sm:col-span-12">
                                    <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Banner Image" onclick="triggerFileInput('BannerimageuploadBtn')">
                                    <input class="BannerimageuploadBtn" style="display: none;" type="file" name="Bannerimage" onchange="uploadCmsBannerImage(this,'Bannerimage_image_add','add',0);" accept="image/jpg, image/jpeg"/>
                                </div>
                                <div class="col-span-12 sm:col-span-12 mt-3" >
                                    <img id="Bannerimage_image_add" src="{{$bannerurl}}" style="width: 30%;" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right mt-5">
                        <a href="{{url('cms-pages/side-menu/light')}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Back</a>
                        <button type="button" id="createBtn" class="button w-24 bg-theme-1 text-white" onclick="addUpdateCmsPage(event,'addUpdateBlog')">Update</button>
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