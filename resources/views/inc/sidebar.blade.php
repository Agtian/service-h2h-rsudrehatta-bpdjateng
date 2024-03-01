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

            @if (Auth::user()->level_user == 1)
                @include('inc.sidebar.user')
            @elseif (Auth::user()->level_user == 2)
                @include('inc.sidebar.administrator')
            @endif

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
