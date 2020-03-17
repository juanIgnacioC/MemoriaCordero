@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Form elements</a> <a href="#" class="current">Planificaciones</a> </div>
  <h1>Planificaciones</h1>
</div>

  <div class="container-fluid">
    <hr>

    <form action="{{ route('forms.planificationsFilter') }}" method="get" class="form-horizontal">

    @csrf

    <div class="control-group">
      <label class="control-label">Establecimiento</label>
      <div class="controls">
        <select class="form-control" id="establecimientoFilter" name="establecimientoFilter">

          @foreach($establecimientos as $establecimiento)

            @if(isset($establecimientoFilter))
              @if($establecimiento->id == $establecimientoFilter)
                <option value={{$establecimiento->id}} selected>{{$establecimiento->nombre}}</option>
              @else
                <option value={{$establecimiento->id}}>{{$establecimiento->nombre}}</option>
              @endif

            @else
              <option value={{$establecimiento->id}}>{{$establecimiento->nombre}}</option>
            @endif 

          @endforeach
        </select>
      </div>
    </div>


    <div class="control-group" style="margin-top:2px;">
      <label class="control-label">Año</label>
      <div class="controls">
        <select class="form-control" id='anioFilter' name="anioFilter">
          @foreach($anios as $anio)

            @if(isset($anioFilter))
              @if($anio->anio == $anioFilter)
                <option value={{$anio->anio}} selected>{{$anio->anio}}</option>
              @else
                <option value={{$anio->anio}}>{{$anio->anio}}</option>
              @endif

            @else
              <option value={{$anio->anio}}>{{$anio->anio}}</option>
            @endif 
            
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>

  </form>

  </div>
    
    <hr>

    <a href="{{ route('forms.common') }}" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Agregar Planificación
    </a>

    <div id="listado">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Planificaciones</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nombre Curso</th>
                  <th>Nombre Asignatura</th>
                  <th>Año</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?$i=0;foreach($instanciasPlaniAño as $row):?>
                  <tr class="trhideclass<?=$i?>">
                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="nombreCurso<?=$i?>" value="<?=$row['nombreCurso']?>" readonly>
                      <input type="hidden" id="row<?=$i?>" value="<?=$row?>" readonly>
                      <p><?=$row['nombreCurso']?></p>
                    </td>

                    <td><input type="hidden" id="nombreAsignatura<?=$i?>" value="<?=$row['nombreAsignatura']?>" readonly>
                      <p><?=$row['nombreAsignatura']?></p>
                    </td>

                    <td><input type="hidden" id="anio<?=$i?>" value="<?=$row['anio']?>" readonly>
                      <p><?=$row['anio']?></p>
                    </td>
                    

                    <td><a href="{{ route('forms.createPlaniAnio') ,['instanciaPlani'=> $row<?=$i?>]) }}" class="btn btn-primary">Planificar
                    </a></td>
                    <td><button class="btn btn-danger" onclick="planificar(<?=$i?>)">Eliminar</button></td>
                  </tr>
                <?$i++;endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
@endsection

<script type="text/javascript">

function planificar(indice){
    var idPlani = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();

    console.log(instanciaPlani);

    $.post(
      {{ route('forms.createPlaniUnidad') }},
      {
        curso:curso,
        asignatura:asignatura,
        anio:anio,
        idPlani:idPlani
      },function(){
        $("#listado").hide('slow');
        //cambiar cargar datos
        //cargarDatos();
        $("#listado").show('slow');
      }
    );

  }

</script>