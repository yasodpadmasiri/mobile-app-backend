@extends('../layout/' . $layout)

@section('subhead')
    <title>Localisation - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Localisation</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <form method="post" action="{{url('/updateSetting')}}">
                        {{ csrf_field() }}
                        @foreach($data as $row)
                            @if($row->key == 'date_format')

                                <div>
                                    <label>Date Format</label>
                                    <input type="text" class="input w-full border mt-2" name="date_format" value="{{$row->value}}" placeholder="} jS F Y (H:i:s)">
                                </div>
                            @endif
                            @if($row->key == 'language')
                                <div class="mt-3">
                                    <label>Application Language</label>
                                    <div class="mt-2">
                                        <select data-placeholder="Select language" name="language" class="tail-select w-full">
                                            <option @if($row->value == 'en') selected  @endif value="en" >English</option>
                                            <option @if($row->value == 'hi') selected  @endif value="hi" >Hindi</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if($row->key == 'timezone')
                                <div class="mt-3">
                                    <label>Timezone</label>
                                    <div class="mt-2">
                                        <select data-placeholder="Select timezone" name="timezone" class="tail-select w-full">
                                            @for($c= 0; $c< count($zones);$c++)
                                                <option @if($row->value == $zones[$c]) selected  @endif value="{{$zones[$c]}}" >{{$zones[$c]}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            @endif                            
                        @endforeach
                        <div class="text-right mt-5">
                            <a href="{{url('/setting')}}/{{$layout}}/{{$theme}}" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                            <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>    
@endsection