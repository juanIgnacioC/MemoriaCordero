@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('admin.users') }}" class="tip-bottom">Administrador</a> <a href="#" class="current">Enlazar establecimiento</a> </div>
  <h1>Enlazar establecimiento y curso a: {{$user->name}}</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Establecimientos enlazados</h5>
        </div>
        <div class="widget-content nopadding">

          <div class="control-group">
            <div class="controls">
              <?for ($j = 0; $j < $instEstablecimientos->count(); $j++) {
                    ?>
                    <p><label ><?
                    echo $instEstablecimientos[$j]->nombre;
                    ?></label></p> <?
                  }
                  ?>
            </div>
          </div>

        </div>
      </div>


      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Enlazar establecimiento</h5>
        </div>
        <div class="widget-content nopadding">

          <form action="{{ route('admin.createInstanciaEstablecimientoAlumno') }}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="idAlumno" value={{$user->id}}>
            <input type="hidden" name="type" value=1>
            <input type="hidden" name="fecha" value={{$fecha}}>

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
              <label class="control-label">Índice</label>
              <div class="controls">
                <select class="form-control" name="indice">
                    <option value="A">"A"</option>
                    <option value="B">"B"</option>
                    <option value="C">"C"</option>
                    <option value="D">"D"</option>
                    <option value="E">"E"</option>
                    <option value="F">"F"</option>
                    <option value="G">"G"</option>
                    <option value="H">"H"</option>
                    <option value="I">"I"</option>
                    <option value="J">"J"</option>
                    <option value="K">"K"</option>
                    <option value="L">"L"</option>
                    <option value="M">"M"</option>
                    <option value="N">"N"</option>
                    <option value="Ñ">"Ñ"</option>
                    <option value="O">"O"</option>
                    <option value="P">"P"</option>
                    <option value="Q">"Q"</option>
                    <option value="R">"R"</option>
                    <option value="S">"S"</option>
                    <option value="T">"T"</option>
                    <option value="U">"U"</option>
                    <option value="V">"V"</option>
                    <option value="W">"W"</option>
                    <option value="X">"X"</option>
                    <option value="Y">"Y"</option>
                    <option value="Z">"Z"</option>
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