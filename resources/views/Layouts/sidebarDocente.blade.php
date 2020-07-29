<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if(Route::current()->uri() == 'dashboard') echo 'class="active"'; ?>><a href="{{ route('dashboard.index') }}"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>


    <li <?php if(Route::current()->uri() == 'planifications') echo 'class="active"'; ?>> <a href="{{ route('forms.planifications') }}"><i class="icon icon-th-list"></i> <span>Planificaciones</span></a> </li>

    <li <?php if(Route::current()->uri() == 'directivo') echo 'class="active"'; ?>> <a href="{{ route('directivo.index') }}"><i class="icon icon-pencil"></i> <span>Correcciones</span></a> </li>

    <li <?php if(Route::current()->uri() == 'alumno') echo 'class="active"'; ?>> <a href="{{ route('alumno.index') }}"><i class="icon-group"></i> <span>Alumnos</span></a> </li>

    <li <?php if(Route::current()->uri() == 'charts') echo 'class="active"'; ?>> <a href="{{ route('charts.index') }}"><i class="icon icon-signal"></i> <span>Indicadores</span></a> </li>

    <li <?php if(Route::current()->uri() == 'addons-calendar') echo 'class="active"'; ?>> <a href="{{ route('addons.calendar') }}"><i class="icon-calendar"></i> <span>Calendario</span></a> </li>

    <!-- Incluir estrellas?-->
  </ul>
</div>
<!--sidebar-menu-->