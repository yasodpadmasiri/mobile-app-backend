<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme }}">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script>
        var base_url = "<?php echo url(''); ?>";
    </script>
    <link rel="stylesheet" href="{{ asset('plugin/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css">
    @yield('head')
    <style>
    </style>
    
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    <link href="{{ asset('plugin/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>
@yield('body')

<script type="text/javascript">
    <?php
    if(Session::has('success')){ ?>
        toastr.success("<?php echo Session::get('success'); ?>");
    <?php }else if(Session::has('failure')){  ?>
        toastr.error("<?php echo Session::get('failure'); ?>");
    <?php } ?>


    function searchClick() {
        $('#search').click();
    }

</script>

</html>