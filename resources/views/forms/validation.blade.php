@extends('layouts.main')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Ingresa Unidades</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Nueva Unidad: {{$curso}} {{$asignatura}} {{$instanciaPlani->anio}} </h5>
          </div>
          <div class="widget-content nopadding">
            {{$instanciaPlani->id}}

            <form action="{{ route('forms.createPlaniUnidad') }}" method="post" class="form-horizontal">
            @csrf
              <input type="hidden" name="idInstanciaPlaniAño" value={{$instanciaPlani->id}}>
              <div class="control-group">
                <label class="control-label">Periodo</label>
                <div class="controls">
                  <input type="text" name="Periodo" id="Periodo">
                </div>
              </div>

              <div class="control-group">
              <label class="control-label">Nombre</label>
              <div class="controls">
                <select &nbsp; class="form-control" name="NuevoNombre" id="NuevoNombre">
                  @for ($i = 0; $i < count($unidades); $i++)
                    <option value="{'nombre':'&nbsp;{{$unidades[$i]->nombre}}','id':'{{$unidades[$i]->id}}'}">{{$unidades[$i]->id}}. {{$unidades[$i]->nombre}}</option>
                  @endfor
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Número Unidad</label>
              <div class="controls">
                <input type="text" name="NuevoNumero" id="NuevoNumero">
              </div>
            </div>

              <div class="control-group">
                <label class="control-label">Fecha inicio (dd-mm)</label>
                <div class="controls">
                  <input type="text" name="fechaInicio" data-date="02-03-2020" data-date-format="dd-mm-yyyy" value="02-03-2020" class="datepicker span11">
                  <span class="help-block">Fecha con formato  (dd-mm-yy)</span> </div>
              </div>

              <div class="control-group">
                <label class="control-label">Fecha termino (dd-mm)</label>
                <div class="controls">
                  <input type="text" name="fechaTermino" data-date="30-03-2020" data-date-format="dd-mm-yyyy" value="30-03-2020" class="datepicker span11">
                  <span class="help-block">Fecha con formato  (dd-mm-yy)</span> </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Ingresar" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/planificar.js') }}"></script> 
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