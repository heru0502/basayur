<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

@isset($meta)
  {{ $meta }}
@endisset

<!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap" rel="stylesheet">
{{--  <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">--}}
{{--  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">--}}
  <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
{{--  <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">--}}

{{--  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">--}}
{{--  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">--}}
{{--  <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">--}}
</head>
<body class="antialiased">

@inertia

<!-- General JS Scripts -->
<script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
{{--<script defer async src="{{ asset('stisla/js/modules/popper.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
{{--<script defer async src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>--}}
{{--<script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>--}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
<script defer src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
<script defer src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
<script defer src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
<script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
<script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>



<script src="{{ asset('stisla/js/stisla.js') }}"></script>
<script src="{{ asset('stisla/js/scripts.js') }}"></script>



<script src="{{ mix('js/app.js') }}" defer></script>


{{--<script src="/stisla/js/page/forms-advanced-forms.js"></script>--}}

</body>
</html>
