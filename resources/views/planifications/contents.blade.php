@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{Crypt::encrypt($instanciaUnidad->idInstanciaPlaniAño )}}" class="current">Planificación</a>  <a href="#" class="current">Unidad</a></div>

    <h1><strong>Unidad {{$instanciaUnidad->NuevoNumero}}</strong>:  {{$instanciaUnidad->NuevoNombre}}. {{$curso}} - {{$asignatura}}
    </h1>
    <h2><strong>Objetivo general</strong>: {{$instanciaUnidad->NuevoObjetivoGeneral}}</h2>

  </div>

    <a href="solicitar?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaUnidad={{Crypt::encrypt($instanciaUnidad->id )}}" class="btn btn-success" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Solicitar corrección
    </a>

    <a href="#" title="Indicador objetivos prioritarios" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Indicador que corresponde al uso mínimo de objetivos priorizados por el MINEDUC. (Click para ver detalle)" onclick="modalPrioridad()">Objetivos:</a>

    @php $rating = $indicadorPrioridad[0]; @endphp  
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
    ({{$indicadorPrioridad[0]}})

    <a href="#" title="Indicador habilidades" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Indicador que corresponde al uso de habilidades del MINEDUC">Habilidades:</a>
    @php $rating = $indicadorHabilidad; @endphp  
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
    ({{$indicadorHabilidad}})

    <a href="#" title="Indicador actitudes" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Indicador que corresponde al uso de actitudes del MINEDUC">Actitudes:</a> 
    @php $rating = $indicadorActitud; @endphp  
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
    ({{$indicadorActitud}})
    
    <hr>

    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>
    <input type="hidden" id="asignatura" value="{{ $asignatura }}" readonly>
    <input type="hidden" id="curso" value="{{ $curso }}" readonly>
    <input type="hidden" id="idInstanciaUnidad" value="{{Crypt::encrypt($instanciaUnidad->id )}}" readonly>

    <div id="listado">

      <div class="widget-box collapsible">

        <div class="widget-title"> <a href="#collapseOne" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Habilidades</h5>
          </a> <div name="agregarHabilidad" id="agregarHabilidad" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="abilities?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>

        <div class="collapse" id="collapseOne">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @for ($i = 0; $i < count($habilidades); $i++)
                  <li class="clearfix">
                    <div class="txt" id="habilidad{{$i}}"> {{$habilidades[$i]->NuevoNombre}} <span class="by label">{{$habilidades[$i]->idObj}}</span> <span class="date badge badge-info">Habilidad</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Editar"><i class="icon-pencil"></i></a>
                    <a class="tip" onclick="eliminarHabilidad('{{Crypt::encrypt($habilidades[$i]->id ) }} ')" title="Eliminar"><i class="icon-remove"></i></a> 
                    </div>
                  </li>
                @endfor

              </ul>
            </div>
          </div>
        </div>

        <div class="widget-title"> <a href="#collapseTwo" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Actitudes</h5>
          </a> <div name="agregarActitud" id="agregarActitud" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="attitudes?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>
        <div class="collapse" id="collapseTwo">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @for ($i = 0; $i < count($actitudes); $i++)
                  <li class="clearfix">
                    <div class="txt" id="actitud{{$i}}"> {{$actitudes[$i]->NuevoNombre}} <span class="by label">{{$actitudes[$i]->idObj}}</span> <span class="date badge badge-info">Actitud</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Editar"><i class="icon-pencil"></i></a> 
                      <a class="tip" onclick="eliminarActitud('{{Crypt::encrypt($actitudes[$i]->id ) }} ')" title="Eliminar"><i class="icon-remove"></i></a>
                   </div>
                  </li>
                @endfor
              </ul>
            </div>
          </div>
        </div>
<!--
        <div class="widget-title"> <a href="#collapseThree" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Objetivos de aprendizaje transversales (OAT) </h5>
          </a> <div name="agregarOAT" id="agregarOAT" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="attitudes?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>
        <div class="collapse" id="collapseThree">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @isset($oat)
                @for ($i = 0; $i < count($oat); $i++)
                  <li class="clearfix">
                    <div class="txt" id="oat{{$i}}"> {{$oat[$i]->NuevoNombre}} <span class="by label">Admin</span> <span class="date badge badge-info">OAT</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                  </li>
                @endfor
                @endisset
              </ul>
            </div>
          </div>
        </div>

        <div class="widget-title"> <a href="#collapseFour" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Diseños universales del aprendizaje (DUA) </h5>
          </a> <div name="agregarDUA" id="agregarDUA" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="attitudes?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>
        <div class="collapse" id="collapseFour">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @isset($dua)
                @for ($i = 0; $i < count($dua); $i++)
                  <li class="clearfix">
                    <div class="txt" id="dua{{$i}}"> {{$dua[$i]->NuevoNombre}} <span class="by label">Admin</span> <span class="date badge badge-info">DUA</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                  </li>
                @endfor
                @endisset
              </ul>
            </div>
          </div>
        </div>
