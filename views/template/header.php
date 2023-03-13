<header class="p-3 mb-3 border-bottom">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/admin" class="nav-link px-2 text-white">Dashboard</a></li>
          <li class="dropdown">
            <a href="/admin/users" data-bs-toggle="dropdown" class="nav-link px-2 text-white d-flex align-items-center col-lg-4 mb-2 mb-lg-0 text-decoration-none dropdown-toggle show">Users</a>
            <ul class="dropdown-menu text-small shadow">
              <li><a href="/admin/users" class="nav-link px-2 text-white">Users</a></li>
              <li><a href="/admin/roles" class="nav-link px-2 text-white">Roles</a></li>
            </ul>
          </li>
          <li><a href="/admin/links" class="nav-link px-2 text-white">Links</a></li>
          <li><a href="/admin/logs" class="nav-link px-2 text-white">Logs</a></li>
        </ul>

        <div class="dropdown text-end text-white">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/assets/avatar.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  