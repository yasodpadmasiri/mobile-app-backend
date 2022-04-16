<?php

use App\Models\User;
use App\Models\Blog;
use App\Models\Author;
use App\Models\Category;


class Helpers {

    public static function hello(){
        return 'hello';
    }


            /*
        check an create slug
    */
    public static function createSlug($title,$in='blog',$whr=0,$alphaNum = false){
        if($alphaNum){
            $slug = Str::slug($title.'-'.Str::random(15), '-');
        }else{
            $slug = Str::slug($title, '-');
        }
        if($in == 'blog'){
            $slugExist = Blog::where(DB::raw('LOWER(title)'),strtolower($slug))->where('id','!=',$whr)->get();
        }
        if(count($slugExist)){
            static::createSlug($title,$in,$whr,true);
        }else{
            return $slug;
        }
    }





    public static function checkNull($val=NULL){
        if($val == '' || $val == NULL){
            return '-';
        }else{
            return $val;
        }
    }


           /*
        Get single user data
    */
    public static function getUserData($user_id =''){
        if($user_id != ''){
            $user = User::findorfail($user_id);
            if($user){
                return $user;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }


      /*
        Get single user detail
    */
    public static function getUserDetail($user_id =''){
        if($user_id != ''){
            $user = User::findorfail($user_id);
            if($user){
                return $user;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }



      /**
     * function for check empty value
     * @param $value
     */
    public static function checkEmpty($value = NULL){
        if(isset($value) && !empty($value)){
            $data = trim(strip_tags($value));
            return iconv('ISO-8859-1','ASCII//IGNORE',$data);
        }
        else {
            return NULL;
        }
    }


        /**
     * function for Common Datetime picker formate
     * @param $value
     */
    public static function commonDateTimePickerFormate($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('m/d/Y H:i a', strtotime($value));
        }
        else {
            return NULL;
        }
    }


    /**
     * function for Common Date Formate
     * @param $value
     */
    public static function commonDateFormate($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('d F, Y', strtotime($value));
        }
        else {
            return NULL;
        }
    }


        /**
     * function for Common Date Formate
     * @param $value
     */
    public static function commonDateTimeFormate($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('d F, Y H:i a', strtotime($value));
        }
        else {
            return NULL;
        }
    }



      /**
     * function for check empty date
     * @param $value
     */
    public static function checkEmptydate($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('Y-m-d', strtotime($value));
        }
        else {
            return NULL;
        }
    }


