@extends('layouts.mainDocente')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">Directivo</a></div>
  <h1>Correcciones
  </h1>
</div>
    
    <hr>

    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado2">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-edit"></i></span>
            <h5>Correcciones pendientes</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Número unidad</th>
                  <th>Asignatura</th>
                  <th>Curso</th>
                  <th>Directivo</th>
                  <th>Nombre Unidad</th>
                  <th>Observaciones</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @isset($correcciones)
                <?$i=0;foreach($correcciones as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="NuevoNumero<?=$i?>" value="<?=$row['NuevoNumero']?>" readonly>
                      <p><?=$row['NuevoNumero']?></p>
                    </td>

                    <td><input type="hidden" id="asignatura<?=$i?>" value="<?=$row['asignatura']?>" readonly>
                      <p><?=$row['asignatura']?></p>
                    </td>

                    <td><input type="hidden" id="curso<?=$i?>" value="<?=$row['curso']?>" readonly>
                      <p><?=$row['curso']?></p>
                    </td>

                    <td><input type="hidden" id="usuario<?=$i?>" value="<?=$row['idUsuario']?>" readonly>
                      <p>{{$directivo->name}}</p>
                    </td>

                    <td><input type="hidden" id="instanciaUnidad<?=$i?>" value="<?=$row['idInstanciaUnidad']?>" readonly>
                      <p><?=$row['nombreInstanciaUnidad']?></p>
                    </td>

                    <td><input type="hidden" id="correcciones<?=$i?>" value="<?=$row['correcciones']?>" readonly>
                      <p><?=$row['correcciones']?></p>
                    </td>
                    

                    <td class="taskStatus">
                      @if($row['flujo'] == "4")
                        <span class="done">Corrección final</span>
                      @else
                      <a href="contents?asignatura=<?=$row['asignatura']?>&curso=<?=$row['curso']?>&id={{Crypt::encrypt($row['idInstanciaUnidad'] )}}" target="_blank" class="btn btn-primary">Visualizar
                      </a>
                      @endif
                    </td>


                    <td class="taskStatus">
                      @if($row['flujo'] == "4" && $row['estado'] == "2")
                        <a href="#" class="btn btn-success" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Confirmar
                        </a>
                      @else
                        <a href="solicitar?asignatura=<?=$row['asignatura']?>&curso=<?=$row['curso']?>&idInstanciaUnidad={{Crypt::encrypt($row['idInstanciaUnidad'])}}&correccion={{Crypt::encrypt($row['id'])}}" class="btn btn-success" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Solicitar corrección
                        </a>
                      @endif
                    </td>
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


    <div id="listado3">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-check"></i></span>
            <h5>Correcciones realizadas</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Número unidad</th>
                  <th>Asignatura</th>
                  <th>Curso</th>
                  <th>Directivo</th>
                  <th>Nombre Unidad</th>
                  <th>Observaciones</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @isset($correccionesRealizadas)
                <?$i=0;foreach($correccionesRealizadas as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="NuevoNumero<?=$i?>" value="<?=$row['NuevoNumero']?>" readonly>
                      <p><?=$row['NuevoNumero']?></p>
                    </td>

                    <td><input type="hidden" id="asignatura<?=$i?>" value="<?=$row['asignatura']?>" readonly>
                      <p><?=$row['asignatura']?></p>
                    </td>

                    <td><input type="hidden" id="curso<?=$i?>" value="<?=$row['curso']?>" readonly>
                      <p><?=$row['curso']?></p>
                    </td>

                    <td><input type="hidden" id="usuario<?=$i?>" value="<?=$row['idUsuario']?>" readonly>
                      <p>{{$directivo->name}}</p>
                    </td>

                    <td><input type="hidden" id="instanciaUnidad<?=$i?>" value="<?=$row['idInstanciaUnidad']?>" readonly>
                      <p><?=$row['nombreInstanciaUnidad']?></p>
                    </td>

                    <td><input type="hidden" id="correcciones<?=$i?>" value="<?=$row['correcciones']?>" readonly>
                      <p><?=$row['correcciones']?></p>
                    </td>
                    

                    <td class="taskStatus">
                      @if($row['flujo'] == "2" && $row['estado'] == "2")
                        <a href="contents?asignatura=<?=$row['asignatura']?>&curso=<?=$row['curso']?>&id=<?=$row['idInstanciaUnidad']?>" target="_blank" class="btn btn-primary">Visualizar
                      </a>

                      @elseif($row['flujo'] == "4")
                        <span class="done">Corrección final</span>

                      @elseif($row['flujo'] == "3")
                        <span class="in-progress">Solicita corrección</span>

                      @elseif($row['flujo'] == "2")
                        <span class="pending">Corrección directivo</span>

                      @elseif($row['flujo'] == "1")
                        <span class="in-progress">Inicio solicitud</span>

                      @endif
                    </td>

                    <td class="taskStatus">
                      @if($row['flujo'] == "4" && $row['estado'] == "2")
                        <a href="solicitar?asignatura=<?=$row['asignatura']?>&curso=<?=$row['curso']?>&idInstanciaUnidad=<?=$row['idInstanciaUnidad']?>&correccion=<?=$row['id']?>" class="btn btn-success" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Confirmar
                        </a>
                      @elseif($row['estado'] == "3")
                        <span class="done">Finalizada</span>

                      @elseif($row['estado'] == "2")
                        <a href="solicitar?asignatura=<?=$row['asignatura']?>&curso=<?=$row['curso']?>&idInstanciaUnidad=<?=$row['idInstanciaUnidad']?>&correccion=<?=$row['id']?>" class="btn btn-success" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Solicitar corrección
                        </a>

                      @elseif($row['estado'] == "1")
                        <span class="in-progress">Pendiente</span>
                      @endif


                    </td>

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
