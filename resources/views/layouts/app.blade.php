<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ PUB_URL }}favicon.ico">
    
    @auth
    <!-- Access Token -->
    <meta name="token" content="{{ $token }}">
    @endauth

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="base_url" content="{{ ($_SERVER['HTTP_HOST'] === 'localhost') ? env('BASE_URL_DEV') : env('BASE_URL_PROD') }}">
    <meta name="vapid_public_key" content="{{ env('VAPID_PUBLIC_KEY') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="{{ PUB_URL }}css/app.css?v={{ rand() }}" rel="stylesheet"> -->
    <link href="{{ PUB_URL }}css/travel_blog.css?v={{ rand() }}" rel="stylesheet">
    <link href="{{ PUB_URL }}css/browser_detection.css?v={{ rand() }}" rel="stylesheet">
    @if(Route::currentRouteName() == '')
        <link rel="stylesheet" type="text/css" href="{{ PUB_URL }}css/ruslan_slider.css?v={{ rand() }}">
        <link rel="stylesheet" type="text/css" href="{{ PUB_URL }}css/my_sliders.css?v={{ rand() }}">
    @endif

    <link rel="manifest" href="{{ PUB_URL }}/manifest.json" />
    
    @routes
</head>
<body>

    <div class="container">        
        {{-- @include('parts/_browsers') --}}
        
        @include('parts/menu/_top_nav')

        @yield('content')
    </div>

    <!-- Scripts -->
    @if(Route::currentRouteName() == '')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script><!-- @todo Do better -->
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>      
        <script src="http://hammerjs.github.io/dist/hammer.min.js" type="text/javascript"></script>
        <script src="{{ PUB_URL }}js/ruslan_slider.js?v={{ rand() }}"></script>
        <script src="{{ PUB_URL }}js/my_sliders.js?v={{ rand() }}"></script>
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.js"></script>
    
    <script src="{{ PUB_URL }}js/app.js?v={{ rand() }}"></script>
    <!-- Laravel 5.8 dont have /assets anymore -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    
    <!-- <script src="{{ PUB_URL }}js/browser_detection.js?v={{ rand() }}"></script> -->
    
    <script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-messaging.js"></script>
    <script src="{{ PUB_URL }}js/firebase-config.js?v={{ rand() }}"></script>

    <script>
        const baseUrl = $("meta[name=base_url]").attr('content');
    </script>
    
    @auth
        <!-- <script src="{{ PUB_URL }}js/enable-push.js?v={{ rand() }}"></script> -->
        <script src="{{ PUB_URL }}js/enable-firebase-push.js?v={{ rand() }}"></script>
    @endauth

    <script src="{{ PUB_URL }}js/notification.js?v={{ rand() }}"></script>

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }

        //window.Laravel = <?php //echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>

        //window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(), ]) !!};
    </script>

</body>
</html>
