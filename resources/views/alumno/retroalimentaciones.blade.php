@extends('layouts.mainDocente')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('alumno.index') }}" class="tip-bottom">Alumno</a> <a href="#" class="current">Retroalimentaciones</a> </div>
  <h1>Clases y retroalimentaciones</h1>
</div>


    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado">

        <?$i=0;foreach($dataClases as $unidad):?>
        <div class="widget-box collapsible">

          <div class="widget-title"> <a href="#collapse{{$unidad['unidad']['NuevoNumero']}}" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
            <h5>Unidad {{$unidad['unidad']['NuevoNumero']}}: {{$unidad['unidad']['NuevoNombre']}}</h5>
            </a>
          </div>

          <div class="collapse" id="collapse{{$unidad['unidad']['NuevoNumero']}}">
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Contenidos</th>
                    <th>Objetivo</th>
                    <th>Puntuación promedio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <vdiv class="row-fluid">
        <div class="span12">
                    <div>
                      <input type="hidden" id="unidad<?=$i?>" value="{{$unidad}}" readonly>
                    </div>

                    <?$j=0;foreach($unidad['clases'] as $row):?>
                    <tr class="trhideclass<?=$j?>">

                      <td>
                        <p><?=$row['clase']['start']?></p>
                      </td>

                      <td>
                        <p><?=$row['clase']['contenidos']?></p>
                      </td>

                      <td>
                        <p><?=$row['clase']['description']?></p>
                      </td>

                      <td>
                        <p><?=$row['avgPuntuacion']?></p>
                      </td>
                      
                      <td><button id="retroalimentar<?=$j?>" name="retroalimentar<?=$j?>" onclick="retroalimentaciones(<?=$i?>, <?=$j?>)" class="btn btn-info" >Retroalimentaciones</button></td>

                    </tr>
                    <?$j++;endforeach;?>

                  </div>
                </div>
                </tbody>
              </table>
            </div>
          </div>
          </div>
          <?$i++;endforeach;?>
    </div>

      <div id="myModal1" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Retroalimentaciones</h5>
          </div>
          <div class="modal-body">
            
          <input type="hidden" id="previous" value="">

            <input type="hidden" id="alumno">
            <input type="hidden" id="puntuacion">
            <input type="hidden" id="comentario">
            <input type="hidden" id="ComentariosJson" name="ComentariosJson" value="">

          <table class="table table-bordered data-table" id="tableModal" name="tableModal">
            <thead>
              <tr>
                <th>Alumno</th>
                <th>Puntuación</th>
                <th>Comentario(s)</th>
              </tr>
            </thead>

          </table>

          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
<script src="js/alumno.js"></script>
@endsection

<script type="text/javascript">

/*$("#planificar0").click(function (e) {
    e.preventDefault();
    var idInstanciaPlaniAño = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    console.log("post");
    console.log(token);
    var data={curso:curso,
        asignatura:asignatura,
        anio:anio,
        idInstanciaPlaniAño:idInstanciaPlaniAño,
        _token:token};
    $.ajax({
        type: "post",
        url: "{{route('forms.validation')}}",
        data: data,
        success: function (msg) {
                alert("Se ha realizado el POST con exito "+msg);
        }
    });
});*/

/*function planificar(indice){
    var idInstanciaPlaniAño = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();

    console.log(idInstanciaPlaniAño);

    $.post(
      {{ route('forms.validation') }},
      {
        curso:curso,
        asignatura:asignatura,
        anio:anio,
        idInstanciaPlaniAño:idInstanciaPlaniAño
      },function(){
        $("#listado").hide('slow');
        //cambiar cargar datos
        //cargarDatos();
        $("#listado").show('slow');
      }
    );

  }*/

</script>