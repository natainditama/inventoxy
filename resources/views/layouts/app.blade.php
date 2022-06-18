<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.5/dist/flowbite.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.16/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('styles')
  <title>Inventoxy - Modern inventory project</title>
</head>

<body class="antialiased min-h-screen flex flex-col justify-between">
  @include('components.header')
  <main class="container mx-auto px-4 pt-24">
    @yield('content')
    @include('components.modal')
  </main>
  @include('components.footer')
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.16/dist/sweetalert2.min.js"></script>
  @foreach(['error', 'success', 'info', 'warning'] as $message)
  @if(Session::has($message))
  <script>
    Swal.fire({
      title: '{{ Session::get($message) }}',
      icon: '{{ $message }}',
      confirmButtonText: 'OK'
    });
  </script>
  @endif
  @endforeach
  <script>
    $(function() {
      $(document).on('click', '.modal-box', function(event) {
        if ($(event.target).hasClass('modal-box')) $(this).removeClass('show');
      });
      $('#mobile-button').click(function() {
        $('#mobile-menu').slideToggle(100);
      });
      $('form[action="#"]').submit((event) => event.preventDefault())
    });
  </script>
  @yield('scripts')
</body>

</html>