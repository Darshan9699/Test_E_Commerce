<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/style.css" type="text/css">

    @yield('exctra-css')
</head>

<body>
    <!-- Page Preloder -->
        @include('navbar')
    <!-- Header Section End -->
     {{-- Main section beging  --}}
        @yield('content')
<!-- Footer Section Begin -->
    @include('footer')     
<!-- Search End -->


    @include('scripts')
    @yield('extra-js')
</body>

</html>