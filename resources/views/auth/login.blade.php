@extends('layouts.header', ['title' => 'LOGIN'])

<div class="container-fluid">
  <div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{session('message')}}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
      {{session('error')}}
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
            <p class="h1 mb-5 text-center">Inventory System</p>

            <form action="/process" method="post">
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

              <div class="mb-3 form-check">
                <input type="checkbox" name="remember_me" id="check" class="form-check-input">
                <label for="check" class="form-check-label">Remember me</label>
              </div>

              <!-- Forgot password -->
              <div class="form-floating mb-4">
                <p>Forgot password <a href="/forgot_password" class="text-primary">Click here!</a></p>

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

@extends('layouts.footer')
