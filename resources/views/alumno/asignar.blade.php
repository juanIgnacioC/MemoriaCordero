@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('alumno.index') }}" class="tip-bottom">Alumno</a> <a href="#" class="current">Enlazar curso</a> </div>

  <h1>Asignar alumnos al curso: {{$curso}} {{$instanciaPlani->indice}} </h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Alumnos asignados</h5>
        </div>
        <div class="widget-content nopadding">

          <div class="control-group">
            <div class="controls">
              @isset($instAlumnos)
              <?for ($j = 0; $j < $instAlumnos->count(); $j++) {
                    ?>
                    <p><label ><?
                    echo $instAlumnos[$j]->nombre;
                    ?></label></p> <?
                  }
                  ?>
              @endisset
            </div>
          </div>

        </div>
      </div>


      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Asignar alumnos</h5>
        </div>
        <div class="widget-content nopadding">

          <form action="{{ route('alumno.createAsignacionAlumnoCurso') }}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="type" value=1>

            <div class="control-group">
              <label class="control-label">Alumno</label>
              <div class="controls">
                <select class="form-control" name="establecimiento">
                  @foreach($alumnos as $alumno)
                    <option value={{$alumno->id}}>{{$alumno->name}}</option>
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