
<div name="listado" id="listado">
@extends('layouts.main')
@section('content')


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Administrador</a>
  </div>
  <h1>Usuarios 
  </h1>
</div>
    
    <hr>

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Usuarios</h5>
          </div>

          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Tipo</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @isset($users)
                <?$i=0;foreach($users as $row):?>
                  <tr class="trhideclass<?=$i?>">

                    <td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
                      <input type="hidden" id="token" value="{{csrf_token()}}" readonly>
                      <input type="hidden" id="nombreUsuario<?=$i?>" value="<?=$row['name']?>" readonly>
                      <p><?=$row['name']?></p>
                    </td>

                    <td>
                      <input type="hidden" id="correoUsuario<?=$i?>" value="<?=$row['email']?>" readonly>
                      <p><?=$row['email']?></p>
                    </td>

                    <td><input type="hidden" id="tipoUsuario<?=$i?>" value="<?=$row['type']?>" readonly>
                      <select id="tipoUsuario" name="tipoUsuario" disabled="disabled">
                        @if($row['type'] == "1")
                          <option value=1 selected>Docente</option>
                          @else
                          <option value=1>Docente</option>
                        @endif

                        @if($row['type'] == "2")
                          <option value=2 selected>Directivo</option>
                          @else
                          <option value=2>Directivo</option>
                        @endif

                        @if($row['type'] == "3")
                          <option value=3 selected>Administrador</option>
                          @else
                          <option value=3>Administrador</option>
                        @endif
                      </select>
                    </td>                    

                    <td><a href="establecimientos?idUsuario=<?=$row['id']?>" class="btn btn-primary">Establecimientos
                    </a></td>

                    <td><button id="editarUsuario<?=$i?>" name="editar<?=$i?>" onclick="editarUsuario(<?=$i?>)" class="btn btn-info" >Editar</button></td>

                    <td><button id="eliminarUsuario<?=$i?>" name="eliminar<?=$i?>" class="btn btn-danger" >Eliminar</button></td>
                  </tr>
                <?$i++;endforeach;?>
                @endisset
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div id="myModal1" style="display: none;" class="modal" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Editar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
            

          <div class="form-group">
            @csrf
            <label for="nombreEdit" class="col-lg-2 control-label">Nombre</label>
            <input type="hidden" id="idEdit">
            <input type="hidden" id="refAsignaturaEdit">
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="nombreEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="correoEdit" class="col-lg-2 control-label">Correo</label>
            <div class="col-lg-10">
              <input type="text" class ="form-control" id="correoEdit">
            </div>
          </div>

          <div class="form-group">
            <label for="tipoEdit" class="col-lg-2 control-label">Tipo</label>
            <div class="col-lg-10">
            <select id="tipoEdit" class="form-control">
                <option value=1>Docente</option>
                <option value=2>Directivo</option>
                <option value=3>Administrador</option>
              </select>
            </div>
          </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" onclick="guardarCambios()">Guardar</button>
          </div>
        </div>
      </div>
      
    </div>

  </div>
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/planificar.js"></script>


</div>
@endsection
