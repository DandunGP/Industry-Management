<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('staffDashboard') }}"> Staff </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('warehouseDashboard') }}"> Gudang </a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('officerDashboard') }}">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Officer</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('incomingDashboard') }}">
              <i class="ti-archive menu-icon"></i>
              <span class="menu-title">Incoming Goods</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboardWarehouse') }}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Warehouse</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('supplyDashboard') }}">
              <i class="ti-dropbox menu-icon"></i>
              <span class="menu-title">Supply</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('billDashboard') }}">
              <i class="ti-clipboard menu-icon"></i>
              <span class="menu-title">Bill Of Materials</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('workDashboard') }}">
              <i class="ti-reload menu-icon"></i>
              <span class="menu-title">Work Order</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('productDashboard') }}">
              <i class="ti-harddrives menu-icon"></i>
              <span class="menu-title">Product</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
          </a>
      </li>
  </ul>
</nav>
