@extends('layouts.mainDocente')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.index') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>

  <!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <!--<li class="bg_lb"> <a href="{{ route('dashboard.index') }}"> <i class="icon-dashboard"></i> <span class="label label-important">20</span> Mi Tablero </a> </li>-->
        <li class="bg_lo span3"> <a href="planifications"> <i class="icon-th-list"></i> Planificaciones</a> </li>
        
        <li class="bg_lg span3"> <a href="{{ route('directivo.index') }}"> <i class="icon-pencil"></i> <span class="label label-important"></span> Correcciones UTP</a> </li>
        <!--<li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Establecimientos</a> </li>-->
        <li class="bg_ls span3"> <a href="{{ route('alumno.index') }}"> <i class="icon-group"></i> Alumnos</a> </li>
        <!--<li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>-->
        <li class="bg_lg span3"> <a href="{{ route('charts.index') }}"> <i class="icon-signal"></i> Indicadores</a> </li>
        <li class="bg_lb span3"> <a href="{{ route('addons.calendar') }}"> <i class="icon-calendar"></i>Calendario</a> </li>
        
        <!--<li class="bg_ly"> <a href="{{ route('widgets.index') }}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Repositorio </a> </li>
        <li class="bg_lr"> <a href="{{ route('admin.users') }}"> <i class="icon-info-sign"></i> Administrador</a> </li>-->

      </ul>
    </div>
<!--End-Action boxes-->   


  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span6">

        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Últimas correcciones UTP</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              @isset($correcciones)
              <?$i=0;foreach($correcciones as $row):?>
              <li>
                <div class="user-thumb"> <img width="40" height="40" alt="User" src="img/demo/av1.jpg"> </div>
                <div class="article-post"> <span class="user-info"> De: {{$directivo->name}} / fecha: {{$row->creted_at}} / {{$row->asignatura}} - {{$row->curso}} - Unidad {{$row->NuevoNumero}} </span>
                  <p><a href="#">{{$row->correcciones}}</a> </p>
                </div>
              </li>

                <?$i++;endforeach;?>
              @endisset


              <li > <a class="btn btn-warning btn-mini" href="{{ route('directivo.index') }}"> Ver todas</a> </li>

            </ul>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
            <h5>Retroalimentaciones recientes</h5>
          </div>
          <div class="widget-content">
            <div class="todo">
              <ul>

                @isset($clasesRecientesDoc)
                <?$i=0;foreach($clasesRecientesDoc as $row):?>
                  <li class="clearfix">
                    <div class="txt"> {{$row->comentario}} <span class="by label">{{$row->nombreAsignatura}} {{$row->nombreCurso}}</span> <span class="date badge badge-important">Clase: {{$row->start}}</span> </div>
                    <div class="pull-right"> <a class="tip" href="retroalimentaciones?asignatura={{$row->nombreAsignatura}}&idInstanciaPlaniAnio={{$row->idInstanciaPlaniAnio}}" title="Ver más"> </div>
                  </li>
                <?$i++;endforeach;?>
                @endisset

                <li > <a class="btn btn-warning btn-mini" href="{{ route('alumno.index') }}"> Ver todas</a> </li>

              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
            <h5>Indicadores</h5>
          </div>
          <div class="widget-content">
            <ul class="unstyled">
              <li> <span class="icon24 icomoon-icon-arrow-up-2 red"><a title="" href="#"></span> % Planificaciones <span class="pull-right strong"></span>
                <div class="progress progress-danger progress-striped ">
                  <div style="width: 0%;" class="bar"></div>
                </div>
              </li>

              <li> <span class="icon24 icomoon-icon-arrow-up-2 green"> <a title="" href="#2"></span>% Correcciones UTP <span class="pull-right strong"></span>
                <div class="progress progress-success progress-striped ">
                  <div style="width: 0%;" class="bar"></div>
                </div>
              </li>
              <li> <span class="icon24 icomoon-icon-arrow-down-2 blue"> <a title="" href="#3"></span> % Retroalimentaciones alumnos <span class="pull-right strong"></span>
                <div class="progress progress-striped ">
                  <div style="width: 0%;" class="bar"></div>
                </div>
              </li>
              
              <!--<li> <span class="icon24 icomoon-icon-arrow-up-2 green"> <a title="" href="#4"></span> 3% Online Users <span class="pull-right strong">8</span>
                <div class="progress progress-warning progress-striped ">
                  <div style="width: 3%;" class="bar"></div>
                </div>
              </li>-->
            </ul>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-title bg_lo"  data-toggle="collapse" href="#collapseG3" > <span class="icon"> <i class="icon-chevron-down"></i> </span>
            <h5>Efemérides</h5>
          </div>
          <div class="widget-content nopadding updates collapse in" id="collapseG3">
            <div class="new-update clearfix"><i class="icon-ok-sign"></i>
              <div class="update-done"><a title="" href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a> <span>dolor sit amet, consectetur adipiscing eli</span> </div>
              <div class="update-date"><span class="update-day">20</span>jan</div>
            </div>
            <div class="new-update clearfix"> <i class="icon-gift"></i> <span class="update-notice"> <a title="" href="#"><strong>Congratulation Maruti, Happy Birthday </strong></a> <span>many many happy returns of the day</span> </span> <span class="update-date"><span class="update-day">11</span>jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-move"></i> <span class="update-alert"> <a title="" href="#"><strong>Maruti is a Responsive Admin theme</strong></a> <span>But already everything was solved. It will ...</span> </span> <span class="update-date"><span class="update-day">07</span>Jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-leaf"></i> <span class="update-done"> <a title="" href="#"><strong>Envato approved Maruti Admin template</strong></a> <span>i am very happy to approved by TF</span> </span> <span class="update-date"><span class="update-day">05</span>jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-question-sign"></i> <span class="update-notice"> <a title="" href="#"><strong>I am alwayse here if you have any question</strong></a> <span>we glad that you choose our template</span> </span> <span class="update-date"><span class="update-day">01</span>jan</span> </div>
          </div>
        </div>
      </div>
    </div>

    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box widget-calendar">
          <div class="widget-title"> <span class="icon"><i class="icon-calendar"></i></span>
            <h5>Calendario</h5>
            <div class="buttons"> <a id="add-event" data-toggle="modal" href="#modal-add-event" class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Add new event</a>
              <div class="modal hide" id="modal-add-event">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h3>Add a new event</h3>
                </div>
                <div class="modal-body">
                  <p>Enter event name:</p>
                  <p>
                    <input id="event-name" type="text" />
                  </p>
                </div>
                <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Cancel</a> <a href="#" id="add-event-submit" class="btn btn-primary">Add event</a> </div>
              </div>
            </div>
          </div>
          <div class="widget-content">
            <div class="panel-left">
              <div id="fullcalendarDash"></div>
            </div>
            <div id="external-events-Dash" class="panel-right">
              <div class="panel-title">
                <h5>Drag Events to the calander</h5>
              </div>
              <div class="panel-content">
                <div class="external-event ui-draggable label label-inverse">My Event 1</div>
                <div class="external-event ui-draggable label label-inverse">My Event 2</div>
                <div class="external-event ui-draggable label label-inverse">My Event 3</div>
                <div class="external-event ui-draggable label label-inverse">My Event 4</div>
                <div class="external-event ui-draggable label label-inverse">My Event 5</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.calendar.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 
<script src="js/matrix.interface.js"></script> 
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
@endsection