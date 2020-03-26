@extends('layouts.main')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sample pages</a> <a href="#" class="current">Error</a> </div>
    <h1>Error Privilegio</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Error 500</h5>
          </div>
          <div class="widget-content">
            <div class="error_ex">
              <h1>500</h1>
              <h3>Usted no tiene el permiso para esta operación</p>
              <a class="btn btn-warning btn-big"  href="{{ route('home') }}">Inicio</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/matrix.js"></script>
@endsection