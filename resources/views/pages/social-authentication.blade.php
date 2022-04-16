@extends('../layout/' . $layout)

@section('subhead')
    <title>Social Authentication - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Authentication Using Facebook</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Enable Facebook</label>
                    <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                        <input type="checkbox" class="input border mr-2" id="vertical-checkbox-chris-evans">
                        <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Check it to use facebook as login method</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Application ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Application ID">
                </div>
                <div class="mt-3">
                    <label>Application Secret</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Application Secret">
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>    

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Authentication using google</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Enable Google</label>
                    <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                        <input type="checkbox" class="input border mr-2" id="vertical-checkbox-chris-evans">
                        <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Check it to use google as login method</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Application ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Application ID">
                </div>
                <div class="mt-3">
                    <label>Application Secret</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Application Secret">
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