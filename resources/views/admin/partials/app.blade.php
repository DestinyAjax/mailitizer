<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('constants.COMPANY_NAME') }} | Dashboard</title>

    <!-- application default styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-v3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/sweetalert/sweetalert.css') }}" rel="stylesheet">

    @yield('custom_styles')
</head>
<body>
    @include('admin.partials.header')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials.nav')
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- @include('admin.partials.footer') -->
    
    <!-- application default script -->
    <script src="{{ asset('js/jquery.min.js') }}"></script> 
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script> 
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
   
    <script>
        tinymce.init({
            selector: '#editor1',
            height: 300,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount spellchecker imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
    <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
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