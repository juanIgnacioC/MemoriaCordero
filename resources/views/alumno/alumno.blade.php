@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Cursos</a> </div>
  <h1>Cursos a retroalimentar</h1>
</div>


    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Cursos</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nombre Curso</th>
                  <th>Nombre Asignatura</th>
                  <th>Año</th>
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
                    

                    <td><a href="clases?asignatura=<?=$row['nombreAsignatura']?>&idInstanciaPlaniAnio=<?=$row['id']?>" class="btn btn-success">Clases
                    </a></td>
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
<script src="js/planificar.js"></script>
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