<nav class="navbar navbar-expand">
    <a class="navbar-brand" href="#">
        <i class="bi bi-list"></i>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block show text-dark" href="#" id="navbarDropdownMenuLink"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="avatar rounded-circle me-1">
                        <img class="img-fluid" src="https://thumbs.dreamstime.com/z/confident-determined-businesswoman-positive-face-expression-personal-development-motivation-concept-confident-173703186.jpg" alt="">
                    </span>
                    <span>Chris Wood</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('admin/profile') }}">
                        <i class="bi bi-person align-middle mr-3"></i>
                        <span>Perfil</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('admin/logout') }}">
                        <i class="bi bi-box-arrow-left  align-middle mr-3"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
