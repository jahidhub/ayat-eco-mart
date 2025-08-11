<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <x-admin.admin-head-css></x-admin.admin-head-css>
    @yield('customCss')
    <title>Ayat Eco Mart</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <x-admin.admin-sidebar></x-admin.admin-sidebar>



        <!--end sidebar wrapper -->
        <!--start header -->
        <x-admin.admin-header></x-admin.admin-header>
        <!--end header -->

        @yield('content')

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <footer class="page-footer">
            <p class="mb-0">Copyright Ayat Eco Mart © 2025. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <x-admin.admin-switcher-wrapper></x-admin.admin-switcher-wrapper>
    <!--end switcher-->

    <!-- Bootstrap JS -->
    <x-admin.admin-footer-js></x-admin.admin-footer-js>
    @yield('customJs')
</body>

</html>
