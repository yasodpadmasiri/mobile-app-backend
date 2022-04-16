@extends('../layout/' . $layout)

@section('subhead')
    <title>Push Notification - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Push Notification</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 ">
            <div class="intro-y box p-5">
                <form method="post" action="{{url('/updateSetting')}}">
                    {{ csrf_field() }}
                    @foreach($data as $row)
                    @if($row->key == 'push_notification_enabled')
                    <input type="hidden" name="pushNoti" value="{{$row->value}}">
                    <div class="mt-3">
                        <label>Enable Push Notification</label>
                        <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                            <input type="checkbox" class="input border mr-2" name="push_notification_enabled" @if($row->value == 1)  checked @endif  id="vertical-checkbox-chris-evans">
                            <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Check it to push notification using(Firebase cloud messaging)</label>
                        </div>
                    </div>
                    @endif

                    @if($row->key == 'firebase_msg_key')

                    <div class="mt-3">
                        <label>Firebase Cloud Messaging Key</label>
                        <input type="text" class="input w-full border mt-2" name="firebase_msg_key" value="{{$row->value}}" placeholder="AAAyghghjRASGfgfgfDSRTFGYJGfffHGFGHF">
                    </div>
                    @endif

                    @if($row->key == 'firebase_api_key')
                    <div class="mt-3">
                        <label>API Key</label>
                        <input type="text" class="input w-full border mt-2" name="firebase_api_key" value="{{$row->value}}" placeholder="API Key">
                    </div>
                    @endif
                @endforeach

                <div class="text-right mt-5">
                    <a href="{{url('/setting')}}/{{$layout}}/{{$theme}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                    <button type="sunmit" class="button w-24 bg-theme-1 text-white">Save</button>
                </div>

                </form>
            </div>
        </div>
    </div>    
@endsection