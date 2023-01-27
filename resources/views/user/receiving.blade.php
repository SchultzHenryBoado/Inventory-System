<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RECEIVING</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="{{ url('js/dataTable.js') }}" defer></script>
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
            <a class="dropdown-item" href="./change_password.php">Change Password</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="nav-item text-center">
            <a class="dropdown-item" href="./php/logout.php">Logout</a>
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
            <a class="nav-link text-white ms-2 mt-1" href="./receiving.php">Receiving</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-box-open text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="./issuance.php">Issuance</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-right text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="./transfer_in.php">Transfer In</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-left-long text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="./transfer_out.php">Transfer Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div class="container-fluid mt-5">
    <div class="container">

      <div class="mb-3 d-inline-block">
        <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addReceiving">Add Receiving</button>

        <form action="#" method="post" class="needs-validation" novalidate>
          <div class="modal fade" id="addReceiving" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Receiving</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="text" name="receiving_no" id="receivingNo" class="form-control" placeholder="Receiving No" required>
                        <label for="receivingNo">Receiving No</label>
                        <div class="invalid-feedback">
                          Please fill-up the receiving no.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <select name="warehouse" id="warehouse" class="form-control" required>
                          <option disabled selected value>-- Choose a warehouse --</option>
                          <option value="warehouse">warehouse</option>
                        </select>
                        <label for="warehouse">Warehouse</label>
                        <div class="invalid-feedback">
                          Please choose in warehouse.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="date" name="date" id="date" class="form-control" required>
                        <label for="date">Date</label>
                        <div class="invalid-feedback">
                          Please fill-up the date.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="text" name="po_number" id="poNum" class="form-control" placeholder="P.O. Number" required>
                        <label for="poNum">P.O. Number</label>
                        <div class="invalid-feedback">
                          Please fill-up the P.O. number.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description" required>
                        <label for="description">Description</label>
                        <div class="invalid-feedback">
                          Please fill-up the description.
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success fw-bold" name="create_receiving">Create</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="mb-3 d-inline-block">
        <form action="./php/export_receiving.php" method="post">
          <button type="submit" name="export_receiving" class="btn btn-success fw-bold">Download Excel
            <i class="fa-solid fa-file-excel ms-1"></i>
          </button>
        </form>
      </div>


      <div class="table-responsive mt-3">
        <table class="table" id="dataTable" style="width: 100%;">
          <thead>
            <tr>
              <th>Receiving No.</th>
              <th>Warehouse</th>
              <th>Date</th>
              <th>P.O. Number</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>