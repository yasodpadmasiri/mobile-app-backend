@extends('../layout/base')

@section('body')
    <body class="app">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
        <script src="{{ asset('dist/js/tagsinput.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}"></script>
        <script type="text/javascript" src="{{ url('plugin/toastr/toastr.min.js')}}"></script>

        <script src="{{ url('plugin/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        @yield('script')
    </body>
@endsection