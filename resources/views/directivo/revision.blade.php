@extends('layouts.mainDocente')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{Crypt::encrypt($instanciaUnidad->idInstanciaPlaniAño )}}" class="current">Planificación</a>  <a href="contents?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" class="current">Unidad</a> <a href="#" class="current">Solicitar revisión</a>  </div>

  <h1>Solicitar revisión: {{$instanciaUnidad->NuevoNumero}}. {{$instanciaUnidad->NuevoNombre}}</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Solicitar revisión</h5>
        </div>
        <div class="widget-content nopadding">

          <form action="{{ route('directivo.solicitarRevision') }}" method="post" class="form-horizontal">
            @csrf

            <div class="control-group">
              <label class="control-label">Estado planificación :</label>
                <div class="controls">
                  <input type="checkbox" data-toggle="toggle" id="aceptada" name="aceptada">
                  <input type="hidden" name="estadoPlani" id="estadoPlani" value="">
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Observaciones :</label>
              <div class="controls">
                <input type="text" class="form-control" name = "correcciones" value= "" required="required" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Directivo :</label>
              <div class="controls">
                <input type="hidden" name="idDirectivo" value={{$directivo->id}}>
                <input type="hidden" name="anio" value={{$anio}}>
                <input type="hidden" name="idCorreccionAntigua" value={{$idCorreccionAntigua}}>
                <input type="hidden" name="correccionesJson" value={{$correccionesJson}}>
                <input type="text" class="form-control" name = "user" value="{{$directivo->name}}" disabled="disabled"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Usuario :</label>
              <div class="controls">
                <input type="hidden" name="idUser" value="{{$user->id}}">
                <input type="hidden" name="idInstanciaUnidad" value="{{$instanciaUnidad->id}}">
                <input type="hidden" name="estado" value="1">
                <input type="text" class="form-control" name = "user" value="{{$user->name}}" disabled="disabled"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Curso :</label>
              <div class="controls">
                <input type="hidden" name="curso" value="{{$curso}}">
                <input type="text" class="form-control" name ="curso" value="{{$curso}}" disabled="disabled"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Asignatura :</label>
              <div class="controls">
                <input type="hidden" name="asignatura" value="{{$asignatura}}">
                <input type="text" class="form-control" name = "asignatura" value="{{$asignatura}}" disabled="disabled"/>
              </div>
            </div>


            <div class="form-actions">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

</div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap-colorpicker.js') }}"></script> 
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script> 

<script src="{{ asset('js/bootstrap-toggle.js') }}"></script> 

<script src="{{ asset('js/bootstrap2-toggle.js') }}"></script> 
<script src="{{ asset('js/bootstrap2-toggle.min.js') }}"></script> 

<script src="{{ asset('js/masked.js') }}"></script> 
<script src="{{ asset('js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/select2.min.js') }}"></script> 
<script src="{{ asset('js/matrix.js') }}"></script> 
<script src="{{ asset('js/matrix.form_common.js') }}"></script> 
<script src="{{ asset('js/wysihtml5-0.3.0.js') }}"></script> 
<script src="{{ asset('js/jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap-wysihtml5.js') }}"></script> 
<script src="js/revision.js"></script>
<script>
  $('.textarea_editor').wysihtml5();
</script>


@endsection