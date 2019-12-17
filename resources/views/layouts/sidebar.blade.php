<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <router-link to="/" class="nav-link active">
                    <i class="nav-icon fa fa-dashboard"></i> Dashboard
                </router-link>
            </li>
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <router-link to="/instansi" class="nav-link" active-class="active">
                        <i class="nav-icon fa fa-building"></i> Instansi
                    </router-link>
                </li>
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-users"></i> Founder & Teacher
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <router-link to="/founder" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Founder
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/pengurus" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Teacher
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/posisi" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Posisi
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/jabatan" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Jabatan
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <router-link to="/our-program" class="nav-link" active-class="active">
                    <i class="nav-icon icon-globe-alt"></i> Our Program
                </router-link>
            </li>
            <li class="nav-title">MANAGE PORTAL</li>
            <li class="nav-item">
                <router-link to="/page" class="nav-link" active-class="active">
                    <i class="nav-icon icon-docs"></i> Page
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/menu" class="nav-link" active-class="active">
                    <i class="nav-icon icon-menu"></i> Menu
                </router-link>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-blog"></i> News
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <router-link to="/all-post" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> All Post
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/category" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Category
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/testimoni" class="nav-link" active-class="active">
                            <i class="nav-icon icon-arrow-right22"></i> Testimoni
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <router-link to="/gallery" class="nav-link" active-class="active">
                    <i class="nav-icon icon-images2"></i> Gallery</a>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/main-slider" class="nav-link" active-class="active">
                    <i class="nav-icon icon-picture"></i> Main Slider</a>
                </router-link>
            </li>
            {{-- <li class="nav-item">
                <router-link to="/headline" class="nav-link" active-class="active">
                    <i class="nav-icon icon-bookmarks"></i> Headline</a>
                </router-link>
            </li> --}}

            <li class="nav-title">MANAGE FILE</li>
            <li class="nav-item">
                <router-link to="/event" class="nav-link" active-class="active">
                    <i class="nav-icon icon-calendar"></i> Event
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/promo" class="nav-link" active-class="active">
                    <i class="nav-icon icon-tag"></i> Promo</a>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/newsletter" class="nav-link" active-class="active">
                    <i class="nav-icon icon-magazine"></i> Newsletter</a>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/calendar-academics" class="nav-link" active-class="active">
                    <i class="nav-icon icon-calendar2"></i> Calendar Academics</a>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/messages" class="nav-link" active-class="active">
                    <i class="nav-icon icon-comment-discussion"></i> Message
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/subscribes" class="nav-link" active-class="active">
                    <i class="nav-icon icon-file-eye"></i> Subscribes
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