-->

      </div>
    </div>

    <div id="myModalEliminarHabilidad" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>¿Está seguro de que desea eliminar esta habilidad?</h5>
          </div>
          <div class="modal-body">
            
          <input type="hidden" id="previous" value="">

          <input type="hidden" id="idUnidadHabilidad">


          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" onclick="eliminarInstanciaUnidadHabilidad()">Eliminar</button>
          </div>
        </div>
      </div>

    </div>

    <div id="myModalEliminarActitud" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>¿Está seguro de que desea eliminar esta actitud?</h5>
          </div>
          <div class="modal-body">
            
          <input type="hidden" id="previous" value="">

          <input type="hidden" id="idUnidadActitud">


          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" onclick="eliminarInstanciaUnidadActitud()">Eliminar</button>
          </div>
        </div>
      </div>

    </div>

    <hr>
    <a href="objectives?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" class="btn btn-primary" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Agregar Objetivo
    </a>
    <a href="calendarUnidad?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($instanciaUnidad->id )}}" class="btn btn-success" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Planificación clases
    </a>
    <div id="listado2">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Objetivos.     <i class="icon-star"></i> = Objetivos priorizados (nivel 1) | <i class="icon-star-empty"></i> = Objetivos semi priorizados (nivel 2).</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Objetivo Aprendizaje (OA)</th>
                  <th>Conocimientos Previos</th>
                  <th>Actividades</th>
                  <th>Indicadores</th>
                  <th>Evaluación</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @isset($dataPlaniUnidad)
                <?$i=0;foreach($dataPlaniUnidad as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="nombreObjetivo<?=$i?>" value="<?=$row['nombreObjetivo']->NuevoNombre?>" readonly>
                      <p>
                        @if($row['nombreObjetivo']->prioridad == 1)
                          <i class="icon-star"></i>
                        @elseif($row['nombreObjetivo']->prioridad == 2)
                          <i class="icon-star-empty"></i>
                        @endif
                        <?=$row['nombreObjetivo']->NuevoNombre?>
                      </p>
                    </td>

                    <td>                    
                      <?for ($j = 0; $j < $row['conocimientos']->count(); $j++) {
                        ?><input type="hidden" id="conocimientos<?=$j?>" value="<?=$row['conocimientos'][$j]->id?>" readonly>
                        <p><?

                        echo $row['conocimientos'][$j]->nuevoNombre;
                        ?></p> <?
                      }
                      ?>
                    </td>

                    <td><input type="hidden" id="actividades<?=$i?>" value="<?=$row['actividades']->nombre?>" readonly>
                      <p><?=$row['actividades']->nombre?></p>
                    </td>

                    <td>                    
                      <?for ($j = 0; $j < $row['indicadores']->count(); $j++) {
                        ?><input type="hidden" id="indicadores<?=$j?>" value="<?=$row['indicadores'][$j]->id?>" readonly>
                        <p><?

                        echo $row['indicadores'][$j]->nuevoNombre;
                        ?></p> <?
                      }
                      ?>
                    </td>

                    <td><input type="hidden" id="evaluacion<?=$i?>" value="<?=$row['evaluacion']->nombre?>" readonly>
                      <p><?=$row['evaluacion']->nombre?></p>
                    </td>
                    

                    <td><a href="#" class="btn btn-warning">Editar
                    </a></td>
                    <td><button id="eliminar<?=$i?>" name="eliminar<?=$i?>" class="btn btn-danger" >Eliminar</button></td>
                  </tr>
                <?$i++;endforeach;?>
                @endisset
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>


  <div id="myModal1" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Objetivos prioritarios sin usar</h5>
          </div>

          <div class="modal-body">
            <table class="table table-bordered data">
              <thead>
                <tr>
                  <th>Objetivo Aprendizaje (OA)</th>
                  <th>Nombre</th>
                </tr>
              </thead>
              <tbody>
                @isset($indicadorPrioridad)
                <?$i=0;foreach($indicadorPrioridad[1] as $row):?>
                  <tr class="trhideclass<?=$i?>">
                    <td><input type="hidden" id="indicadorPrioridad<?=$i?>" value="<?=$row->id?>" readonly>
                      <p><?=$row->idObj?></p>
                    </td>

                    <td>
                      <p><?=$row->nombre?></p>
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

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/planificar.js"></script>

<script src="js/indicadores.js"></script>
<script src="js/control.js"></script>
@endsection
