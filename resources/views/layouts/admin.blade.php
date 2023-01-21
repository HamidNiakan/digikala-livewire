<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/panel/admin')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('asset/panel/admin')}}/css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="{{asset('asset/panel/admin')}}/css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="{{asset('asset/panel/admin')}}/css/font.css">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
    @yield('styles')
    <script src="{{mix('js/app.js')}}"></script>
    @livewireStyles
</head>
<body>
<livewire:panel.admin.dashboard.side-bar/>
<div class="content">
    <livewire:panel.admin.dashboard.header/>
    <livewire:panel.admin.dashboard.breadcrumb/>
    {{$slot}}
</div>
</body>
<script src="{{asset('asset/panel/admin')}}/js/jquery-3.4.1.min.js"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('asset/panel/admin')}}/js/js.js"></script>
<script src="{{asset('vendor/fontawesome/js/all.min.js')}}"></script>
@livewireScripts
<script src="{{asset('vendor/livewire/livewire-turbolinks.js')}}" data-turbolinks-eval="false" data-turbo-eval="false"></script>
@stack('scripts')
</html>