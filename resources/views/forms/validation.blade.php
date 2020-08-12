@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{$instanciaPlani->id}}" class="current">Planificación</a> <a href="#" class="current">Agregar Unidad</a>  </div>
    <h1>Ingresa Unidades</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-book"></i> </span>
            <h5>Nueva Unidad: {{$curso}} {{$asignatura}} {{$instanciaPlani->anio}} </h5>
          </div>
          <div class="widget-content nopadding">

            <form action="{{ route('forms.createPlaniUnidad') }}" method="post" class="form-horizontal">
            @csrf
              <input type="hidden" name="idInstanciaPlaniAño" value={{$instanciaPlani->id}}>

              <input type="hidden" id="idUnidadFK" name="idUnidadFK" value="">
              <input type="hidden" id="habilidadesJson" name="habilidadesJson" value="">

              <input type="hidden" id="asignatura" name="asignatura" value="&nbsp;{{$asignatura}}">
              <input type="hidden" id="curso" name="curso" value="&nbsp;{{$curso}}">

              <div class="control-group">
              <label class="control-label">Periodo {{$isSemestral}}</label>
              <div class="controls">
                <select id="Periodo" name="Periodo">
                  @isset($isSemestral)
                    @if($isSemestral == "Semestre")
                      <option value='1'>Semestre 1</option>
                      <option value='2'>Semestre 2</option>

                    @elseif(($isSemestral == "Trimestre"))
                      <option value='1'>Trimestre 1</option>
                      <option value='2'>Trimestre 2</option>
                      <option value='3'>Trimestre 3</option>
                    @endif
                  @endisset
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
              <label class="control-label">Nombre</label>
              <div class="controls">
                <select id="NuevoNombre" name="NuevoNombre">
                  @for ($i = 0; $i < count($unidades); $i++)
                    <option value={{$unidades[$i]->id}}>{{$unidades[$i]->nombre}}</option>
                  @endfor
                </select>
                <code id="last-selectedEx(agregar usab. N°?)"></code>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Objetivo General</label>
              <div class="controls">
                <select id="objetivoGeneral" name="objetivoGeneral">
                  @for ($i = 0; $i < count($unidades); $i++)
                    <option value={{$unidades[$i]->id}}>{{$unidades[$i]->objetivoGeneral}}</option>
                  @endfor
                </select>
                <code id="last-selected2"></code>
              </div>
            </div>

              <div class="control-group">
                <label class="control-label">Fecha inicio (dd-mm)</label>
                <div class="controls">
                  <input type="text" name="fechaInicio" data-date="02-03-2020" data-date-format="dd-mm-yyyy" value="02-03-2020" class="datepicker span11">
                  <span class="help-block">Fecha con formato  (dd-mm-yy)</span> </div>
              </div>

              <div class="control-group">
                <label class="control-label">Fecha término (dd-mm)</label>
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

<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

<script src="{{ asset('js/planificar.js') }}"></script> 
<script src="js/jquery.min.js"></script> 

<script src="{{ asset('js/jquery-editable-select.js') }}"></script> 
<script src="{{ asset('js/jquery-editable-select.min.js') }}"></script>

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