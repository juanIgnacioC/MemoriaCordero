@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{Crypt::encrypt($instanciaUnidad->idInstanciaPlaniAño )}}" class="current">Planificación</a>  <a href="contents?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" class="current">Unidad</a> <a href="#" class="current">Habilidades</a>  </div>
    <h1>Ingresa Habilidades</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Nueva Habilidad: {{$curso}} {{$asignatura}} {{$instanciaUnidad->NuevoNombre}}</h5>
          </div>
          <div class="widget-content nopadding">

            <form action="{{ route('planifications.createAbilities') }}" method="post" id="frmSubmit" class="form-horizontal">
            @csrf

            <input type="hidden" id="asignatura" name="asignatura" value="{{$asignatura}}">
            <input type="hidden" id="curso" name="curso" value="{{$curso}}">
            <input type="hidden" id="idInstanciaUnidad" name="idInstanciaUnidad" value="{{$instanciaUnidad->id}}">

            <input type="hidden" id="idHabilidadFK" name="idHabilidadFK" value="">
            <input type="hidden" id="Habilidadesjson" name="Habilidadesjson" value="">

          <div id= "listado">
            <div class="control-group">
              <label class="control-label">Nombre</label>
              <div class="controls">
                <select id="nombreAbility" name="nombreAbility">
                  @for ($i = 0; $i < count($habilidades); $i++)
                    <option value={{$habilidades[$i]->idHabilidadFK}}>{{$habilidades[$i]->nombre}}</option>
                  @endfor
                </select>
                <code id="last-ability"></code>
              </div>
            </div>
          </div>

            <button type="button" id="newAbility" class='btn btn-primary'>Nueva habilidad</button>

            <div class="form-actions">
              <input type="submit" value="Ingresar" onclick="jsonH()" class="btn btn-success">
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