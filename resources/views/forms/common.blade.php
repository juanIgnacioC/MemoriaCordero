@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="#" class="current">Crear Planificación</a> </div>
  <h1>Crear una nueva Planificación</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Crear Planificación</h5>
        </div>
        <div class="widget-content nopadding">

          <form action="{{ route('forms.createPlaniAnio') }}" method="post" class="form-horizontal">
            @csrf

            <div class="control-group">
              <label class="control-label">Establecimiento</label>
              <div class="controls">
                <select class="form-control" name="establecimiento">
                  @foreach($establecimientos as $establecimiento)
                    <option value={{$establecimiento->id}}>{{$establecimiento->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Año :</label>
              <div class="controls">
                <input type="text" class="form-control" name = "anio" placeholder="Inserte año" value= "2020"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Curso</label>
              <div class="controls">
                <select class="form-control" name="curso">
                  @foreach($cursos as $curso)
                    <option value={{$curso->id}}>{{$curso->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Asignatura</label>
              <div class="controls">
                <select class="form-control" name="asignatura">
                  @foreach($asignaturas as $asignatura)
                    <option value={{$asignatura->id}}>{{$asignatura->nombre}}</option>
                  @endforeach
                </select>
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
<script src="{{ asset('js/jquery.toggle.buttons.js') }}"></script> 
<script src="{{ asset('js/masked.js') }}"></script> 
<script src="{{ asset('js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/select2.min.js') }}"></script> 
<script src="{{ asset('js/matrix.js') }}"></script> 
<script src="{{ asset('js/matrix.form_common.js') }}"></script> 
<script src="{{ asset('js/wysihtml5-0.3.0.js') }}"></script> 
<script src="{{ asset('js/jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap-wysihtml5.js') }}"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>
@endsection