<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RESET PASSWORD</title>

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
      <a href="/user" class="navbar-brand fw-bold text-white">Inventory Management System</a>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="container mt-5 w-50">

      <form action="/reset_password" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Reset Password</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <div class="form-floating">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    <label for="email">Email</label>
                    @error('email')
                    <span class="text-danger">
                      {{ $message }}
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <div class="form-floating">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                    <span class="text-danger">
                      {{ $message }}
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <div class="form-floating">
                    <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control" placeholder="Confirm Password">
                    <label for="passwordConfirmation">Confirm Password</label>
                    @error('password_confirmation')
                    <span class="text-danger">
                      {{ $message }}
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-success fw-bold float-end">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <a href="/reset_password"></a>
</body>

</html>
