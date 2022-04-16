@extends('../layout/' . $layout)

@section('subhead')
    <title>Push Notification - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Push Notification</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label>Enable Push Notification</label>
                    <div class="flex items-center text-gray-700 dark:text-gray-500 mt-2">
                        <input type="checkbox" class="input border mr-2" id="vertical-checkbox-chris-evans">
                        <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Check it to push notification using(Firebase cloud messaging)</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Firebase Cloud Messaging Key</label>
                    <input type="text" class="input w-full border mt-2" placeholder="AAAyghghjRASGfgfgfDSRTFGYJGfffHGFGHF">
                </div>
                <div class="mt-3">
                    <label>API Key</label>
                    <input type="text" class="input w-full border mt-2" placeholder="API Key">
                </div>
                <div class="mt-3">
                    <label>Database URL</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Database URL">
                </div>
                <div class="mt-3">
                    <label>Storage Bucket</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Storage Bucket">
                </div>
                <div class="mt-3">
                    <label>Application ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Application ID">
                </div>                
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label>Auth Domain</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Auth Domain">
                </div>
                <div class="mt-3">
                    <label>Project ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Project ID">
                </div>
                <div class="mt-3">
                    <label>Messaging Sender ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Messaging Sender ID">
                </div>
                <div class="mt-3">
                    <label>Measurement ID</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Measurement ID">
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