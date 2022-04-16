/* Show loader start */
function showLoader() {
    $('#overlay').fadeIn();
}
/* Show loader end */

/* Hide loader start */
function hideLoader() {
    $('#overlay').fadeOut();
}

function myToastr(msg, type) {
    toastr.remove();
    if(type == 'error') {
      toastr.error(msg);
    } else if(type == 'success') {
      toastr.success(msg);
    }
}

$(document).ready(function() {
    $('.image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        }
    });
});



function printArea(){
    document.getElementById('iframeid').contentWindow.print();
}

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    var l = 0;
    $.map(unindexed_array, function(n, i){
        if(n['name']=='category_id[]'){
            if(l==0){
                indexed_array['category_id'] = [];
            }
            indexed_array['category_id'].push(n['value']);
            l++;
        }else{
            indexed_array[n['name']] = n['value'];
        }
    });
    return indexed_array;
}

function validateEmail(email){
    var x = email;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        return true;
    }else{
        return false;
    }
}



function setDataLimit(limit,getData,type,portal){
    var url;
    if(getData=='NA'){
        //console.log(base_url+"/"+portal+"/"+type+"?per_page="+limit);
        window.location.href= base_url+"/"+portal+"/"+type+"?per_page="+limit;
    }else{
        var res = getData.split("&");
        var myarray = [];
        $.each( res, function( key, value ) {
            var res1 = value.split("=");
            if(res1[0]=='per_page'){
                res1[1] = limit;
            }
            var newRes = res1.join("=");
            myarray.push(newRes);
        });
        var newUrl = myarray.join("&");
        if(newUrl){
            //console.log(base_url+"/"+portal+"/"+type+"?"+newUrl);
            window.location.href= base_url+"/"+portal+"/"+type+"?"+newUrl;
        }
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



function add_category(e,formid){
    var $form = $("#"+formid);
    var data = getFormData($form);
    console.log(data);
    e.preventDefault();    
    if(data.name != ''){
        $.ajax({
            type : 'POST',
            url : base_url+"/add-update-category",
            headers : {},
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            success:function(response){
                console.log(response);
                if(response.success){
                    myToastr(response.message,'success');                                  
                    highdata = response.data;
                    setTimeout(function(){
                        window.location.reload();
                    }, 500);
                }else{
                    myToastr(response.message,'error');                                  
                }
            }
        });
    }else{
        myToastr('Enter category','error');                                  
    }
}


var blogThumbImage;
function uploadCategoryThumbImage(input,previewid,type,id) {

    var createBtn = 'createBtn';

    if (id == 0) {
        var authorimage = 'thumb_image';
    }else{
        var authorimage = 'thumb_image_'+id;
    }


    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);

                    $('#'+previewid).attr('src',e.target.result);

                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadCategoryThumbImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                blogThumbImage = data.data;
                                if(blogThumbImage!=undefined){
                                    console.log(blogThumbImage);
                                    $('#'+authorimage).val(blogThumbImage);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}




function triggerFileInput(className){
    $('.'+className).click();
}

var authorImage;
function uploadauthorImage(input,previewid,type,id) {

    if (id) {
        var createBtn = 'createBtn'+id;
        var authorimage = 'authorimage'+id;
    }else{
        createBtn = 'createBtn';
        authorimage = 'authorimage';
    }

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    // $('#createBtn').prop('disabled', true);
    // $('#createBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading');
    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                // $("#preloader").show();
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    if(type=="add"){
                        $("#show_cat_image_add").show();
                        $('#'+previewid).attr('src',e.target.result);
                    }else if(type=="update"){
                        $("#image_update_"+id+"").attr('src',e.target.result);
                    }
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                category_image = data.data;
                                if(category_image!=undefined){
                                    console.log(category_image);
                                    $('#'+authorimage).val(category_image);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}


function addUpdateAuthor(e,formid){
    var $form = $("#"+formid);
    var data = getFormData($form);
    console.log(data);
    var flag = true;
    e.preventDefault();    
    if(data.name == ''){
        flag = false;
        myToastr('Enter name','error');                                  
    }else if(data.email == ''){
        flag = false;
        myToastr('Enter email','error');                                  
    }

    if (flag) {
        $.ajax({
            type : 'POST',
            url : base_url+"/addUpdateAuthor",
            headers : {},
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            success:function(response){
                console.log(response);
                if(response.status){
                    myToastr(response.message,'success');                                  
                    highdata = response.data;
                    setTimeout(function(){
                        window.location.reload();
                    }, 500);
                }else{
                    myToastr(response.message,'error');                                  
                }
            }
        });
    }
}


var blogThumbImage;
function uploadblogThumbImage(input,previewid,type,id) {

    var createBtn = 'createBtn';
    var authorimage = 'thumb_image';

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);

                    $('#'+previewid).attr('src',e.target.result);

                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadBlogThumbImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                blogThumbImage = data.data;
                                if(blogThumbImage!=undefined){
                                    console.log(blogThumbImage);
                                    $('#'+authorimage).val(blogThumbImage);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}


var BannerImage;
function uploadBannerImage(input,previewid,type,id) {

    var createBtn = 'createBtn';
    var authorimage = 'banner_image';

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    $('#'+previewid).attr('src',e.target.result);
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadBannerImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                BannerImage = data.data;
                                if(BannerImage!=undefined){
                                    console.log(BannerImage);
                                    $('#'+authorimage).val(BannerImage);
                                    $('#'+createBtn).prop('disabled', false);
                                    console.log(id);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}




var productMyltipleImages;
function uploadMultipleBannerImage(input,previewid,type,id){
    $("#"+previewid).html('');
    var createBtn = 'createBtn';
    var authorimage = 'banner_image';

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    var form_data = new FormData();
     // Read selected files
    var totalfiles = document.getElementById('image').files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("image[]", document.getElementById('image').files[index]);
    }
    $.ajax({
        url:base_url+'/uploadMultipleBannerImage',
        data:form_data,
        processData:false,
        contentType:false,
        type:'POST',
        dataType:'json',
        success:function(response){
            setTimeout(function(){
                if(response.status){
                    $("#"+previewid).show();
                    productMyltipleImages = response.data.images;
                    console.log(productMyltipleImages);
                    productMyltipleimages_url = response.data.images_url;
                    $('#'+createBtn).prop('disabled', false);
                    if($('#productId').val()){
                        $('#'+createBtn).html('Update');
                    }else{
                        $('#'+createBtn).html('Create');
                    }
                }
                console.log(productMyltipleimages_url);
                for(var index = 0; index < productMyltipleimages_url.length; index++) {
                    var src = productMyltipleimages_url[index];
                    $('#preview').append('<div style="background: url('+src+')" class="multipleUpload"></div>');
                }
            }, 10);
        }
    })
}



function addUpdateBlog(e,formid) {
    var $form = $("#"+formid);
    var data = getFormData($form);
    console.log(data);
    var flag = true;
    e.preventDefault();    
    if(data.category_id == ''){
        flag = false;
        myToastr('Select category','error');                                  
    }else if(data.author_id == ''){
        flag = false;
        myToastr('Select author','error');                                  
    }else if(data.title == ''){
        flag = false;
        myToastr('Enter title','error');                                  
    }


    data.image = productMyltipleImages;

    var desc = CKEDITOR.instances['blogdescription'].getData();
    // var short_description = CKEDITOR.instances['short_description'].getData();

    data.description = desc;
    // data.short_description = short_description;

    if (flag) {
        $.ajax({
            type : 'POST',
            url : base_url+"/addUpdateblog",
            headers : {},
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            success:function(response){
                console.log(response);
                //myToastr("Blog successfully created",'success');                                  
                    //highdata = response.data;
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 500);
                if(response.status){
                    myToastr(response.message,'success');                                  
                    highdata = response.data;
                    setTimeout(function(){
                        window.location.reload();
                    }, 500);
                }else{
                    myToastr(response.message,'error');                                  
                }
            },error: function(error){
// myToastr("Blog successfully created",'success'); 
//                     setTimeout(function(){
//                         window.location.reload();
//                     }, 500);
}



        });
    }
}


var logoUpload;
function uploadLogoImage(input,previewid,type,id) {

    if (id) {
        var createBtn = 'createBtn'+id;
        var logoimage = 'app_logo'+id;
    }else{
        createBtn = 'createBtn';
        logoimage = 'app_logo';
    }

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    // $('#createBtn').prop('disabled', true);
    // $('#createBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading');
    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                // $("#preloader").show();
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    if(type=="add"){
                        $("#show_cat_image_add").show();
                        $('#'+previewid).attr('src',e.target.result);
                    }else if(type=="update"){
                        $("#image_update_"+id+"").attr('src',e.target.result);
                    }
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadLogoImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                logoUpload = data.data;
                                if(logoUpload!=undefined){
                                    console.log(logoUpload);
                                    $('#'+logoimage).val(logoUpload);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}

var profileUpload;
function uploadProfileImage(input,previewid,type,id) {

    if (id!=0) {
        var createBtn = 'createBtn'+id;
        var logoimage = 'photo'+id;
    }else{
        createBtn = 'createBtn';
        logoimage = 'photo';
    }

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    // $('#createBtn').prop('disabled', true);
    // $('#createBtn').html('<i class="fa fa-spinner fa-spin"></i> Loading');
    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                // $("#preloader").show();
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    if(type=="add"){
                        $("#show_cat_image_add").show();
                        $('#'+previewid).attr('src',e.target.result);
                    }else if(type=="update"){
                        $("#image_update_"+id+"").attr('src',e.target.result);
                    }
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadProfileImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                profileUpload = data.data;
                                if(profileUpload!=undefined){
                                    console.log(profileUpload);
                                    $('#'+logoimage).val(profileUpload);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Save');
                                    }else{
                                        $('#'+createBtn).html('Save');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}


var bgUpload;
function uploadBgImage(input,previewid,type,id) {

    if (id) {
        var createBtn = 'createBtn'+id;
        var authorimage = 'bg_image'+id;
    }else{
        createBtn = 'createBtn';
        authorimage = 'bg_image';
    }

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                // $("#preloader").show();
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    if(type=="add"){
                        $('#'+previewid).attr('src',e.target.result);
                    }else if(type=="update"){
                        $("#image_update_"+id+"").attr('src',e.target.result);
                    }
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadBGImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                bgUpload = data.data;
                                if(bgUpload!=undefined){
                                    console.log(bgUpload);
                                    $('#'+authorimage).val(bgUpload);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Save');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}


var splashUpload;
function uploadsplashImage(input,previewid,type,id) {

    if (id) {
        var createBtn = 'createBtn'+id;
        var authorimage = 'splash_image'+id;
    }else{
        createBtn = 'createBtn';
        authorimage = 'splash_image';
    }

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                // $("#preloader").show();
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);
                    if(type=="add"){
                        $('#'+previewid).attr('src',e.target.result);
                    }else if(type=="update"){
                        $("#image_update_"+id+"").attr('src',e.target.result);
                    }
                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadsplashImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                splashUpload = data.data;
                                if(splashUpload!=undefined){
                                    console.log(bgUpload);
                                    $('#'+authorimage).val(splashUpload);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Save');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}



var BannerImage;
function uploadCmsBannerImage(input,previewid,type,id) {

    var createBtn = 'createBtn';
    var authorimage = 'banner_image';

    $('#'+createBtn).prop('disabled', true);
    $('#'+createBtn).html('<i class="fa fa-spinner fa-spin"></i> Loading');

    if(input.files && input.files[0]){
        var imgPath = input.files[0].name;
        console.log(imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if(typeof (FileReader) != "undefined"){
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                console.log(reader);
                reader.onload = function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log(type);

                    $('#'+previewid).attr('src',e.target.result);

                    var fd = new FormData();
                    fd.append('image', input.files[0]);
                    $.ajax({
                        url:base_url+'/uploadCMSBannerImage',
                        data:fd,
                        processData:false,
                        contentType:false,
                        type:'POST',
                        dataType:'json',
                        success:function(data){
                            setTimeout(function(){
                                BannerImage = data.data;
                                if(BannerImage!=undefined){
                                    console.log(BannerImage);
                                    $('#'+authorimage).val(BannerImage);
                                    $('#'+createBtn).prop('disabled', false);
                                    if(id){
                                        $('#'+createBtn).html('Update');
                                    }else{
                                        $('#'+createBtn).html('Create');
                                    }
                                }
                            }, 10);
                        }
                    })
                };
            }else{
                myToastr('Something went wrong','error');                                  
            }
        }else{
            myToastr('Please select only image','error');                                  
        }
    }
}



function addUpdateCmsPage(e,formid) {
    var $form = $("#"+formid);
    var data = getFormData($form);
    console.log(data);
    var flag = true;
    e.preventDefault();    
    if(data.title == ''){
        flag = false;
        myToastr('Enter title','error');                                  
    }
    var desc = CKEDITOR.instances['blogdescription'].getData();
    data.description = desc;
    if (flag) {
        $.ajax({
            type : 'POST',
            url : base_url+"/addUpdateCMSPage",
            headers : {},
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            success:function(response){
                console.log(response);
                if(response.status){
                    myToastr(response.message,'success');                                  
                    highdata = response.data;
                    setTimeout(function(){
                        window.location.reload();
                    }, 500);
                }else{
                    myToastr(response.message,'error');                                  
                }
            }
        });
    }
}


    $(function () {
          

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

    function sendOrderToServer() {
      var order = [];
      var token = $('meta[name="csrf-token"]').attr('content');
      $('tr.row1').each(function(index,element) {

        console.log($(this).attr('data-id'));

        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });
      console.log(order);
      $.ajax({
        type: "POST", 
        dataType: "json", 
        url:  base_url+"/category-sortable",
            data: {
                order: order,
                _token: token
            },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });
    }
  });
