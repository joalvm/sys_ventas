<nav class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{url('admin/dashboard')}}">
                <i class="bi bi-speedometer"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-menu collapsed" href="#menu-config" data-toggle="collapse" aria-expanded="false">
                <i class="bi bi-gear"></i>
                <span>Configuraciones</span>
            </a>
            <div id='menu-config' class="collapse nav-item-submenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('admin/tipos_documentos')}}">
                            <span>Tipos de Documentos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('admin/unidades_medidas')}}">
                            <span>Unidades de Medidas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
