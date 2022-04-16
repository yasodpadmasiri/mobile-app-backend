@extends('../layout/' . $layout)

@section('subhead')
    <title>Mail - Blog</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Mail</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Mail Host</label>
                    <input type="text" class="input w-full border mt-2" placeholder="smtp.hostinger.com">
                </div>
                <div>
                    <label>Mail Port</label>
                    <input type="text" class="input w-full border mt-2" placeholder="587">
                </div>
                <div>
                    <label>Mail encryption</label>
                    <div class="mt-2">
                        <select data-placeholder="Select your mail encryption" class="tail-select w-full">
                            <option value="1" selected>SLL</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Username</label>
                    <input type="text" class="input w-full border mt-2" placeholder="productdelivery@blog.com">
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Mail Password</label>
                    <input type="password" class="input w-full border mt-2" placeholder="Test" value="787879878">
                </div>
                <div>
                    <label>Sender Email</label>
                    <input type="text" class="input w-full border mt-2" placeholder="productdelivery@blog.com">
                </div>
                <div>
                    <label>Sender Name</label>
                    <input type="text" class="input w-full border mt-2" placeholder="Blog">
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