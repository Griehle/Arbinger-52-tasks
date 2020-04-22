<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/myStyles.css') }}">

</head>


<body style="background-color: #dfdcdc61;">


<div class="container">
    @yield('content')
</div>

{{--<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>--}}
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.common.min.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="{{ URL::to('js/myApp.js') }}"></script>

</body>
</html>