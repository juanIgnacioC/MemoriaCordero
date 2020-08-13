@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{Crypt::encrypt($instanciaUnidad->idInstanciaPlaniAño )}}" class="current">Planificación</a>  <a href="contents?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" class="current">Unidad</a> <a href="#" class="current">Objetivo</a>  </div>
    <h1>Ingresa Objetivo</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-book"></i> </span>
            <h5>Nuevo Objetivo: {{$curso}} {{$asignatura}} {{$instanciaUnidad->NuevoNombre}}</h5>
          </div>
          <div class="widget-content nopadding">

            <form action="{{ route('planifications.createObjectives') }}" method="post" id="frmSubmit" class="form-horizontal">
            @csrf

            <input type="hidden" id="asignatura" name="asignatura" value="{{$asignatura}}">
            <input type="hidden" id="curso" name="curso" value="{{$curso}}">
            <input type="hidden" id="idInstanciaUnidad" name="idInstanciaUnidad" value="{{$instanciaUnidad->id}}">

            <input type="hidden" id="idUnidadObjetivo" name="idUnidadObjetivo" value="">
            <input type="hidden" id="idObj" name="idObj" value="">

            <input type="hidden" id="Conocimientosjson" name="Conocimientosjson" value="">
            <input type="hidden" id="Indicadoresjson" name="Indicadoresjson" value="">

          <div id= "listado">

            <div class="control-group">
              <label class="control-label">Objetivo Aprendizaje</label>
              <div class="controls">
                <select id="nombreObjetivo" name="nombreObjetivo">
                  @for ($i = 0; $i < count($objetivos); $i++)
                    @if($objetivos[$i]->prioridad == "1")
                        <option style="background: #5cb85c; color: #fff;" value='<?=$i?>'>{{$objetivos[$i]->nombre}}</option>
                    @elseif($objetivos[$i]->prioridad == "2")
                      <option style="background: #d1d119; color: #fff;" value='<?=$i?>'>{{$objetivos[$i]->nombre}}</option>
                    @else
                      <option value='<?=$i?>'>{{$objetivos[$i]->nombre}}</option>
                    @endif

                  @endfor
                </select>
                @for ($i = 0; $i < count($objetivos); $i++)
                    <input type="hidden" id="id<?=$i?>" name="id<?=$i?>" value={{$objetivos[$i]->id}}>
                    <input type="hidden" id="idObj<?=$i?>" name="idObj<?=$i?>" value='{{$objetivos[$i]->idObj}}'>
                  @endfor
                <code id="last-objective"></code>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Sub eje</label>
              <div class="controls">
                <select id="subEje" name="subEje">
                  @for ($i = 0; $i < count($objetivos); $i++)
                    <option value={{$subEjes[$i]->id}}>{{$subEjes[$i]->nombre}}</option>
                  @endfor
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Actividades</label>
              <div class="controls">
                <input type="text" id="actividades" name="actividades" required="required">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Evaluación</label>
              <div class="controls">
                <select id="evaluacion" name="evaluacion">
                    <option value=Formativa>Formativa</option>
                    <option value=Sumativa>Sumativa</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Conocimiento Previo</label>
              <div class="controls">
                <select id="nombreConocimiento" name="nombreConocimiento">
                  @isset($conocimientos)
                  @for ($i = 0; $i < count($conocimientos); $i++)
                    <option value={{$conocimientos[$i]->id}}>{{$conocimientos[$i]->nombre}}</option>
                  @endfor
                  @endisset
                </select>
                <code id="last-conocimiento"></code>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Indicador evaluación</label>
              <div class="controls">
                <select id="indicador" name="indicador">
                  @isset($indicadores)
                  @for ($i = 0; $i < count($indicadores); $i++)
                    @for($j = 0; $j < count($indicadores[$i]); $j++)
                      <option value={{$indicadores[$i][$j]->id}}>{{$indicadores[$i][$j]->nombre}}</option>
                    @endfor
                  @endfor
                  @endisset
                </select>
                <code id="last-indicador"></code>
              </div>
            </div>

          </div>

          <button type="button" id="newConocimiento" class='btn btn-primary'>Nuevo conocimiento</button>     
          <button type="button" id="newIndicador" class='btn btn-primary'>Nuevo Indicador</button>        

            <div class="form-actions">
              <input type="submit" value="Ingresar" onclick="jsonO()" class="btn btn-success">
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