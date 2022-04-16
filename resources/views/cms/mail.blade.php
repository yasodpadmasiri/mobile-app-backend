@extends('../layout/' . $layout)

@section('subhead')
    <title>Mail - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Mail</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <form method="post" action="{{url('/updateSetting')}}">
                <div class="intro-y box p-5">
                    {{ csrf_field() }}
                    @foreach($data as $row)
                        @if($row->key == 'mail_host')
                            <div class="mt-3">
                                <label>Mail Host</label>
                                <input type="text" class="input w-full border mt-2" name="mail_host" value="{{$row->value}}" placeholder="smtp.hostinger.com">
                            </div>
                        @endif

                        @if($row->key == 'mail_port')
                            <div class="mt-3"> 
                                <label>Mail Port</label>
                                <input type="text" class="input w-full border mt-2" name="mail_port" value="{{$row->value}}" placeholder="587">
                            </div>
                        @endif

                        @if($row->key == 'mail_encryption')

                        <div class="mt-3">
                            <label>Mail encryption</label>
                            <input type="text" class="input w-full border mt-2" name="mail_encryption" value="{{$row->value}}" placeholder="productdelivery@blog.com">
                        </div>
                        @endif

                        @if($row->key == 'mail_username')


                        <div class="mt-3">
                            <label>Username</label>
                            <input type="text" class="input w-full border mt-2" name="mail_username" value="{{$row->value}}" placeholder="productdelivery@blog.com">
                        </div>
                        @endif

                        @if($row->key == 'mail_password')
                             <div class="mt-3">
                                <label>Mail Password</label>
                                <input type="password" class="input w-full border mt-2" name="mail_password" value="{{$row->value}}"  placeholder="Test" value="787879878">
                            </div>
                        @endif

                        @if($row->key == 'mail_from_address')
                            <div class="mt-3">
                                <label>Sender Email</label>
                                <input type="text" class="input w-full border mt-2" name="mail_from_address" value="{{$row->value}}" placeholder="productdelivery@blog.com">
                            </div>
                        @endif
                        @if($row->key == 'mail_from_name')
                            <div class="mt-3">
                                <label>Sender Name</label>
                                <input type="text" class="input w-full border mt-2" name="mail_from_name" value="{{$row->value}}" placeholder="Blog">
                            </div>
                        @endif
                        @if($row->key == 'mail_mailer')
                            <div class="mt-3">
                                <label>Mailer</label>
                                <input type="text" class="input w-full border mt-2" name="mail_mailer" value="{{$row->value}}" placeholder="Blog">
                            </div>
                        @endif                        
                    @endforeach
                    <div class="text-right mt-5">
                        <a href="{{url('/setting')}}/{{$layout}}/{{$theme}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>        
@endsection