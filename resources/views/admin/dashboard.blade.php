<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DASHBOARD</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="./js/tables.js" defer></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
</head>

<body>
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
            <a class="dropdown-item" href="#">Change Password</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="nav-item text-center">
            <a class="dropdown-item" href="{{ url ('/admin_logout') }}">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start __sidebar" data-bs-scroll="true" tabindex="-1" id="offcanvasAdmin" style="width: 300px;">

    <div class="offcanvas-header bg-success">
      <h5 class="offcanvas-title text-white fw-bold fs-3 text-center" id="offcanvasExampleLabel">Inventory Management
        System</h5>
    </div>

    <div class="offcanvas-body bg-success">
      <ul class="nav flex-column __nav ">

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-gauge text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/dashboard">Dashboard</a>
          </div>
        </li>

        <div class="accordion accordion-flush" id="myAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed bg-success text-white fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                Master File
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
              <div class="accordion-body">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="/user_profiles" class="nav-link text-dark">User Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="/company" class="nav-link text-dark">Company Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="/stock" class="nav-link text-dark">Stock Profile</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>

  <!-- Dashboard content -->
  <div class="container-fluid">
    <div class="container mt-5">
      <div class="row">
        <!-- Received -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-warning">
              <p class="fs-5">Received</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>

        <!-- Issued -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-primary">
              <p class="fs-5 text-white">Issued</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>

        <!-- Transfer out -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-success">
              <p class="fs-5 text-white">Transfer Out</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>

        <!-- Unposted Receiving -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-warning">
              <p class="fs-5">Unposted Receiving</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>

        <!-- Unposted Issued -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-primary">
              <p class="fs-5 text-white">Unposted Issued</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>

        <!-- Issued -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-success">
              <p class="fs-5 text-white">Unposted Transfer Out</p>
            </div>
            <div class="card-body">
              <p class="fs-1 text-end">10</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="container mt-5">
      <div class="table-responsive">
        <table class="table table-striped table-hover mt-4" style="width:100%" id="dataTable">
          <thead class="table-success">
            <tr>
              <th>Inventory ID</th>
              <th>Description</th>
              <th>UOM</th>
              <th>Qty</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>sample inventory id</td>
              <td>sample description</td>
              <td>sample uom</td>
              <td>sample qty</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>

</html>