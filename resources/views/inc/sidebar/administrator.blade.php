<li class="{{ request()->is('dashboard') ? 'active' : '' }}">
    <a href="{{ url('dashboard') }}">
        <i class="tim-icons icon-chart-pie-36"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="{{ request()->is('table-log-payment') ? 'active' : '' }}">
    <a href="{{ url('dashboard/table-log-payment') }}">
        <i class="tim-icons icon-money-coins"></i>
        <p>Table Log Payments</p>
    </a>
</li>
<li class="{{ request()->is('table-user-account') ? 'active' : '' }}">
    <a href="{{ url('dashboard/table-user-account') }}">
        <i class="tim-icons icon-single-02"></i>
        <p>Table User Account</p>
    </a>
</li>
<li class="{{ request()->is('register-api-keys') ? 'active' : '' }}">
    <a href="{{ url('dashboard/register-api-keys') }}">
        <i class="tim-icons icon-puzzle-10"></i>
        <p>Register API Keys</p>
    </a>
</li>
<li class="{{ request()->is('api-event-histories') ? 'active' : '' }}">
    <a href="{{ url('dashboard/api-event-histories') }}">
        <i class="tim-icons icon-vector"></i>
        <p>Api Event Histories</p>
    </a>
</li>
