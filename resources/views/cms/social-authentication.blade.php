@extends('../layout/' . $layout)

@section('subhead')
    <title>Social Authentication - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Authentication Using Facebook</h2>
    </div>

    <form method="post" action="{{url('/updateSetting')}}">
        {{ csrf_field() }}

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-12">
                    <div class="intro-y box p-5">

                        @foreach($data as $row)

                            @if($row->key == 'enable_facebook')

                                <input type="hidden" name="enable_facebook_check" value="{{$row->value}}">

                                <div class="mt-3">
                                    <label>Enable Facebook</label>
                                    <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                                        <input type="checkbox" class="input border mr-2" name="enable_facebook" @if($row->value == 1)  checked @endif id="vertical-checkbox-chris-evans">
                                        <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Check it to use facebook as login method</label>
                                    </div>
                                </div>

                            @endif

                            @if($row->key == 'facebook_app_id')

                                <div class="mt-3">
                                    <label>Application ID</label>
                                    <input type="text" class="input w-full border mt-2" name="facebook_app_id" value="{{$row->value}}" placeholder="Application ID">
                                </div>

                            @endif  

                            @if($row->key == 'facebook_app_secret')
                                <div class="mt-3">
                                    <label>Application Secret</label>
                                    <input type="text" class="input w-full border mt-2" name="facebook_app_secret"  value="{{$row->value}}" placeholder="Application Secret">
                                </div>
                            @endif 
                        @endforeach
                    </div>
                </div>
            </div>    

            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">Authentication using google</h2>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-12">
                    <div class="intro-y box p-5">

                        @foreach($data as $row)

                            @if($row->key == 'enable_google')
                                <input type="hidden" name="enable_google_check" value="{{$row->value}}">
                            <div>
                                <label>Enable Google</label>
                                <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                                    <input type="checkbox" class="input border mr-2" name="enable_google" @if($row->value == 1)  checked @endif id="vertical-checkbox-chris-evans-fb">
                                    <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans-fb">Check it to use google as login method</label>
                                </div>
                            </div>

                            @endif

                            @if($row->key == 'google_app_id')

                                <div class="mt-3">
                                    <label>Application ID</label>
                                    <input type="text" class="input w-full border mt-2" name="google_app_id" value="{{$row->value}}" placeholder="Application ID">
                                </div>

                            @endif

                            @if($row->key == 'google_app_secret')

                                <div class="mt-3">
                                    <label>Application Secret</label>
                                    <input type="text" class="input w-full border mt-2" name="google_app_secret" value="{{$row->value}}" placeholder="Application Secret">
                                </div>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div> 

            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">Google Analytics </h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-12">
                    <div class="intro-y box p-5">

                        @foreach($data as $row)

                            @if($row->key == 'google_anlytics_code')

                                <div class="mt-3">
                                    <label>Google Analytics Code</label>
                                    <textarea class="input w-full border mt-2" name="google_anlytics_code" placeholder="Google Analytics Code">{{$row->value}}</textarea>
                                </div>

                            @endif


                        @endforeach

                        <div class="text-right mt-5">
                            <a href="{{url('/setting')}}/{{$layout}}/{{$theme}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                            <button type="sunmit" class="button w-24 bg-theme-1 text-white">Save</button>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
@endsection