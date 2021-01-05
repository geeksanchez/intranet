    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
          <img src="/img/HelpharmaLogo.png" alt="logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light"><H4>Helpharma</H4></span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/img/user-mask.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              @can('farma_user')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa-fw nav-icon fas fa-biohazard"></i>
                  <p>
                    Farmacoseguridad
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('farmacoseguridad.index') }}" class="nav-link {{ request()->is('farmacoseguridad/index') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Seguimiento</p>
                    </a>
                  </li>
                  @can('farma_manage')
                  <li class="nav-item">
                    <a href="{{ route('farmacoseguridad.export') }}" class="nav-link {{ request()->is('farmacoseguridad/export') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Exportar seguimientos</p>
                    </a>
                  </li>
                  @endcan
                </ul>
              </li>
              @endcan
              @can('pqrs_manage')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-comment-dots"></i>
                  <p>
                    PQRS
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('adminpqrs.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Listar PQRS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('adminpqrs.search', '0') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Buscar PQRS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('adminpqrs.download') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Exportar PQRS</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
              @can('covid_manage')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-virus"></i>
                  <p>
                    Monitoreo de salud
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admincovid.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Gestionar casos</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
  