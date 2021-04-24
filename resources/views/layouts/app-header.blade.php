<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <title>StickyMobile BootStrap</title>
  <link rel="stylesheet" type="text/css" href="theme/styles/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="theme/styles/style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="theme/fonts/css/fontawesome-all.min.css">
  <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
  <link rel="apple-touch-icon" sizes="180x180" href="theme/app/icons/icon-192x192.png">
  @livewireStyles
</head>

<body class="theme-light" data-highlight="highlight-orange" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">{{ $title }}</a>
    <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
  </div>

  {{ $slot }}

  <!-- End of Page Content-->

  <!-- Be sure this is on your main visiting page, for example, the index.html page-->
  <!-- Install Prompt for Android -->
  <div id="menu-install-pwa-android" class="menu menu-box-bottom menu-box-detached rounded-l">
    <div class="boxed-text-l mt-4 pb-3">
      <img class="rounded-l mb-3" src="theme/app/icons/icon-128x128.png" alt="img" width="90">
      <h4 class="mt-3">Add Sticky on your Home Screen</h4>
      <p>
        Install Sticky on your home screen, and access it just like a regular app. It really is that simple!
      </p>
      <a href="#" class="pwa-install btn btn-s rounded-s shadow-l text-uppercase font-900 bg-highlight mb-2">Add to Home Screen</a><br>
      <a href="#" class="pwa-dismiss close-menu color-gray-dark text-uppercase font-900 opacity-60 font-10 pt-2">Maybe later</a>
      <div class="clear"></div>
    </div>
  </div>

  <!-- Install instructions for iOS -->
  <div id="menu-install-pwa-ios"
       class="menu menu-box-bottom menu-box-detached rounded-l">
    <div class="boxed-text-xl mt-4 pb-3">
      <img class="rounded-l mb-3" src="theme/app/icons/icon-128x128.png" alt="img" width="90">
      <h4 class="mt-3">Add Sticky on your Home Screen</h4>
      <p class="mb-0 pb-0">
        Install Sticky, and access it like a regular app. Open your Safari menu and tap "Add to Home Screen".
      </p>
      <div class="clearfix pt-3"></div>
      <a href="#" class="pwa-dismiss close-menu color-highlight text-uppercase font-700">Maybe later</a>
    </div>
  </div>

</div>

<script type="text/javascript" src="theme/scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="theme/scripts/custom.js"></script>
@livewireScripts
</body>
