<nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">

    <button class="h-25 ms-5 btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdmin">
      <i class="fa-solid fa-bars fa-xl"></i>
    </button>

    <div class="btn-group me-3">
      <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
        <i class="fa-solid fa-user"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-sm-end">
        <li class="nav-item text-center">
          <a class="dropdown-item" href="/change_password">Change Password</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="nav-item text-center">
          <a class="dropdown-item" href="{{ url ('/logout') }}">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
