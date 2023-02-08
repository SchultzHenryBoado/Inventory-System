<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
</head>

<body>
  <div class="container-fluid">
    <div class="container">
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
      @endif

      <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="{{ asset('img/inventory_login.svg') }}" class="img-fluid" alt="Phone image">
            </div>

            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <div class="mb-3">
                <img src="{{ asset('img/pmi_logo.png') }}" alt="PMI Logo" class="ms-5 img-fluid" style="height: 100px; width: 380px;">
              </div>
              <p class="h1 mb-5 text-center">User Login</p>

              <form action="/login/process" method="post">
                @csrf
                <!-- Email input -->
                <div class="form-floating mb-4">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email address" />
                  <label class="form-label" for="email">Email address</label>
                  @error('email')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>

                <!-- Password input -->
                <div class="form-floating mb-4">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                  <label class="form-label" for="password">Password</label>
                  @error('password')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>

                <!-- Submit button -->
                <button type="submit" name="login" class="btn btn-success btn-lg btn-block fw-bold">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>