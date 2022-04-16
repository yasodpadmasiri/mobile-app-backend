@extends('../layout/' . $layout)

@section('subhead')
    <title>CMS Pages List - Blog</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">CMS Pages List</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ID</th>
                        <th class="whitespace-no-wrap">Image</th>
                        <th class="whitespace-no-wrap">Title</th>
                        <th class="whitespace-no-wrap">Created At</th>
                        <th class="text-center whitespace-no-wrap">Action</th>
                    </tr>
                </thead>
                <?php 
                    $siteContent = DB::table('app_settings')->where('key','date_format')->first();
                ?>
                <tbody>
                    @if(count($cms))
                        <?php $i=1; ?>
                        @foreach ($cms as $row)
                            <tr class="intro-x">
                                <td class="w-40">
                                    {{$i}}
                                </td>
                         

                                <?php 
                                    if(file_exists(public_path()."/upload/cms/original/".$row->image) && $row->image!='') { 
                                        $url = url('upload/cms/original').'/'.$row->image;
                                    }else{
                                        $url = url('upload/no-image.png');
                                    }
                                ?>

                                <td>
                                    <a href="{{$url}}" class="image-popup" title="{{$row->image}}">
                                        <img src="{{$url}}" class="thumb-img-list" alt="{{$row->image}}" style="width: 80px;">
                                    </a>
                                </td>


                                <td>{{ $row->page_title }}</td>
                                <td>@if($row->created_at!=null){{ date($siteContent->value,strtotime($row->created_at)) }}@elseif($row->updated_at!=null){{ date($siteContent->value,strtotime($row->updated_at))}} @else -- @endif</td>
                               
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{url('edit-cms-page')}}/{{$row->id}}">
                                            <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                        </a>
                                    </div>
                                    
                                    <div class="modal" id="delete-confirmation-modal-{{$row->id}}">
                                        <div class="modal__content">
                                            <div class="p-5 text-center">
                                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                <div class="text-3xl mt-5">Are you sure?</div>
                                                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                                <a href="{{url('delete-category')}}/{{$row->id}}" class="button w-24 bg-theme-6 text-white">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    @else
                        <tr class="intro-x text-center" style="color: red;">
                            <td class="w-40" colspan="4">
                                No record found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
       
    </div>

@endsection