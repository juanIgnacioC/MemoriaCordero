<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/colorpicker.css') }}" />
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/select2.css') }}" />

<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />

<!--3
<link rel="stylesheet" href="{{ asset('css/fullcalendar4.css') }}" />

<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
<link href='fullcalendar-4.4.2/packages/core/main.css' rel='stylesheet' />
<link href='fullcalendar-4.4.2/packages/bootstrap/main.css' rel='stylesheet' />
<link href='fullcalendar-4.4.2/packages/timegrid/main.css' rel='stylesheet' />
<link href='fullcalendar-4.4.2/packages/daygrid/main.css' rel='stylesheet' />
<link href='fullcalendar-4.4.2/packages/list/main.css' rel='stylesheet' />
-->

<!--2<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.min.css') }}" />-->


<link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-wysihtml5.css') }}" />
<link href="{{ asset('font-awesome/css/font-awesome.css" rel="stylesheet') }}" />
<link rel="stylesheet" href="{{ asset('css/jquery.gritter.css') }}" />

<link rel="stylesheet" href="css/jquery-editable-select.css" />
<link rel="stylesheet" href="css/jquery-editable-select.min.css" />

<link rel="stylesheet" href="css/bootstrap-toggle.css" />
<link rel="stylesheet" href="css/bootstrap-toggle.min.css" />
<link rel="stylesheet" href="css/bootstrap2-toggle.css" />
<link rel="stylesheet" href="css/bootstrap2-toggle.min.css" />


<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="css/bootstrap-wysihtml5.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
@include('layouts.header')
@include('layouts.sidebar')
@yield('content')
@include('layouts.footer')
</body>
</html>
