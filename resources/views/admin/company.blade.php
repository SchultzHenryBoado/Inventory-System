<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COMPANY PROFILES</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="./css/dashboard.css"> -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
  <script src="{{ url('js/dataTable.js') }}" defer></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <!-- <script src="./js/validation.js" defer></script> -->
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
        Add Company
      </button>
    </div>

    <form action="/company/store" method="post">
      @csrf
      <div class="modal fade" id="createCompany" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Add a Company</h1>
            </div>
            <div class="modal-body">
              <div class="col-12">
                <!-- last name -->
                <div class="form-floating mb-3">
                  <input type="text" name="company_code" id="companyCode" class="form-control" placeholder="Company Code">
                  <label for="companyCode">Input a company code</label>
                </div>
              </div>
              <div class="col-12">
                <!-- first name -->
                <div class="form-floating mb-3">
                  <input type="text" name="company_name" id="companyName" class="form-control" placeholder="Company Name">
                  <label for="companyName">Input a company name</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success fw-bold" name="company_submit">Register</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped table-hover " id="myTable" style="width: 100%;">
        <thead class="table-success">
          <tr>
            <th>Company Code</th>
            <th>Company Name</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($company as $companies)
          <tr>
            <td>{{ strtoupper($companies->company_code) }}</td>
            <td>{{ $companies->company_name }}</td>
            <td>
              <div class="d-inline-block">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateCompanyModal-{{ $companies->id }}">
                  <i class="fa-solid fa-pen"></i>
                </button>

                <form action="/company/{{ $companies->id }}" method="post">
                  @method('put')
                  @csrf
                  <div class="modal fade" id="updateCompanyModal-{{ $companies->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update Companies</h5>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3 form-floating">
                                <input type="text" name="company_code" id="companyCode" class="form-control" placeholder="Company Code" value="{{ $companies->company_code }}">
                                <label for="companyCode">Company Code</label>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3 form-floating">
                                <input type="text" name="company_name" id="companyName" class="form-control" placeholder="Company Name" value="{{ $companies->company_name }}">
                                <label for="companyName">Company Name</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success fw-bold">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="d-inline-block">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal-{{ $companies->id }}">
                  <i class="fa-solid fa-trash"></i>
                </button>

                <form action="/company/{{ $companies->id }}" method="post">
                  @method('delete')
                  @csrf
                  <div class="modal fade" id="deleteCompanyModal-{{ $companies->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Are you sure you want to delete?</h5>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger fw-bold">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>
</body>

</html>