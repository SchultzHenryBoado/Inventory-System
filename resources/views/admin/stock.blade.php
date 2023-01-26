<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STOCK PROFILES</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
  <!-- <script src="./js/tables.js" defer></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script> -->
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
            <a class="dropdown-item" href="#">Logout</a>
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
            <i class="fa-solid fa-boxes-stacked text-white lh-lg mt-2"></i>
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
                    <a href="/user" class="nav-link text-dark">User Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="/company" class="nav-link text-dark">Company Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="/stock_profiles" class="nav-link text-dark">Stock Profile</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>

  <!-- User form -->
  <div class="container mt-5">
    <div class="mb-3">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCompany">
        Add Stocks
      </button>
    </div>

    <form action="./php/stocks_create.php" method="post" class="needs-validation" novalidate>
      <div class="modal fade" id="createCompany" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Add a Stocks</h1>
            </div>
            <div class="modal-body">
              <div class="col-12">
                <!-- stock code -->
                <div class="form-floating mb-3">
                  <input type="text" name="stock_code" id="stockCode" class="form-control" placeholder="Stock Code" required>
                  <label for="stockCode">Input a stock code</label>
                  <div class="invalid-feedback">
                    Please fill-up the stock code.
                  </div>
                </div>
              </div>
              <div class="col-12">
                <!-- description -->
                <div class="form-floating mb-3">
                  <input type="text" name="description" id="description" class="form-control" placeholder="Description" required>
                  <label for="description">Input a description</label>
                  <div class="invalid-feedback">
                    Please fill-up the description.
                  </div>
                </div>
              </div>
              <div class="col-12">
                <!-- uom -->
                <div class="form-floating mb-3">
                  <input type="text" name="uom" id="uom" class="form-control" placeholder="Uom" required>
                  <label for="uom">Input an UOM</label>
                  <div class="invalid-feedback">
                    Please fill-up the UOM.
                  </div>
                </div>
              </div>
              <div class="col-12">
                <!-- status -->
                <div class="form-floating mb-3">
                  <select name="statuses" id="status" class="form-select">
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                  </select>
                  <label for="status">Status</label>
                  <div class="invalid-feedback">
                    Please fill-up the status.
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success fw-bold" name="register_stocks">Register</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped table-hover " id="dataTable" style="width: 100%;">
        <thead class="table-success">
          <tr>
            <th>Stock Code</th>
            <th>Description</th>
            <th>UOM</th>
            <th>Status</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  </div>
</body>

</html>