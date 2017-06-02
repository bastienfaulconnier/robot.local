<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

    <style>
      .nav-wrapper, .page-footer {
        background-color: #64dd17;
      }
      .container.flash {
          background-color: #ccff90;
          border: 2px #33691e solid;
      }
    </style>

    <div class="container">
    @include('partials.flash')
    @include('partials.navadmin')
      @yield('content')
      @include('partials.footer')
    </div>
  </body>
  @section('scripts')
  <script>
    $(".button-collapse").sideNav();
    $('#textarea1').val('New Text');
    $('#textarea1').trigger('autoresize');
    $('select').material_select();
  </script>
  @show
</html>