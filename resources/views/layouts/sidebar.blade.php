<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <router-link to="/" class="nav-link active">
                    <i class="nav-icon fa fa-dashboard"></i> Dashboard
                </router-link>
            </li>
            <li class="nav-title">Settings</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-user"></i> User
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <router-link to="/users" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> List Users
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/role" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Roles
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/permission" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Permission
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>