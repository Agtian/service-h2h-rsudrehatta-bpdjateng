<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ url('dashboard') }}">
        <img src="{{ asset('asset/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Rehatta Service</span>
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('dashboard') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('dashboard/katalog-service') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Katalog Service</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('dashboard/data-log-service') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Data Log Service</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('dashboard/data-log-payment') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-money-coins text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Data Log Payment</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('dashboard/data-api-key') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-app text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Data API KEY</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('dashboard/data-user') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-badge text-primary text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Data User</span>
          </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ url('dashboard/profile') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a class="nav-link " href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-curved-next text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Log Out</span>
            </a>
        </li>
    </ul>
</div>
