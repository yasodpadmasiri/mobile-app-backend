@extends('../layout/' . $layout)

@section('subhead')
    <title>Category List - Blog</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Search Log List</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="hidden md:block mx-auto text-gray-600">  </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <form method="GET">
                        <input type="text" class="input w-56 box pr-10 placeholder-theme-13" @if(isset($_GET['search_keyword'])) value="{{$_GET['search_keyword']}}" @endif name="search_keyword" placeholder="Search by search keyword...">
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
                        <th class="whitespace-no-wrap">Search Keyword</th>
                        <th class="whitespace-no-wrap">Search Count</th>
                        <th class="whitespace-no-wrap">Created At</th>
                    </tr>
                </thead>
                <?php 
                    $siteContent = DB::table('app_settings')->where('key','date_format')->first();
                ?>
                <tbody>
                    @if(count($search))
                        <?php $i=1; ?>
                        @foreach ($search as $row)
                            <tr class="intro-x">
                                <td class="w-40">
                                    {{$i}}
                                </td>
                                <td>{{ $row->search_keyword }}</td>
                                <td>{{ $row->search_count }}</td>
                                <td>@if($row->created_at!=null){{ date($siteContent->value,strtotime($row->created_at)) }}@else -- @endif</td>
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
        <div class="intro-y col-span-8 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                {!! $search->appends(request()->except('page'))->render() !!}
            </ul>
        </div>
        <div class="intro-y col-span-1 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            
        </div>
        <div class="intro-y col-span-3 flex flex-wrap sm:flex-row sm:flex-no-wrap items-right">
            <p><?php if ($search->firstItem() != null) { ?> Showing {{ $search->firstItem() }} to {{ $search->lastItem() }} of {{ $search->total() }} entries <?php }?></p>
        </div>
    </div>
    <div class="modal" id="header-footer-modal-preview">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Add Category</h2>
            </div>
            <form id="addcategoryform">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label>Category name</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="name" placeholder="Category">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                    <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                    <input type="button" class="button w-20 bg-theme-1 text-white" value="Create" onclick="add_category(event,'addcategoryform')">
                </div>
            </form>            
        </div>
    </div>
@endsection