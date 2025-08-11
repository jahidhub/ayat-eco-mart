<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ayat Eco Mart')</title>

    <x-auth.auth-head-css></x-auth.auth-head-css>


    @yield('customCss')
</head>

<body class="bg-login">

    @yield('content')

    <x-auth.auth-footer-js></x-auth.auth-footer-js>

    @yield('customJs')
    @include('alert-message.alert')
</body>

</html>
