<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">
                CT
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
                Creative Tim
            </a>
        </div>
        <ul class="nav">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboardHome') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ request()->is('table-log-payment') ? 'active' : '' }}">
                <a href="{{ route('tableLogPayment') }}">
                    <i class="tim-icons icon-money-coins"></i>
                    <p>Table Log Payments</p>
                </a>
            </li>
            <li class="{{ request()->is('table-user-account') ? 'active' : '' }}">
                <a href="{{ route('tableUserAccount') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Table User Account</p>
                </a>
            </li>
            <li class="{{ request()->is('register-api-keys') ? 'active' : '' }}">
                <a href="{{ route('registerAPIKeys') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>Register API Keys</p>
                </a>
            </li>
            <li class="{{ request()->is('api-event-histories') ? 'active' : '' }}">
                <a href="{{ route('apiEventHistories') }}">
                    <i class="tim-icons icon-vector"></i>
                    <p>Api Event Histories</p>
                </a>
            </li>
            <li>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="tim-icons icon-button-power"></i>
                    <p>Log Out</p>
                </a>
            </li>
        </ul>
    </div>
</div>
