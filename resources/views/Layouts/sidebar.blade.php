<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if(Route::current()->uri() == 'dashboard') echo 'class="active"'; ?>><a href="{{ route('dashboard.index') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li <?php if(Route::current()->uri() == 'charts') echo 'class="active"'; ?>> <a href="{{ route('charts.index') }}"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    <li <?php if(Route::current()->uri() == 'widgets') echo 'class="active"'; ?>> <a href="{{ route('widgets.index') }}"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
    <li <?php if(Route::current()->uri() == 'tables') echo 'class="active"'; ?>><a href="{{ route('tables.index') }}"><i class="icon icon-th"></i> <span>Tables</span></a></li>
    <li <?php if(Route::current()->uri() == 'grid') echo 'class="active"'; ?>><a href="{{ route('grid.index') }}"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
    <li class="submenu <?php if(Route::current()->uri() == 'form-common' || Route::current()->uri() == 'form-validation' || Route::current()->uri() == 'form-wizard') echo 'active'; ?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="{{ route('forms.common') }}">Basic Form</a></li>
        <li><a href="{{ route('forms.validation') }}">Form with Validation</a></li>
        <li><a href="{{ route('forms.wizard') }}">Form with Wizard</a></li>
      </ul>
    </li>
    <li <?php if(Route::current()->uri() == 'buttons') echo 'class="active"'; ?>><a href="{{ route('buttons.index') }}"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li <?php if(Route::current()->uri() == 'interface') echo 'class="active"'; ?>><a href="{{ route('interface.index') }}"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu

    <?php if(Route::current()->uri() == 'addons-index2' || 
            Route::current()->uri() == 'addons-gallery' || 
            Route::current()->uri() == 'addons-calendar' ||
            Route::current()->uri() == 'addons-invoice' || 
            Route::current()->uri() == 'addons-chat')
            echo 'active';
    ?>

    "> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="{{ route('addons.index2') }}">Dashboard2</a></li>
        <li><a href="{{ route('addons.gallery') }}">Gallery</a></li>
        <li><a href="{{ route('addons.calendar') }}">Calendar</a></li>
        <li><a href="{{ route('addons.invoice') }}">Invoice</a></li>
        <li><a href="{{ route('addons.chat') }}">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu

    <?php if(Route::current()->uri() == 'error-403' || 
            Route::current()->uri() == 'error-404' || 
            Route::current()->uri() == 'error-405' ||
            Route::current()->uri() == 'error-500')
            echo 'active';
    ?>

    "> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="{{ route('errors.error403') }}">Error 403</a></li>
        <li><a href="{{ route('errors.error404') }}">Error 404</a></li>
        <li><a href="{{ route('errors.error405') }}">Error 405</a></li>
        <li><a href="{{ route('errors.error500') }}">Error 500</a></li>
      </ul>
    </li>
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>
  </ul>
</div>
<!--sidebar-menu-->