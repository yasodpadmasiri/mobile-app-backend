@extends('../layout/' . $layout)

@section('subhead')
    <title>Users List - Blog</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Users List</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="hidden md:block mx-auto text-gray-600">  </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <form method="GET">
                        <input type="text" class="input w-56 box pr-10 placeholder-theme-13" @if(isset($_GET['name'])) value="{{$_GET['name']}}" @endif name="name" placeholder="Search by  title...">
                        <a href="javascript:;" onclick="searchClick();"><i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i></a>
                        <input type="submit" id="search" style="display: none;" name="search">
                    </form>
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ID</th>
                        <th class="whitespace-no-wrap">Image</th>
                        <th class="whitespace-no-wrap">Name</th>
                        <th class="whitespace-no-wrap">Phone</th>
                        <th class="whitespace-no-wrap">Email</th>
                        <th class="whitespace-no-wrap">Created At</th>
                        <th class="text-center whitespace-no-wrap">Status</th>
                        <th class="text-center whitespace-no-wrap">Action</th>
                    </tr>
                </thead>
                <?php 
                    $siteContent = DB::table('app_settings')->where('key','date_format')->first();
                ?>
                <tbody>
                    @if(count($user))
                        <?php $i=1; ?>
                        @foreach ($user as $row)
                            <tr class="intro-x">
                                <td class="w-40">
                                    {{$i}}
                                </td>

                                <?php 
                                    if(file_exists(public_path()."/user/".$row->image) && $row->image!='') { 
                                        $url = url('user').'/'.$row->image;
                                    }else{
                                        $url = url('upload/no-image.png');
                                    }
                                ?>

                                <td>
                                    <a href="{{$url}}" class="image-popup" title="{{$row->name}}">
                                        <img src="{{$url}}" class="thumb-img-list" alt="{{$row->name}}" style="width: 80px;">
                                    </a>
                                </td>

                                <td>{{ $row->name }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->email }}</td>   
                                <td>{{ date($siteContent->value,strtotime($row->created_at)) }}</td>                            

                                <td class="w-40">
                                    @if($row->active==1)
                                        <a href="{{url('change-status-user/')}}/{{$row->id}}/0">
                                            <div class="flex items-center justify-center text-theme-9">
                                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active
                                            </div>
                                        </a> 
                                    @else
                                        <a href="{{url('change-status-user/')}}/{{$row->id}}/1">
                                            <div class="flex items-center justify-center text-theme-6">
                                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i>Inactive
                                            </div>
                                        </a>
                                    @endif                               
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal-{{$row->id}}">
                                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                        </a>
                                    </div>
                                       <div class="modal" id="header-footer-modal-preview_edit_{{$row->id}}">
                                            <div class="modal__content">
                                                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                                    <h2 class="font-medium text-base mr-auto">Edit Author</h2>
                                                </div>
                                                <form id="editcategoryform_{{$row->id}}">
                                                    <input type="hidden" name="authorimage" id="authorimage{{$row->id}}" value="">
                                                    <input type="hidden" name="id"  value="{{$row->id}}">

                                                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <label>Name</label>
                                                            <input type="text" class="input w-full border mt-2 flex-1" name="name" placeholder="Name" value="{{$row->name}}">
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-12">
                                                            <label>Email</label>
                                                            <input type="text" class="input w-full border mt-2 flex-1" name="email" placeholder="Email" value="{{$row->email}}">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <label>Designation</label>
                                                            <input type="text" class="input w-full border mt-2 flex-1" name="designation" placeholder="Designation" value="{{$row->designation}}">
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-12">
                                                            <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Image" onclick="triggerFileInput('uploadBtn_{{$row->id}}')">
                                                            <input class="uploadBtn_{{$row->id}}" style="display: none;" type="file" name="image" onchange="uploadauthorImage(this,'image_add','update','{{$row->id}}');" accept="image/jpg, image/jpeg"/>
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-12">
                                                            <img id="image_update_{{$row->id}}" src="{{$url}}" style="width: 20%;" >
                                                        </div>
                                                    </div>                                                   

                                                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                                                        <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                                        <input type="button" class="button w-20 bg-theme-1 text-white" id="createBtn{{$row->id}}" value="Update" onclick="addUpdateAuthor(event,'editcategoryform_{{$row->id}}')">
                                                    </div>
                                                </form>            
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
                                                <a href="{{url('delete-user')}}/{{$row->id}}" class="button w-24 bg-theme-6 text-white">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    @else
                        <tr class="intro-x text-center" style="color: red;">
                            <td class="w-40" colspan="7">
                                No record found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
         <div class="intro-y col-span-8 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                {!! $user->appends(request()->except('page'))->render() !!}
            </ul>
        </div>
        <div class="intro-y col-span-1 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            
        </div>
        <div class="intro-y col-span-3 flex flex-wrap sm:flex-row sm:flex-no-wrap items-right">
            <p><?php if ($user->firstItem() != null) { ?> Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} of {{ $user->total() }} entries <?php }?></p>
        </div>
    </div> 
    <div class="modal" id="header-footer-modal-preview">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Add Author</h2>
            </div>
            <form id="addAuthorForm">
                <input type="hidden" name="authorimage" id="authorimage" value="">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label>Name</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="name" placeholder="Name">
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label>Email</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="email" placeholder="Email">
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label>Designation</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="designation" placeholder="Designation">
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <input type="button" class="button w-30 bg-theme-1 text-white" value="Upload Image" onclick="triggerFileInput('uploadBtn')">
                        <input class="uploadBtn" style="display: none;" type="file" name="image" onchange="uploadauthorImage(this,'image_add','add',0);" accept="image/jpg, image/jpeg"/>
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <img id="image_add" src="" style="width: 20%;" >
                    </div>
                </div>           
                <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                    <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                    <input type="button" class="button w-20 bg-theme-1 text-white" id="createBtn" value="Create" onclick="addUpdateAuthor(event,'addAuthorForm')">
                </div>
            </form>            
        </div>
    </div>
@endsection