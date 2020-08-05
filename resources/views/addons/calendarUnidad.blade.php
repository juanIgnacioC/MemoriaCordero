@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{$instanciaUnidad->idInstanciaPlaniAño}}" class="current">Planificación</a>  <a href="contents?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" class="current">Unidad</a> <a href="#" class="current">Calendario</a> </div>
    <h1>Calendario {{$curso}} {{$asignatura}}</h1>
  </div>

  <div class="container-fluid">
    <hr>
  <a href="#" title="Indicador planificación de clases" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Indicador que corresponde a la planificación mínima de clases. Cada una de estas debe tener un contenido asociado" onclick="modalClases()">Clases:</a>

  @php $rating = $indicadorClases[0]; @endphp  
  @foreach(range(1,5) as $i)
    <span class="fa-stack" style="width:1em">
      @if($rating >0)
        @if($rating >0.5)
          <i class="icon-star"></i>
        @else
          <i class="icon-star-half"></i>
        @endif
      @else
        <i class="icon-star-empty"></i>
      @endif
      @php $rating--; @endphp
    </span>
  @endforeach
  ({{$indicadorClases[0]}})

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box widget-calendar">
          <div class="widget-title"> <span class="icon"><i class="icon-calendar"></i></span>
            <h5>Calendar</h5>
            <div class="buttons"> <a id="add-event" href="objectives?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Agregar Objetivo</a>

              <div class="modal hide" id="modal-add-event">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h3>Agregar nuevo Objetivo</h3>
                </div>

                <div class="modal-body">
                  <p>Ingrese nombre objetivo:</p>
                  <p>
                    <input id="event-name" type="text" />
                  </p>
                </div>
                <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Cancel</a> <a href="#" id="add-event-submit" class="btn btn-primary">Add event</a> </div>

              </div>
            </div>
          </div>
          <div id="wrap" class="widget-content">

            <div id="external-events">
                <h5>Arrastre objetivos al calendario</h5>

              <div class="panel-content">
                @isset($dataPlaniUnidad)
                <?$i=0;foreach($dataPlaniUnidad as $row):?>
                  <div id="objective<?=$i?>" class="external-event ui-draggable label label-inverse"><?=$row['nombreObjetivo']->idObj?></div>

                  <input type="hidden" id="RowObjetivo<?=$i?>" value="{{$row}}" readonly>

                  <button class="btn" id="edit<?=$i?>" onclick="modalObjetivo(<?=$i?>)"<span class="icon"><i class="icon-edit"></i></span>
                  </button>
                <?$i++;endforeach;?>
                @endisset
              </div>

              <!--<p>
                <input type='checkbox' id='drop-remove' />
                <label for='drop-remove'>eliminar después de arrastrar</label>
              </p>-->

            </div>
              <input type="hidden" id="token" value="{{csrf_token()}}" readonly>
              <input type="hidden" id="feriados" name="feriados" value="">
              @isset($clases)
                <input type="hidden" id="clases" value="{{$clases}}" readonly>
              @endisset
              <div id="fullcalendar"></div>

          </div>
        </div>
      </div>
    </div>

    <div id="myModal1" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Objetivo</h5>
          </div>
          <div class="modal-body">
            

          <div class="form-group">
            @csrf
            <label for="nombreObjetivoEdit" class="col-lg-2 control-label">Objetivo aprendizaje</label>
            <input type="hidden" id="idEdit">
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="nombreObjetivoEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="conocimientosEdit" class="col-lg-2 control-label">Conocimientos previos</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="conocimientosEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="actividadesEdit" class="col-lg-2 control-label">Actividades</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="actividadesEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="evaluacionEdit" class="col-lg-2 control-label">Evaluación</label>
            <div class="col-lg-10">
            <select id="evaluacionEdit" class="form-control">
                <option value=Formativa>Formativa</option>
                <option value=Sumativa>Sumativa</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="indicadoresEdit" class="col-lg-2 control-label">Indicadores de evaluación</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="indicadoresEdit">
            </div>
          </div>

          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" onclick="guardarCambiosObjetivos()">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <div id="myModalEvent" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Clase</h5>
          </div>

          <div class="modal-body">
          <div class="form-group">
            @csrf
            <label for="contenidosEdit" class="col-lg-2 control-label">Contenidos clase</label>
            <input type="hidden" id="idEdit">
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="contenidosEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="recursosEdit" class="col-lg-2 control-label">Recursos</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="recursosEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="inicioEdit" class="col-lg-2 control-label">Inicio</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="inicioEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="desarrolloEdit" class="col-lg-2 control-label">Desarrollo</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="desarrolloEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="cierreEdit" class="col-lg-2 control-label">Cierre</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="cierreEdit">
            </div>
          </div>


          </div>
          <div class="modal-footer">
            <div class="pull-left">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
            </div>
            <button class="btn" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
      
    </div>

    <div id="myModalClases" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Clases sin contenidos</h5>
          </div>
          <div class="modal-body">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Objetivo Aprendizaje (OA)</th>
                  <th>Nombre</th>
                </tr>
              </thead>
              <tbody>
                @isset($indicadorClases)
                <?$i=0;foreach($indicadorClases[1] as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td>
                      <p><?=$row->start?></p>
                    </td>

                    <td><input type="hidden" id="indicadorClases<?=$i?>" value="<?=$row->id?>" readonly>
                      <p><?=$row->title?></p>
                    </td>

                    <td>
                      <p><?=$row->description?></p>
                    </td>

                  </tr>
                  <?$i++;endforeach;?>
                @endisset
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
  </div>

  </div>
</div>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.calendar.js"></script>
<script src="js/planificar.js"></script>
<script src="js/feriados.js"></script>
@endsection