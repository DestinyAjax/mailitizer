<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>247ureport | Dashboard</title>

    <!-- application default styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-v3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" class="skin-color" />
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style>
        body {
            background-image: url({{ asset('images/unnamed.jpg' )}});
        }
    </style>

    @yield('custom_styles')
</head>
<body>
    @include('admin.partials.header')
    @yield('content')
    @include('admin.partials.footer')
    
    <!-- application default script -->
    <script src="{{ asset('js/jquery.min.js') }}"></script> 
    <script src="{{ asset('js/jquery.ui.custom.js') }}"></script> 
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

    <script src="{{ asset('js/notify.min.js') }}"></script>
    @if(\Session::has('error'))
        <!-- notification script -->
        <script type="text/javascript">
            $.notify('{!! \Session::get('error') !!}', "error");
        </script>
    @endif
    @if(\Session::has('success'))
        <!-- notification script -->
        <script type="text/javascript">
            $.notify('{!! \Session::get('success') !!}', "success");
        </script>
    @endif
    @if(\Session::has('info'))
        <!-- notification script -->
        <script type="text/javascript">
            $.notify('{!! \Session::get('info') !!}', "info");
        </script>
    @endif
    @if(\Session::has('warning'))
        <!-- notification script -->
        <script type="text/javascript">
            $.notify('{!! \Session::get('warning') !!}', "warning");
        </script>
    @endif

    <!-- custom script -->
    @yield('custom_script')
</body>
</html>