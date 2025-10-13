<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container" style="max-width: 1370px;"> <!-- centraliza e limita largura -->

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('index') }}">
            <x-application-logo   style="height: 36px;" />
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links e dropdown -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Menu principal -->
            <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('livros.index') ? 'active' : '' }}" href="{{ route('livros.index') }}">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('autores.index') ? 'active' : '' }}" href="{{ route('autores.index') }}">Autor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('assuntos.index') ? 'active' : '' }}" href="{{ route('assuntos.index') }}">Assunto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('relatorios.autores.*') ? 'active' : '' }}" href="{{ route('relatorios.autores.index') }}">Relatório Autor</a>
                </li>
            </ul>

            <!-- Perfil à direita -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