         /**
     * function for check empty date
     * @param $value
     */
    public static function checkEmptydateMdY($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('d M Y', strtotime($value));
        }
        else {
            return NULL;
        }
    }

                /**
     * function for check empty date
     * @param $value
     */
    public static function checkEmptydateMdYHIS($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('d M Y h:i A', strtotime($value));
        }
        else {
            return "--";
        }
    }

    /**
     * function for check empty date
     * @param $value
     */
    public static function checkEmptydateTime($value = NULL){
        if(isset($value) && !empty($value) && ( $value!='0000-00-00' && $value!='0000-00-00 00:00:00'&& $value != '1970-01-01')){
            $value = trim($value);
            return date('Y-m-d H:i:s', strtotime($value));
        }
        else {
            return NULL;
        }
    }


      /**
     * function for check empty value For Explode(DECIMAL)
     * @param $value
     */
    public static function checkEmptyForExplod($value = NULL,$zeroString = 0,$firstString = 0){
        if(isset($value) && !empty($value)){
            $value = trim($value);
            $rowsplit = explode(".",$value);
            $rowsplit[0] = static::breakStringSize($rowsplit[0],0,$zeroString);
            if(isset($rowsplit[1])){
                $rowsplit[1] = static::breakStringSize($rowsplit[1],0,$firstString);
                $rowsplit[1] =  static::concateZero($rowsplit[1],$firstString);
            }else{
                $rowsplit[1] =  static::concateZero(0,$firstString);
            }

           return $value = $rowsplit[0].'.'.$rowsplit[1];
        }
        else {
            return NULL;
        }
    }

    /*
     * Method to strip tags globally.
     */

    public static function globalXssClean() {
        // Recursive cleaning for array [] inputs, not just strings.
        $sanitized = static::arrayStripTags(Request::all());
        Request::merge($sanitized);
    }

    /**
     * Method to strip tags
     *
     * @param $array
     * @return array
     */
    public static function arrayStripTags($array) {
        $result = array();

        foreach ($array as $key => $value) {
            // Don't allow tags on key either, maybe useful for dynamic forms.
            $key = strip_tags($key);

            // If the value is an array, we will just recurse back into the
            // function to keep stripping the tags out of the array,
            // otherwise we will set the stripped value.
            if (is_array($value)) {
                $result[$key] = static::arrayStripTags($value);
            } else {
                // I am using strip_tags(), you may use htmlentities(),
                // also I am doing trim() here, you may remove it, if you wish.
                $result[$key] = trim(strip_tags($value));
            }
        }

        return $result;
    }

    /**
     * Escape output
     *
     * @param $value
     * @return string
     */
    public static function sanitizeOutput($value) {
        return addslashes($value);
    }

    /*
     * Convert date
     */

    public static function convertDate($convertDate) {
        if ($convertDate != '') {
            $convertDate = str_replace('/', '-', $convertDate);
            return date('Y-m-d', strtotime($convertDate));
        }
    }

    /**
     * Send success ajax response
     *
     * @param string $message
     * @param array $result
     * @return array
     */
    public static function sendSuccessAjaxResponse($message = '', $result = []) {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $result
        ];

        return $response;
    }

    /**
     * Send failure ajax response
     *
     * @param string $message
     * @return array
     */
    public static function sendFailureAjaxResponse($message = '',$data=[]) {
        $message = $message == '' ? config('app.message.default_error') : $message;

        $response = [
            'status' => false,
            'message' => $message,
            'data' => $data
        ];

        return $response;
    }

    /**
     * function for send email
     */
    // public static function sendEmail($template, $data, $toEmail, $toName, $subject, $fromName = '', $fromEmail = '',$attachment = '') {
    //     //$new = ['data' => $data];
    //     \Mail::send($template, $data, function ($message) use($toEmail, $toName, $subject, $data, $fromName, $fromEmail, $attachment) {
    //         $message->to($toEmail, $toName);
    //         $message->subject($subject);

    //         if ($fromEmail != '' && $fromName != '') {
    //             $message->from($fromEmail, $fromName);
    //         }

    //         if($attachment != ''){
    //             $message->attach($attachment);
    //         }
    //     });
    // }
    
       public static function sendEmail($template, $data, $toEmail, $toName, $subject, $fromName = '', $fromEmail = '',$attachment = '') {
        if ($fromEmail == '') {
            $fromEmail ='info@loveoman.com';
        }
        try {
            $fromName = 'Bloggit';
            $data = \Mail::send($template, $data, function ($message) use($toEmail, $toName, $subject, $data, $fromName, $fromEmail, $attachment) {
                $message->to($toEmail, $toName);
                $message->subject($subject);
                if ($fromEmail != '' && $fromName != '') {
                    $message->from($fromEmail, $fromName);
                }
                if($attachment != ''){
                    $message->attach($attachment);
                }
            });
            return 1;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    /**
     * Generate password
     * @param int $length
     * @return string
     */
    public static function generatePassword($length = 12) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

    /**
     * Resize image
     * @param $fileToResize
     * @return mixed
     */
    public static function resizeImage($imageToResize) {
        $img = Image::make($imageToResize)->resize(1200, null)->encode('jpg', 80)->save();
        return $img->basename;
    }

    /**
     * Convert image to jpg
     * @param $imageToConvert
     * @param $convertedFile
     * @return string
     */
    public static function convertToJpg($imageToConvert, $convertedFile) {
        $img = Image::make($imageToConvert)->encode('jpg', 80)->save($convertedFile);
        unlink($imageToConvert);
        return $img->dirname . '/' . $img->basename;
    }

    /**
     * Get image width
     * @param $image
     * @return mixed
     */
    public static function getImageWidth($image) {
        return Image::make($image)->width();
    }

    /**
     * Get image height
     * @param $image
     * @return mixed
     */
    public static function getImageHeight($image) {
        return Image::make($image)->height();
    }

    /**
     * Create folder
     * @param $path
     * @return bool
     */
    public static function createFolder($path) {
        return \File::makeDirectory($path, 0777);
    }

    /**
     * Upload files other than images
     * @param $document
     * @param $dir
     * @return string
     */
    public static function uploadDocuments($document, $dir, $fileName = '') {
        $date = new DateTime();
        $currentTimeStamp = $date->getTimestamp();

        if ($fileName == '') {
            $documentOriginalName = $currentTimeStamp . '_' . $document->getFilename() . '.' . $document->getClientOriginalExtension();
        } else {
            $documentOriginalName = $fileName . '.' . $document->getClientOriginalExtension();

            //Remove file first if exist
            if (file_exists($dir . $documentOriginalName)) {
                unlink($dir . $documentOriginalName);
            }
        }

        //Store file to folder
        $document->move($dir, $documentOriginalName);
        return $documentOriginalName;
    }

    /**
     * Upload file
     * @param $file
     * @param $dir
     * @return mixed|string
     */
    public static function uploadFiles($file, $dir, $convert = true) {
        $date = new DateTime();
        $currentTimeStamp = $date->getTimestamp();
        $fileOriginalName = $currentTimeStamp . '_' . $file->getFilename() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $fileOriginalName);
        $finalDoc = $fileOriginalName;

        //Get file mime type
        $mimeType = $file->getClientMimeType();
        //Optimize if uploaded file is image
        if (self::checkImageMimes($mimeType)) {
            $imageToResize = $dir . $fileOriginalName;
            $imageName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $finalDoc = $fileOriginalName;

            //Convert png to jpg
            if ($mimeType == 'image/png' && $convert == true) {
                $convertedFile = $imageName . '.jpg';
                $convertedFilePath = $dir . $convertedFile;
                $imageToResize = self::convertToJpg($imageToResize, $convertedFilePath);
                $finalDoc = $convertedFile;
            }

            //Resize image if width is greater than 1200
            try {
                $imageWidth = self::getImageWidth($imageToResize);
                if ($imageWidth > 1200) {
                    $finalDoc = self::resizeImage($imageToResize);
                }
                return $finalDoc;
            } catch (Exception $e) {
                return $finalDoc;
            }
        }

        return $finalDoc;
    }

    /*
     * function for upload AWS S3
     */

    public static function uploadFilesAWS($file) {
        $imageFile = '';
        $imagePath = config('common.resource_paths.images');
        $thumbPath = config('common.resource_paths.thumb');

        if ($file) {
            $imageFile = self::uploadFiles($file, $imagePath, false);
            $mimeType = $file->getClientMimeType();
            if ($mimeType != 'image/png') {
                self::createImageThumbnail($imagePath, $imageFile, $thumbPath);
            } else {
                self::createThumbPng($imagePath, $imageFile, $thumbPath);
            }

            $s3 = \Storage::disk('s3');
            $s3->put($imageFile, file_get_contents($imagePath . $imageFile), 'public');
            $s3->put('thumb/' . $imageFile, file_get_contents(config('common.resource_paths.thumb') . $imageFile), 'public');
            $region = env('AWS_REGION');
            $s3folder = env('AWS_BUCKET');
            $S3path = "https://s3.$region.amazonaws.com/$s3folder/thumb/";

            $uploadedImagePath = $imagePath . $imageFile;
            $uploadedThumbPath = $thumbPath . $imageFile;

            if (\File::exists($uploadedImagePath)) {
                unlink($uploadedImagePath);
            }

            if (\File::exists($uploadedThumbPath)) {
                unlink($uploadedThumbPath);
            }

            return $S3path . $imageFile;
        }


        return $imageFile;
    }

    /*
     * create thumb for aws s3
     */

    public static function createThumb($fileName, $file) {
        $thumbDir = config('common.resource_paths.thumb');
        $file->move($thumbDir, $fileName);
        $thumbnailToResize = $thumbDir . $fileName;
        $imageWidth = self::getImageWidth($thumbnailToResize);
        //Get image height
        $imageHeight = self::getImageHeight($thumbnailToResize);
        $imageToCreateThumb = imagecreatetruecolor(150, 150);
        $thumbImage = imagecreatefromjpeg($thumbnailToResize);
        imagecopyresampled($imageToCreateThumb, $thumbImage, 0, 0, 0, 0, 150, 150, $imageWidth, $imageHeight);
        // Output
        imagejpeg($imageToCreateThumb, $thumbnailToResize, 100);
        return true;
    }

    public static function createImageThumbnail($existingImageDir, $existingImageFile, $thumbnailDir) {
        try {
            $thumbnailToResize = $thumbnailDir . $existingImageFile;
            //Copy original image to thumbnail folder
            File::copy($existingImageDir . $existingImageFile, $thumbnailToResize);
            //Get image width
            $imageWidth = self::getImageWidth($thumbnailToResize);
            //Get image height
            $imageHeight = self::getImageHeight($thumbnailToResize);

            $imageToCreateThumb = imagecreatetruecolor(150, 150);
            $thumbImage = imagecreatefromjpeg($thumbnailToResize);
            imagecopyresampled($imageToCreateThumb, $thumbImage, 0, 0, 0, 0, 150, 150, $imageWidth, $imageHeight);
            // Output
            imagejpeg($imageToCreateThumb, $thumbnailToResize, 100);

            return $existingImageFile;
        } catch (Exception $e) {
            $thumbnailToResize = $thumbnailDir . $existingImageFile;
            //Copy original image to thumbnail folder
            File::copy($existingImageDir . $existingImageFile, $thumbnailToResize);
            return $existingImageFile;
        }
    }

    /**
     * function for resize PNG File.
     * @param $existingImageDir
     * @param $existingImageFile
     * @param $thumbnailDir
     * @return mixed
     */
    public static function createThumbPng($existingImageDir, $existingImageFile, $thumbnailDir) {
        try {

            $thumbnailToResize = $thumbnailDir . $existingImageFile;
            //Copy original image to thumbnail folder
            File::copy($existingImageDir . $existingImageFile, $thumbnailToResize);
            $img = Image::make($thumbnailToResize);
            $img->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
            return $existingImageFile;
        } catch (Exception $e) {
            $thumbnailToResize = $thumbnailDir . $existingImageFile;
            //Copy original image to thumbnail folder
            File::copy($existingImageDir . $existingImageFile, $thumbnailToResize);
            return $existingImageFile;
        }
    }

    public static function createImageThumbnailSize($existingImageDir, $existingImageFile, $thumbnailDir, $width, $height) {
        $thumbnailToResize = $thumbnailDir . $existingImageFile;

        //Copy original image to thumbnail folder
        File::copy($existingImageDir . $existingImageFile, $thumbnailToResize);

        //Get image width
        $imageWidth = self::getImageWidth($thumbnailToResize);

        //Get image height
        $imageHeight = self::getImageHeight($thumbnailToResize);

        $imageToCreateThumb = imagecreatetruecolor($width, $height);
        $thumbImage = imagecreatefromjpeg($thumbnailToResize);
        imagecopyresampled($imageToCreateThumb, $thumbImage, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight);

        // Output
        imagejpeg($imageToCreateThumb, $thumbnailToResize, 100);

        return $existingImageFile;
    }

    /**
     * Check if given mime is available in allowed mimes list
     * @param $mime
     * @return bool
     */
    public static function checkImageMimes($mime) {
        $mimes = array('image/jpeg',
            'image/jpg',
            'image/bmp',
            'image/png'
        );

        if (in_array($mime, $mimes)) {
            return true;
        }
        return false;
    }

    /**
     * function for add http in url
     * @param $url
     * @return string
     */
    public static function addHttpToUrl($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            return $url = "http://" . $url;
        } else {
            return $url;
        }
    }

    /**
     * Get file extension
     * @param $fileName
     * @return mixed
     */
    public static function getFileExtension($fileName) {
        $fileExtension = explode('.', $fileName);
        return $fileExtension[count($fileExtension) - 1];
    }

    /**
     * function for get file type
     * @param $fileName
     * @return mixed
     */
    public static function getUploadedFileType($fileName) {
        $extension = self::getFileExtension($fileName);
        return self::getFileType($extension);
    }

    /**
     * Get file MIME type
     * @param $extension
     * @return bool
     */
    public static function getMIMEType($extension) {
        $mimeTypes = array('png' => 'image/png',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            'mp3' => 'audio/mpeg',
            'mp4' => 'video/mp4',
            'wav' => 'audio/wav',
            'mpv' => 'audio/mpeg',
            'mpg' => 'audio/mpeg'
        );

        if (array_key_exists($extension, $mimeTypes)) {
            return $mimeTypes[$extension];
        }
        return false;
    }

    /**
     * Get file type by extension
     * @param $extension
     */
    public static function getFileType($extension) {
        switch ($extension) {
            case 'doc':
                return 'word';
                break;

            case 'docx':
                return 'word';
                break;

            case 'xls':
                return 'excel';
                break;

            case 'xlsx':
                return 'excel';
                break;

            case 'ppt':
                return 'ppt';
                break;

            case 'pptx':
                return 'ppt';
                break;

            case 'pdf':
                return 'pdf';
                break;

            case 'txt':
                return 'text';
                break;

            case 'jpg':
                return 'image';
                break;

            case 'jpeg':
                return 'image';
                break;

            case 'png':
                return 'image';
                break;

            case 'bmp':
                return 'image';
                break;

            case 'gif':
                return 'image';
                break;

            case 'mp3':
                return 'audio';
                break;

            case 'wav':
                return 'audio';
                break;

            case 'mp4':
                return 'video';
                break;

            case 'flv':
                return 'video';
                break;

            case 'mpeg':
                return 'video';
                break;

            case '3gp':
                return 'video';
                break;

            case 'mkv':
                return 'video';
                break;

            case 'webm':
                return 'video';
                break;

            case 'avi':
                return 'video';
                break;

            case 'vob':
                return 'video';
                break;

            case 'ogg':
                return 'video';
                break;

            case 'ogv':
                return 'video';
                break;

            case 'mpv':
                return 'video';
                break;

            case 'mpg':
                return 'video';
                break;

            default:
                return 'text';
        }
    }

    /**
     * @param $date
     * Format date as ago
     */
    public static function formatDateAgo($date) {
        if ($date) {
            return Carbon::createFromTimestamp(strtotime($date))->diffForHumans();
        } else {
            return $date;
        }
    }

    /**
     * Format Date
     * @param $date
     * @return formatted date
     */
    public static function formatDate($date, $not_available = true) {
        if ($date) {
            return date(config('app.date_format_php'), strtotime($date));
        } else {
            if ($not_available == false) {
                return '';
            }
            return '';
        }
    }

    /**
     * Format Date
     * @param $date
     * @return formatted date
     */
    public static function formatDateTime($date, $not_available = true) {
        if ($date) {
            return date(config('app.date_time_format_php'), strtotime($date));
        } else {
            if ($not_available == false) {
                return NULL;
            }
            return NULL;
        }
    }

    /**
     * Show error page
     * @return \Illuminate\Http\Response
     */
    public static function showErrorPage() {
        return response()->view('errors.error', [], 500);
    }


    public static function convertFilterDate($keyword) {
        $date = '';
        try {
            if (\Carbon\Carbon::createFromFormat(config('app.date_format_php'), $keyword) !== false) {
                $date = self::convertDate($keyword);
            }
        } catch (Exception $e) {
            $date = '';
        }
        return $date;
    }

    /**
     * function for display amount
     * @param $amount
     * @return int|string
     */
    public static function currency($amount) {
        if($amount == ''){
            $amount = 0;
            $amount = config('app.currency').number_format($amount,2);
        } elseif ($amount < 0){
            $amount = -($amount);
            $amount = '-'.config('app.currency').number_format($amount,2);
        }else{
            $amount = config('app.currency').number_format($amount,2);
        }
        return $amount;
    }

    /**
     * function for remove .00 from amount
     * @param $price
     * @return bool|string
     */
    public static function formatDBAmount($price) {
        $price = substr($price, -3) == ".00" ? substr($price, 0, -3) : $price;
        return $price;
    }


    /**
     * function for delete directory
     * @param $dir
     * @return bool
     */
    public static function deleteDirectory($dir){
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '' || $item == '.gitignore') {
                continue;
            }

            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

     /**
     * Function to generate randomkey
     * @param NA
     * @return random key
     */
    public static function generateRandomKey() {
        $salt = substr(sha1(uniqid(mt_rand(), true)), 0, 4);
        return substr(sha1($salt) . $salt,5,15);
    }

    /**
     * function for generate new file name
     * @param NA
     * @return Generated new file name
    */
    public static function generateuDynamicFileName() {
        return substr(self::generateRandomKey(), 0,4) . '-' . substr(self::generateRandomKey(),0,4) . '-'. substr(self::generateRandomKey(),0,4).'-'. substr(self::generateRandomKey(),0,4);
    }

    public static function onlyTwoDecimal($foo){
        return number_format((float)$foo, 2, '.', '');
    }

    public static function getCodetype($val = NULL){
        if(isset($val) && !empty($val)){
            $val = trim($val);
            $conf  = config('constant.discountCodeType');
            foreach ($conf as $key => $value) {
               if($val == $value){
                    return $key;
               }
            }
        }
    }

    public static function showCodeTypeValInFormate($val = NULL,$amount = NULL){
        if(isset($val) && !empty($val)){
            $val = trim($val);
            if($val == 1){
                return $amount.' %';
            }
            if($val == 2){
                return  static::currency($amount);
            }
        }
    }



    public static function getExtendetimeLine($val = NULL){
        if(isset($val) && !empty($val)){
            $val = trim($val);
            $conf  = config('constant.extend_delivery');
            foreach ($conf as $key => $value) {
               if($val == $value){
                    return $key;
               }
            }
        }
    }


    /**
     * function for desciption popup
     * @param $str word count
     * @param $id saperator id
     * @return Generated new file name
     */

    public static function decriptionPopup($str,$id){
        if(str_word_count($str)>5){
            return implode(' ', array_slice(explode(' ', $str), 0, 5)).'..<a href="#" style="color:blue;" data-toggle="modal" data-target="#declaraion_heading_'.$id.'">Read more</a>';
            //return substr($str, 0,5).'..<a href="#" data-toggle="modal" data-target="#declaraion_heading_'.$id.'">Read more</a>';
        }else{
            if(strlen($str)>80){
                return substr($str, 0,80).'..<a href="#" style="color:blue;" data-toggle="modal" data-target="#declaraion_heading_'.$id.'">Read more</a>';
            }
            return $str;
        }
    }
    /**
     * function for send push notification
     * @param $id device token
     * @param $msg message tobe sent for push notification 
     * @param $title title 
     * @param $key key for API
     * @return Generated new file name
     */
    public static function sendNotification($id,$msg,$title,$key){  
        $url = "https://fcm.googleapis.com/fcm/send";
        $notification = array('title' =>$title , 'body' => $msg, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $id, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($ch);
        curl_close($ch); 
    }
}
