<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="../../img/logo-xs.jpg"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        @guest
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif --}}
        @else
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
        @endguest


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('isSuper')
                    <li class="nav-item">
                        <a href="{{ url('/roles') }}" class="nav-link">
                            <i class="nav-icon fas fa-unlock-alt"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                @canany(['isSuper','isAdmin'])
                    <li class="nav-item">
                        <a href="{{ url('/users') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/sucursals') }}" class="nav-link">
                            <i class="nav-icon fas fa-store"></i>
                            <p>Sucursales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/sales') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Ventas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/notifications') }}" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notificaciones</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{-- menu-open --}}">
                        <a href="{{ url('/todos') }}" class="nav-link {{-- active --}}">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>Tareas <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/todos') }}" class="nav-link {{-- active --}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver las Listas de Tareas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/tasks') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver todas las Tareas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/todolists') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver Tareas Realizadas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/offers') }}" class="nav-link">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>Ofertas</p>
                        </a>
                    </li>
                @endcanany
               {{--  <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                    </a>
                </li> --}}
                <li class="nav-item has-treeview">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>

                </li>
            </ul>
        </nav>
    </div>
</aside>