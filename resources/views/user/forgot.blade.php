<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <h1>Hello!</h1>
          <h3>You are receiving this email because we received a password reset request for your account</h3>
        </div>
      </div>
      <div class="col-12">
        You can reset password from bellow link:
        <a href="{{ route('reset_password_link', $token) }}" class="btn btn-success fw-bold">Reset Password</a>
      </div>
    </div>
  </div>
</div>