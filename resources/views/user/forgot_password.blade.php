<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORGOT PASSWORD</title>

  <!-- css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/forgot_password.css') }}">

  <!-- js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
      <a href="/user" class="navbar-brand fw-bold text-white">Inventory Management System</a>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="container mt-5 w-25">

      @if(session()->has('message'))
      <div class="alert alert-success" role="alert">
        {{ session('message') }}
      </div>
      @endif

      <form action="/forgot_password/submit" method="post">
        @csrf
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Forgot Password</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-floating mb-3">
                  <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                  <label for="email">Email</label>
                  @error('email')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-success fw-bold float-end" type="submit">Send</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</body>

</html>