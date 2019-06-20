<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>@yield('titulo') - Inventario</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <style>
      .modal-header{cursor:move;}.close{background-color:rgb(193, 77, 78)!important;}
    </style>
  </head>
  <body>
    @yield('contenedor')

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.modal').draggable({
      handle: ".modal-header"
    });
    </script>
  </body>
</html>
