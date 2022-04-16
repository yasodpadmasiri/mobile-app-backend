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
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Application Name</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Smart Delivery">
                </div>
                <div>
                    <label>Short Description</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Manage Mobile Application">
                </div>
                <div class="mt-3">
                    <label>Theme Contract</label>
                    <div class="mt-2">
                        <select data-placeholder="Select theme contract" class="tail-select w-full">
                            <option value="1" selected>Light Theme</option>
                            <option value="2">Dark Theme</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Theme Color</label>
                    <div class="mt-2">
                        <select data-placeholder="Select theme color" class="tail-select w-full">
                            <option value="1" selected>Blue</option>
                            <option value="2">Green</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Application Logo</label>
                    <div class="preview">
                        <form data-single="true" action="/file-upload" class="dropzone border-gray-200 border-dashed">
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                            <div class="dz-message" data-dz-message>
                                <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                <div class="text-gray-600">
                                    This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded.
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
                    <button type="button" class="button w-24 bg-theme-1 text-white">Save</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>    
@endsection