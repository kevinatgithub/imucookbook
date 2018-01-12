<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{Config::get('ref.TITLE')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    {{HTML::style('css/slate/bootstrap.min.css')}}
    {{HTML::style('bower_components/datatables/media/css/jquery.dataTables.min.css')}}
    {{HTML::style('bower_components/datatables/media/css/dataTables.bootstrap.min.css')}}
    {{HTML::style('bower_components/jquery-ui/themes/humanity/jquery-ui.min.css')}}
    {{HTML::style('css/custom.min.css')}}
  </head>
  <body>
    @include('layout.nav')

    <br/>
    <div class="container">
      <div class="content">
        @yield('content')
        
        @include('layout.footer')
        
      </div>
    </div>

    {{HTML::script('bower_components/jquery/dist/jquery.min.js')}}
    {{HTML::script('vendor/popper//popper.min.js')}}
    {{HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js')}}
    {{HTML::script('bower_components/datatables/media/js/jquery.dataTables.min.js')}}
    {{HTML::script('bower_components/datatables/media/js/dataTables.bootstrap.min.js')}}
    {{HTML::script('bower_components/jquery-ui/jquery-ui.min.js')}}
    {{HTML::script('bower_components/vue/dist/vue.js')}}
    {{HTML::script('bower_components/lodash/dist/lodash.js')}}
    <!-- {{HTML::script('js/custom.min.js')}} -->

    @yield('scripts')
  </body>
</html>
