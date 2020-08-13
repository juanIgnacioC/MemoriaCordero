@extends('layouts.mainDocente')

@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('forms.planifications') }}" class="tip-bottom">Planificaciones</a> <a href="#" class="current">Planificación</a> </div>
  <h1>Unidades {{$curso}} {{$asignatura}} {{$instanciaPlani->anio}}</h1>
</div>
    
    <hr>

    <a href="form-validation?asignatura={{$asignatura}}&curso={{$curso}}&idInstanciaPlaniAño={{Crypt::encrypt($instanciaPlani->id ) }}" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Agregar Unidad
    </a>

    <input type="hidden" id="token" value="{{ csrf_token() }}" readonly>

    <div id="listado">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Unidades</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Número</th>
                  <th>Nombre</th>
                  <th>Periodo</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Término</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?$i=0;foreach($instanciaUnidades as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td><input type="hidden" id="NuevoNumero<?=$i?>" value="<?=$row['NuevoNumero']?>" readonly>
                      <p><?=$row['NuevoNumero']?></p>
                    </td>

                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="NuevoNombre<?=$i?>" value="<?=$row['NuevoNombre']?>" readonly>
                      <p><?=$row['NuevoNombre']?></p>
                    </td>

                    <td><input type="hidden" id="Periodo<?=$i?>" value="<?=$row['Periodo']?>" readonly>
                      <p><?=$row['Periodo']?></p>
                    </td>

                    <td><input type="hidden" id="fechaInicio<?=$i?>" value="<?=$row['fechaInicio']?>" readonly>
                      <p><?=$row['fechaInicio']?></p>
                    </td>

                    <td><input type="hidden" id="fechaTermino<?=$i?>" value="<?=$row['fechaTermino']?>" readonly>
                      <p><?=$row['fechaTermino']?></p>
                    </td>
                    

                    <td><a href="contents?asignatura={{$asignatura}}&curso={{$curso}}&id={{Crypt::encrypt($row['id'])}}" class="btn btn-primary">Planificar
                    </a></td>
                    <td><button id="eliminar<?=$i?>" name="eliminar<?=$i?>" class="btn btn-danger" >Eliminar</button></td>
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
