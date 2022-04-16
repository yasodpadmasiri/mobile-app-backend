@extends('../layout/' . $layout)

@section('subhead')
    <title>Global Setting - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Global Setting</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box p-5">
                <form method="post" action="{{url('/updateSetting')}}">
                    {{ csrf_field() }}
                    @foreach($data as $row)
                        @if($row->key == 'app_name')
                            <div>
                                <label>Application Name</label>
                                <input type="text" class="input w-full border mt-2" name="app_name" value="{{$row->value}}" placeholder="App Name">
                            </div>
                        @endif
                        @if($row->key == 'app_subtitle')

                            <div class="mt-3">
                                <label>Application Subtitle</label>
                                <input type="text" class="input w-full border mt-2" name="app_subtitle" value="{{$row->value}}" placeholder="App Subtitle">
                            </div>

                        @endif
                    @endforeach
                    @foreach($data as $row)
                        @if($row->key == 'bg_image')
                            <?php 
                                if(file_exists(public_path()."/upload/bg/".$row->value) && $row->value!='') { 
                                    $url = url('upload/bg').'/'.$row->value;
                                }else{
                                    $url = url('upload/no-image.png');
                                }
                            ?>
                            <input type="hidden" name="bg_image" id="bg_image" value="">
                            <div class="mt-3">
                                <label>Background Image</label>
                                <div class="col-span-12 sm:col-span-12">
                                    <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Background Image" onclick="triggerFileInput('bguploadBtn')">
                                    <input class="bguploadBtn" style="display: none;" type="file" name="bgimage" onchange="uploadBgImage(this,'bgimage_add','add',0);" accept="image/jpg, image/jpeg"/>
                                </div>
                                <div class="col-span-12 sm:col-span-12 mt-3">
                                    <img id="bgimage_add" src="{{$url}}" style="width: 20%;" >
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="text-right mt-5">
                        <a href="{{url('/setting')}}/{{$layout}}/{{$theme}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                        <button type="submit" class="button w-24 bg-theme-1 text-white" id="createBtn">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>    
@endsection