<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gebeya</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="{{asset('node_modules/css/addons/datatables2.min.css')}}" rel="stylesheet">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{asset('node_modules/css/addons/datatables2.min.css')}}" rel="stylesheet">

</head>

<body class="container-fluid">
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')
</body>
<!-- MDB -->
<script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<!-- Datatable Scripts -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('node_modules/js/addons/datatables2.min.js')}}"></script>

</html>
