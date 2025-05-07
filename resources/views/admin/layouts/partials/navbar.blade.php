<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">E-Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li class="dropdown-item d-flex align-items-center">
                            <img src="https://i.pravatar.cc/40?u={{ Auth::id() }}" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                            <span>{{ Auth::user()->name }}</span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href=""
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>
                        </li>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <!-- Dark/Light Mode Toggle Button -->
                    <button class="btn btn-sm btn-outline-secondary ms-2" id="themeToggle" title="Toggle Theme">
                        <i class="bi bi-moon-fill" id="themeIcon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
