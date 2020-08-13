@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Indicadores</a></div>
    <h1>Indicadores</h1>
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

    <hr>

    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        
        <li class="bg_lg span3"> <a href="planifications"> <i class="icon-th-list"></i> {{$planificacionesFinalizadas}} Planificación(es) finalizada(s)</a> </li>

        <li class="bg_ly span3"> <a href="planifications"> <i class="icon-th-list"></i> {{$planificacionesPendientes}} Planificación(es) pendiente(s)</a> </li>
        
        <li class="bg_lb span3"> <a href="planifications"> <i class="icon-th-list"></i> {{count($instanciasPlaniAño)}} Planificación(es) (total)</a> </li>


        <li class="bg_lg span3"> <a href="{{ route('directivo.index') }}"> <i class="icon-pencil"></i> {{count($correccionesRecibidas)}} Corrección(es) recientes(s) UTP</a> </li>

        <li class="bg_ly span3"> <a href="{{ route('directivo.index') }}"> <i class="icon-pencil"></i> {{count($correccionesPendientes)}} Corrección(es) pendiente(s) UTP</a> </li>

        <li class="bg_lb span3"> <a href="{{ route('directivo.index') }}"> <i class="icon-pencil"></i>{{count($correccionesRecibidasTotal)}} Corrección(es) UTP (total)</a> </li>


        <li class="bg_ls span3"> <a href="{{ route('alumno.index') }}"> <i class="icon-group"></i> {{count($retroalimentacionesRecibidas)}} Retroalimentación(es) Alumno(s)</a> </li>


        <li class="bg_lb span3"> <a> <i class="icon-user"></i>{{$conteoDocentes}} Docente(s)</a> </li>

      </ul>
    </div>

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Indicadores</h5>
          </div>

          <div class="widget-content">

            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nombre Curso</th>
                  <th>Nombre Asignatura</th>
                  <th>Indicador Planificación</th>
                  <th>Indicador Retroalimentación</th>
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
                      <p>                        
                        @php $rating = $indicadorPlaniAnio[$i]; @endphp  
                        @foreach(range(1,5) as $j)
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
                        (<?=$indicadorPlaniAnio[$i]?>)    
                      </p>
                    </td>
                    

                    <td><input type="hidden" id="anio<?=$i?>" value="<?=$row['anio']?>" readonly>
                      <p>
                        @php $rating = $indicadorPlaniAnioClases[$i]; @endphp  
                        @foreach(range(1,5) as $j)
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
                        (<?=$indicadorPlaniAnioClases[$i]?>)    
                      </p>
                    </td>
                    
                    <td><a href="planification?asignatura=<?=$row['nombreAsignatura']?>&curso=<?=$row['nombreCurso']?>&idInstanciaPlaniAño={{Crypt::encrypt($row['id'] )}}" class="btn btn-primary">Planificar
                    </a></td>

                    <td><a href="retroalimentaciones?asignatura=<?=$row['nombreAsignatura']?>&idInstanciaPlaniAnio=<?=$row['id']?>" class="btn btn-success">Retroalimentaciones
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


<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.pie.min.js"></script> 
<script src="js/matrix.charts.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/jquery.peity.min.js"></script> 

<!--Turning-series-chart-js-->
<script src="js/matrix.dashboard.js"></script>

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