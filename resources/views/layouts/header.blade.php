<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">
        <img class="navbar-brand-full" src="data:image/png;base64,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" width="89" height="25" alt="Modulr Logo">
        <img class="navbar-brand-minimized" src="data:image/png;base64,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" width="30" height="30" alt="Modulr Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto mr-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar mx-1" src="{{Auth::user()->image_url}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow mt-2">
                <a class="dropdown-item">
                    {{ Auth::user()->name }}<br>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </a>
                <router-link to="/profile" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                </router-link>
                <div class="divider"></div>
                <router-link to="/password" class="dropdown-item">
                    <i class="fas fa-key"></i> Password
                </router-link>
                <div class="divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>