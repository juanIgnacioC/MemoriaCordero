<!--Header-part-->
<div id="header">
<!--  <h1><a href="{{ route('dashboard.index') }}">Matrix Admin</a></h1>-->
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav"><!---->
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Bienvenido {{ Auth::user()->name }}</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> Mi perfil</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}"><i class="icon-key"></i> Cerrar sesión</a></li>
      </ul>
    </li>
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Notificaciones</span> <span class="label label-important">0</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i></a></li>
      </ul>
    </li>

    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Configuración</span></a></li>

    <li class=""><a title="" href="{{ route('logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Cerrar sesión</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
  <input type="text" placeholder="Busque aquí..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->