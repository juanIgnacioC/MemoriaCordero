@extends('layouts.main')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="planification?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{$instanciaUnidad->idInstanciaPlaniAño}}" class="current">Planificación</a>  <a href="#" class="current">Unidad</a></div>

    <h1><strong>Unidad {{$instanciaUnidad->NuevoNumero}}</strong>:  {{$instanciaUnidad->NuevoNombre}}. {{$curso}} - {{$asignatura}}
    </h1>
    <h2><strong>Objetivo general</strong>: {{$instanciaUnidad->NuevoObjetivoGeneral}}</h2>

  </div>

    <a href="solicitar?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaUnidad={{$instanciaUnidad->id}}" class="btn btn-success" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Solicitar corrección
    </a>
    
    <hr>

    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado">

      <div class="widget-box collapsible">

        <div class="widget-title"> <a href="#collapseOne" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Habilidades</h5>
          </a> <div name="agregarHabilidad" id="agregarHabilidad" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="abilities?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>

        <div class="collapse" id="collapseOne">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @for ($i = 0; $i < count($habilidades); $i++)
                  <li class="clearfix">
                    <div class="txt" id="habilidad{{$i}}"> {{$habilidades[$i]->NuevoNombre}} <span class="by label">Admin</span> <span class="date badge badge-info">Habilidad</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                  </li>
                @endfor

              </ul>
            </div>
          </div>
        </div>

        <div class="widget-title"> <a href="#collapseTwo" data-toggle="collapse"> <span class="icon"><i class="icon-book"></i></span>
          <h5>Actitudes</h5>
          </a> <div name="agregarActitud" id="agregarActitud" class="pull-right" style="vertical-align: middle; margin-right: 5px;"> <a class="tip" href="attitudes?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" title="Agregar">Agregar<i class="icon-plus-sign"></i></a> </div>
        </div>
        <div class="collapse" id="collapseTwo">
          <div class="widget-content">
            <div class="todo">
              <ul>
                @for ($i = 0; $i < count($actitudes); $i++)
                  <li class="clearfix">
                    <div class="txt" id="actitud{{$i}}"> {{$actitudes[$i]->NuevoNombre}} <span class="by label">Admin</span> <span class="date badge badge-info">Actitud</span> </div>
                    <div class="pull-right"> <a class="tip" href="" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                  </li>
                @endfor
              </ul>
            </div>
          </div>
        </div>

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


      </div>
    </div>

    <hr>
    <a href="objectives?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" class="btn btn-primary" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Agregar Objetivo
    </a>
    <a href="calendarUnidad?asignatura={{$asignatura}}&curso={{$curso}}&id={{$instanciaUnidad->id}}" class="btn btn-success" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Planificación clases
    </a>
    <div id="listado2">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Objetivos</h5>
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
                      <p><?=$row['nombreObjetivo']->NuevoNombre?></p>
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
