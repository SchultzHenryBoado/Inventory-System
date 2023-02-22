<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHANGE PASSWORD</title>

  <!-- css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
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
            <a class="dropdown-item" href="/change_password">Change Password</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="nav-item text-center">
            <a class="dropdown-item" href="/logout  ">Logout</a>
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
            <a class="nav-link text-white ms-2 mt-1" href="/receiving">Receiving</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-box-open text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/issuance">Issuance</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-right text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/transfer_in">Transfer In</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-left-long text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/transfer_out">Transfer Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="container mt-5 w-50">

      @if(session()->has('error'))
      <div class="alert alert-danger">
        <p>{{session('error')}}</p>
      </div>
      @endif

      @if(session()->has('status'))
      <div class="alert alert-success">
        <p>{{session('status')}}</p>
      </div>
      @endif

      <form action="/change_password/update" method="post">
        @csrf
        @method('put')
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Change Password</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3 form-floating">
                  <input type="password" name="old_password" id="oldPassword" class="form-control" placeholder="Old Password">
                  <label for="oldPassword">Old Password</label>
                  @error('old_password')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3 form-floating">
                  <input type="password" name="new_password" id="newPassword" class="form-control" placeholder="New Password">
                  <label for="newPassword">New Password</label>
                  @error('new_password')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3 form-floating">
                  <input type="password" name="new_password_confirmation" id="newPasswordConfirmation" class="form-control" placeholder="Confirm Password">
                  <label for="newPasswordConfirmation">Confirm Password</label>
                  @error('new_password_confirmation')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-success float-end" type="submit">Done</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
