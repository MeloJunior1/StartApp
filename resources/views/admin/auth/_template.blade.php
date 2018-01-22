<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CORE | AUTH</title>

    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/css/style.css') }}" />

</head>
<body class="blank">
    <div class="color-line"></div>  
    
    @yield('auth-content')   
    
    <script src="{{ asset('/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/iCheck/icheck.min.js') }}"></script>
    <script>
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    </script>
</body>
</html>