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
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label>Date Format</label>
                    <input type="text" class="input w-full border mt-2" placeholder="} jS F Y (H:i:s)">
                </div>
                <div class="mt-3">
                    <label>Application Language</label>
                    <div class="mt-2">
                        <select data-placeholder="Select language" class="tail-select w-full">
                            <option value="1" selected>English</option>
                            <option value="2">Hindi</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Timezone</label>
                    <div class="mt-2">
                        <select data-placeholder="Select timezone" class="tail-select w-full">
                            <option value="1" selected>Asia/Kolkata</option>
                        </select>
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