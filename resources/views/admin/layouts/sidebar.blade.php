<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ERP_EDU_PRO_01</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/admin/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Inventory
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show.units')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.suppliers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.manufacturers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manufacturers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.productCatagory')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.subCatagory')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Sub Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.products')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.clients')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.locations')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Locations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.stores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('show.receive.details')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventory Receive Main</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>