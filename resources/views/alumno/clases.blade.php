@extends('layouts.main')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('alumno.index') }}" class="tip-bottom">Cursos</a> <a href="#" class="tip-bottom">Clases</a> </div>
  <h1>Clases a retroalimentar</h1>
</div>


    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Clases</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Contenidos</th>
                    <th>Objetivo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?$i=0;foreach($instanciasPlaniAnio as $row):?>
                    <tr class="trhideclass<?=$i?>">

                      <td>
                        <input type="hidden" id="row<?=$i?>" value="{{$row}}" readonly>
                        <p><?=$row['start']?></p>
                      </td>

                      <td>
                        <p><?=$row['contenidos']?></p>
                      </td>

                      <td>
                        <p><?=$row['description']?></p>
                      </td>
                      
                      @if(is_null($row['idRetroalimentacion']))
                        <td><button id="retroalimentar<?=$i?>" name="retroalimentar<?=$i?>" onclick="retroalimentar(<?=$i?>)" class="btn btn-success" >Retroalimentar</button></td>
                      @else
                        <td><button id="ver<?=$i?>" name="ver<?=$i?>" onclick="ver(<?=$i?>)" class="btn btn-info" >Calificada</button></td>       
                      @endif

                    </tr>
                  <?$i++;endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="myModal1" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Retroalimentar clase</h5>
          </div>
          <div class="modal-body">
            
          <input type="hidden" id="previous" value="">
          <div class="form-group">
            @csrf
            <input type="hidden" id="idInstanciaClase">
            <input type="hidden" id="idInstanciaPlaniAnio">
            <input type="hidden" id="puntuacion">
            <input type="hidden" id="comentario">
            <input type="hidden" id="ComentariosJson" name="ComentariosJson" value="">
            <input type="hidden" id="asignatura" name="asignatura" value="{{$asignatura}}">

             <div class="control-group">
              <label class="control-label">Puntuación</label>
              <div class="controls">
                <label>
                  <input type="radio" name="radios" value="5" />
                  Muy bien</label>
                <label>
                  <input type="radio" name="radios" value="4" />
                  Bien</label>
                <label>
                  <input type="radio" name="radios" value="3" />
                  Regular</label>
                <label>
                  <input type="radio" name="radios" value="2" />
                  Deficiente</label>
                <label>
                  <input type="radio" name="radios" value="1" />
                  Muy deficiente</label>
              </div>
            </div>


            <div class="control-group" id="check5" name="check5" hidden="true">
              <label class="control-label">Comentario(s)</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="check5[]" value="Clase muy clara" />
                  Clase muy clara</label>
                <label>
                  <input type="checkbox" name="check5[]" value="Todos los contenidos de la clase pasados" />
                  Todos los contenidos de la clase pasados</label>
                  <label>
                  <input type="checkbox" name="check5[]" value="Clase didáctica" />
                  Clase didáctica</label>
                <label>
                  <input type="checkbox" name="check5[]" value="Ninguna duda" />
                  Ninguna duda</label>
              </div>
            </div>

            <div class="control-group" id="check4" name="check4" hidden="true">
              <label class="control-label">Comentario(s)</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="check4[]" value="Clase clara" />
                  Clase clara</label>
                <label>
                  <input type="checkbox" name="check4[]" value="Todos los contenidos de la clase pasados" />
                  Todos los contenidos de la clase pasados</label>
                <label>
                  <input type="checkbox" name="check4[]" value="Ninguna duda" />
                  Ninguna duda</label>
              </div>
            </div>

            <div class="control-group" id="check3" name="check3" hidden="true">
              <label class="control-label">Comentario(s)</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="check3[]" value="Clase monótona" />
                  Clase monótona</label>
                <label>
                  <input type="checkbox" name="check3[]" value="Faltaron pocos contenidos por ver" />
                  Faltaron pocos contenidos por ver</label>
                <label>
                  <input type="checkbox" name="check3[]" value="Me gustaria repasar estos contenidos" />
                  Me gustaria repasar estos contenidos</label>
              </div>
            </div>

            <div class="control-group" id="check2" name="check2" hidden="true">
              <label class="control-label">Comentario(s)</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="check2[]" value="Entendí poco de la clase" />
                  Entendí poco de la clase</label>
                <label>
                  <input type="checkbox" name="check2[]" value="Faltaron varios contenidos por ver" />
                  Faltaron varios contenidos por ver</label>
                <label>
                  <input type="checkbox" name="check2[]" value="Me quedaron algunas dudas" />
                  Me quedaron algunas dudas</label>
              </div>
            </div>

            <div class="control-group" id="check1" name="check1" hidden="true">
              <label class="control-label">Comentario(s)</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="check1[]" value="No entendí nada de la clase" />
                  No entendí nada de la clase</label>
                <label>
                  <input type="checkbox" name="check1[]" value="Me costó mucho la clase" />
                  Me costó mucho la clase</label>
                <label>
                  <input type="checkbox" name="check1[]" value="Me quedaron muchas dudas" />
                  Me quedaron muchas dudas</label>
                  <input type="checkbox" name="check1[]" value="No se pasaron los contenidos" />
                  No se pasaron los contenidos</label>
              </div>
            </div>



          </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" onclick="guardarRetroalimentacion()">Guardar</button>
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