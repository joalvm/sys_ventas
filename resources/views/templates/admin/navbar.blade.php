<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="bi bi-list"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex" id="navbarNavDropdown">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a id="navbar-menu" data-bs-toggle="dropdown" class="nav-link dropdown-toggle d-none d-sm-inline-block show text-dark" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar rounded-circle me-1">
                            <img class="img-fluid" width="36" src="https://thumbs.dreamstime.com/z/confident-determined-businesswoman-positive-face-expression-personal-development-motivation-concept-confident-173703186.jpg" alt="">
                        </span>
                        <span>Chris Wood</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-right" aria-labelledby="navbar-menu">
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
    </div>
</nav>
